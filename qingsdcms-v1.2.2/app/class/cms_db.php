<?php
final class cms_db
{
	public $conn;
	public $newid;
	public $sql;
	public $prefix='cms_';
	public function __construct($db)
	{
		try
		{
			if(DB_TYPE)
			{
				$this->conn=new PDO('mysql:host='.$db['DB_HOST'].';port='.$db['DB_PORT'].';dbname='.$db['DB_BASE'].'',$db['DB_USER'],$db['DB_PASS']);
				$this->conn->exec("set names 'UTF8'");
			}
			else
			{
				$this->conn=new PDO('sqlite:'.iconv("gb2312","utf-8",SYS_PATH).'data/'.$db['DB_NAME']);
			}
			
			$this->prefix=$db['DB_PREFIX'];
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function __destruct()
	{
		$this->conn=null;
	}

	public function query($sql,$type=0)
	{
		$GLOBALS['query']+=1;
		if($type==0)
		{
			$sql=self::filter_table($sql);
		}
		if(!DB_TYPE)
		{
			$sql=str_replace(['rand()','binary'],['random()',''], $sql);
		}
		$db=$this->conn->query($sql);
		if($this->conn->errorCode()=='00000')
		{
			return $db;
		}
		else
		{
			#写错误日志
			$error=$this->conn->errorInfo();
			$str="Sql：$sql<br>日期：".date('Y-m-d H:i:s')."<br>详细：".$error[2]."<br>Url：".THIS_LOCAL."<br>IP：".getip()."";
			if(!savefile(SYS_PATH.'data/log/'.date('Y-m-d-H-i-s').'.txt',$str))
			{
				$this->error('data/log/写权限不足，请检查');
			}
			$arr=['state'=>'error','msg'=>'SQL错误，详细请查阅日志'];
			echo jsencode($arr);
			die();
		}		
	}

	public function count($sql)
	{
		$array=$this->query($sql)->fetch(PDO::FETCH_NUM);
		return $array[0];
	}

	public function load($sql,$type=0,$cache=false,$time=0)
	{
		if($cache)
		{
			mkfolder(C('compile_dir').'/data');
			$filename=SYS_PATH.C('compile_dir').'/data/'.md5($sql).'.php';
			if(!is_file($filename))
			{
				$data=self::load_data($sql,$type);
				$dt="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($data, true).";\n?>";
				file_put_contents($filename,$dt);
				return $data;
			}
			else
			{
				if($time>0)
				{
					if((time()-filemtime($filename))/60>$time)
					{
						unlink($filename);
						return self::load($sql,$type,$cache,$time);
					}
				}
				$data=require $filename;
				return $data;
			}
		}
		else
		{
			return self::load_data($sql,$type);
		}
	}

	public function load_data($sql,$type=0)
	{
		$array=[];
		$this->sql=$sql;
		$result=$this->query($sql,$type);
		while($data=$result->fetch(PDO::FETCH_ASSOC))
		{
			$array[]=self::replaces($data);
		}
		unset($result);
		return $array;
	}

	function replaces($a)
	{
		if(DB_TYPE)
		{
			return $a;
		}
		if(is_array($a))
		{
			foreach($a as $key=>$val)
			{
				$a[$key]=self::replaces($val);
			}
		}
		else
		{
			#$a=str_replace("\\",'',$a);
			$a=stripslashes($a);
		}
		return $a;
	}

	public function row($sql,$type=0)
	{
		$result=$this->query($sql,$type);
		if($result)
		{
			return self::replaces($result->fetch(PDO::FETCH_ASSOC));
		}
		else
		{
			return false;
		}
	}

	public function getkeylist($id,$table,$join,$where,$order,$begin,$end,$way=0)
	{
		$table=self::filter_table($table);
		$join=self::filter_table($join);
		$where=self::filter_table($where);
		$order=self::filter_table($order);
		$str=$where;
		if($way==1)
		{
			$order=str_replace("desc","asc",$order);
		}
		$sql="select $id from $table $join $where $order limit $begin,$end";
		$data_id=$this->load($sql,1);
		if(count($data_id)>0)
		{
			foreach($data_id as $key=>$val)
			{
				$data_id[$key]=$val[$id];
			}
			$str="where $id in(".implode(',',$data_id).")";
		}
		$str=str_replace($this->prefix,'cms_',$str);
		return $str;
	}

	public function add($table,$array,$type=0)
	{
		$table=self::filter_table($table);
		$field=array_keys($array);
		$value=array_values($array);
		array_walk($field,array($this,'add_special_char'));
		array_walk($value,array($this,'escape_string'));
		$field=implode(',',$field);
		$value=implode(',',$value);
		if($type==1)
		{
			$value=str_replace('\\"','\\\\"',$value);
		}
		$result=$this->query("insert into $table ($field) values ($value)",1);
		$this->newid=$this->conn->lastInsertId();
		return $result;
	}

	public function update($table,$where,$array)
	{
		$table=self::filter_table($table);
		$where=!isempty($where)?'where '.$where:'';
		$field=[];
		foreach($array as $key=>$value)
		{
			$field[]=$this->add_special_char($key).'='.$this->escape_string($value);
		}
		$field=implode(',',$field);
		return $this->query("update $table set $field $where",1);
	}

	public function del($table,$where)
	{
		$table=self::filter_table($table);
		$where=!isempty($where)?'where '.$this->filter_char($where):'';
		return $this->query("delete from $table $where",1);
	}

	public function load_field($field,$table,$where,$data='')
	{
		$table=self::filter_table($table);
		$where=!isempty($where)?'where '.$where:'';
		$sql="select $field from $table $where limit 1";
		$rs=$this->row($sql,1);
		return ($rs)?$rs[$field]:$data;
	}

	public function add_special_char(&$value)
	{
		if('*'==$value || false!==strpos($value, '(') || false!==strpos($value, '.') || false!==strpos ( $value, '`'))
		{
			#不处理包含* 或者 使用了sql方法。
		} 
		else 
		{
			$value='`'.trim($value).'`';
		}
		return $this->filter_char($value);
	}

	public function filter_char($val)
	{
		return preg_replace("/\b(select|insert|update|delete|union|concat|extractvalue|benchmark|greatest|least|get_lock|updatexml|getenv|_schema|exp|sleep|payload|hex|assert)\b/i",'',$val);
	}
	
	public function escape_string(&$value,$key='',$quotation=1)
	{
		$q=($quotation)?'\'':'';
		$value=$q.$value.$q;
		return $value;
	}

	public function filter_table($table,$type=0)
	{
		if($type==0)
		{
			$table=str_replace('cms_',$this->prefix,$table);
			$table=str_replace('%s',$this->prefix,$table);
		}
		else
		{
			$tb=strtolower($table);
			if(strpos($tb,"insert") && strpos($tb,"into") && strpos($tb,"values"))
			{
				$dt=explode("values",$tb);
				$frist=self::filter_table($dt[0],0);
				unset($dt[0]);
				return $frist.implode($dt);
			}
			else
			{
				return self::filter_table($table,0);
			}
		}
		return $table;
	}
}