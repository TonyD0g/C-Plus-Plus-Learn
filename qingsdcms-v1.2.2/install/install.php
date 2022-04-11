<?php
define('IN_CMS',true);
define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
define('IS_POST',REQUEST_METHOD=='POST'?true:false);
define('SYSVERSION',version_compare(PHP_VERSION,'5.5.0','<')?true:false);
define('SYS_PATH',str_replace(DIRECTORY_SEPARATOR."install","",str_replace(basename($_SERVER['SCRIPT_FILENAME']),'',$_SERVER['SCRIPT_FILENAME'])));

function F($a,$b='')
{
	$a=strtolower($a);
	if(!strpos($a,'.'))
	{
		$method='other';
	}
	else
	{
		list($method,$a)=explode('.',$a,2);
	}
	switch($method)
	{
		case 'get':
			$input=$_GET;
			break;
		case 'post':
			$input=$_POST;
			break;
		case 'other':
			$type=REQUEST_METHOD;
			switch($type)
			{
				case 'GET':
					$input=$_GET;
					break;
				case 'POST':
					$input=$_POST;
					break;
				default:
					return '';
					break;
			}
			break;
		default:
			return '';
			break;
	}
	$data=isset($input[$a])?$input[$a]:$b;
	if(is_string($data))
	{
		return enhtml(trim($data));
	}
	if(is_array($data))
	{
		foreach($data as $key=>$val)
		{
			$data[$key]=enhtml($val);
		}
	}
	return $data;		
}

function enhtml($a)
{
	if(is_array($a))
	{
		foreach ($a as $key=>$val)
		{
			$a[$key]=enhtml($val);
		}
	}
	else
	{
		$a=htmlspecialchars(stripslashes($a),ENT_QUOTES,'UTF-8');
		$a=str_replace('&amp;','&',$a);
		return $a;
	}
}

function is_really_writable($file)
{
    if(is_dir($file))
    {
        $file=rtrim($file,'/').'/'.'cmstest.html';
        if(($fp = @fopen($file,'ab'))===FALSE)
        {
            return FALSE;
        }
        fclose($fp);
        @chmod($file,0777);
        unlink($file);
        return TRUE;
    }
    elseif(($fp = @fopen($file, 'ab'))===FALSE)
    {
        return FALSE;
    }
    fclose($fp);
    return TRUE;
}

function isempty($a)
{
	if(SYSVERSION)
	{
		return ($a=='');
	}
	else
	{
		return empty($a);
	}
}

function check_install()
{
	if(is_file('install.lock'))
	{
		exit('已经安装过，如需重新安装，请删除install.lock文件');
	}
	if(md5_file('index.php')=='')
	{
		exit('【md5_file】读写权限不足，请检查相关权限设置');
	}
}

function deal_sql($a,$b)
{
	$a=str_replace('cms_',$b,$a);
	$a=str_replace('%s',$b,$a);
	return $a;
}

function deal_sqlite($sql,$type,$line)
{
	if($type=='sqlite')
	{
		$expr=array(
			'/[\r\n]+\s+PRIMARY\s+KEY\s+[^\r\n]+/i' => '',
			'/[\r\n]+\s+UNIQUE\s+KEY\s+[^\r\n]+/i' => '',
			'/[\r\n]+\s+KEY\s+[^\r\n]+/i' => ''
			);
		$sql=preg_replace(array_keys($expr),array_values($expr),$sql);
		$sql=str_replace("`",'',$sql);
		if($line==0)
		{
			$sql=str_replace("\r\n",'',$sql);
		}
		else
		{
			$sql=str_replace('\\r\\n',chr(13),$sql);
		}
		$sql=str_replace('intro','\u0069\u006e\u0074\u006f',$sql);
		$sql=preg_replace("/-- (.*?)-- ----------------------------/s",'',$sql);
		$sql=str_replace("-- ----------------------------",'',$sql);
		$sql=str_replace("SET FOREIGN_KEY_CHECKS=0;",'',$sql);
		$sql=str_replace("-- Records ",'',$sql);
		$sql=preg_replace("/AUTO_INCREMENT=(.*?) DEFAULT/s",'DEFAULT',$sql);
		$sql=str_replace('NOT NULL AUTO_INCREMENT','PRIMARY KEY AUTOINCREMENT NOT NULL',$sql);
		$sql=str_replace('ENGINE=MyISAM DEFAULT CHARSET=utf8','',$sql);
		$sql=str_replace(['varchar','mediumtext'],'TEXT',$sql);
		$sql=preg_replace("/ (int|smallint|tinyint|decimal)(.*?) /s",' INTEGER ',$sql);
		$sql=str_replace(",)",')',$sql);
		$sql=str_replace('\u0069\u006e\u0074\u006f','intro',$sql);
	}
	return $sql;
}

final class temp
{
	public $content='';
	public $php_dim=array();

	function add($a,$b=null)
	{
		$this->php_dim[$a]=$b;
	}

	function show($a)
	{
		extract($this->php_dim,EXTR_OVERWRITE);
		include 'view/'.$a;
	}

}

class install
{
	public function add($a,$b)
	{
		$this->tp->add($a,$b);
	}

	public function show($a)
	{
		$this->tp->show($a);
	}
}

class installController extends install
{
	public function __construct()
	{
		$this->tp=new temp();
	}

	function index()
	{
		$this->show('index.php');
	}

	function check()
	{
		$result=true;
		$data=[];

		$key='Php版本';
	    $data[$key]['result']=PHP_VERSION;
	    $data[$key]['help']='';
		if(version_compare(PHP_VERSION,'5.4.0','<'))
		{
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='当前版本：'.PHP_VERSION;
			$result=false;
		}

		$key='Gd库';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
		$gd=function_exists('gd_info')?gd_info():array();
		if(empty($gd['GD Version']))
		{
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='请开启Gd库';
			$result=false;
		}

		$key='Pdo_Mysql';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
	    if(!extension_loaded('pdo_mysql'))
	    {
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='请开启Pdo_Mysql';
			$result=false;
	    }

	    $key='Pdo_Sqlite';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
	    if(!extension_loaded('pdo_sqlite'))
	    {
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='请开启Pdo_Sqilte';
			#$result=false;
	    }
	   
	    $key='Openssl';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
	    if(!(function_exists('openssl_decrypt') && function_exists('openssl_decrypt')))
	    {
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='';
			$result=false;
	    }

	    $key='Curl';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
	    if(!function_exists('curl_init'))
	    {
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='请开启Curl';
			$result=false;
	    }

	    $key='Scandir';
	    $data[$key]['result']='√';
	    $data[$key]['help']='';
	    if(!function_exists('scandir'))
	    {
			$data[$key]['result']='<span>×</span>';
			$data[$key]['help']='请开启Scandir';
			$result=false;
	    }

	    $file=array();
	    $error='权限不足或文件夹不存在';
	    $key='根目录';
	    $file[$key]['result']='√';
	    $file[$key]['help']='';
	    if(!is_really_writable('../'))
	    {
	    	$file[$key]['result']='<span>×</span>';
	    	$file[$key]['help']=$error;
			$result=false;
	    }


	    $key='附件【upfile】';
	    $file[$key]['result']='√';
	    $file[$key]['help']='';
	    if(!is_really_writable('../upfile/'))
	    {
	    	$file[$key]['result']='<span>×</span>';
	    	$file[$key]['help']=$error;
			$result=false;
	    }

	    $key='配置【data/config】';
	    $file[$key]['result']='√';
	    $file[$key]['help']='';
	    if(!is_really_writable('../data/config/'))
	    {
	    	$file[$key]['result']='<span>×</span>';
	    	$file[$key]['help']=$error;
			$result=false;
	    }

	    $key='日志【data/log】';
	    $file[$key]['result']='√';
	    $file[$key]['help']='';
	    if(!is_really_writable('../data/log/'))
	    {
	    	$file[$key]['result']='<span>×</span>';
	    	$file[$key]['help']=$error;
			$result=false;
	    }

	    $key='插件【app/plug】';
	    $file[$key]['result']='√';
	    $file[$key]['help']='';
	    if(!is_really_writable('../app/plug/'))
	    {
	    	$file[$key]['result']='<span>×</span>';
	    	$file[$key]['help']=$error;
			$result=false;
	    }

		$this->add('data',$data);
		$this->add('file',$file);
		$this->add('result',$result);
		$this->show('check.php');
	}

	function config()
	{
		if(IS_POST)
		{
			$arr=['state'=>'error','msg'=>'error'];
			$type=F('type');
			$t0=F('t0');
			$t1=F('t1');
			$t2=F('t2');
			$t3=F('t3');
			$t4=F('t4');
			$t5=F('t5');
			$t6=F('t6');
			$t7=F('t7');
			$t8=F('t8');
			$check=1;
			if($type=='mysql')
			{
				if(isempty($t0)||isempty($t1)||isempty($t2)||isempty($t3)||isempty($t4)||isempty($t5)||isempty($t6)||isempty($t7))
				{
					$arr['msg']='资料填写不完整';
					$check=0;
				}
				$t8='';
			}
			else
			{
				$t0='';
				$t1='';
				$t2='';
				$t3='';
				$t4='';
				if(isempty($t5)||isempty($t8)||isempty($t6)||isempty($t7))
				{
					$arr['msg']='资料填写不完整';
					$check=0;
				}
			}
			if($check==1)
			{
				#尝试链接数据库
				if($type=='mysql')
				{
					$conn=new PDO('mysql:host='.$t0.';port='.$t1.';',$t3,$t4);
					$conn->exec("set names 'UTF8'");
					#创建数据库
					$conn->query("CREATE DATABASE IF NOT EXISTS `$t2` DEFAULT CHARACTER SET utf8");
					#重新链接数据库
					$conn=new PDO('mysql:host='.$t0.';port='.$t1.';dbname='.$t2.'',$t3,$t4);
					$conn->exec("set names 'UTF8'");
				}
				else
				{
					$conn=new PDO('sqlite:'.iconv("gb2312","utf-8",SYS_PATH).'data/'.$t8);
				}

				#读取Sql文件，写入数据库
				set_time_limit(0);
				$f=fopen('sql/mysql.sql',"rb");
		        $create_table='';
		        while(!feof($f))
		        {
		            $line=fgets($f);

		            if (!preg_match('/;/',$line) || preg_match ( '/ENGINE=/', $line )) 
				    {
				        $create_table .= $line;
				        if (preg_match ( '/ENGINE=/', $create_table))
				        {
				            $conn->query(deal_sqlite(deal_sql($create_table,$t5),$type,0));
				            $create_table = '';
				        }
				        continue;
				    }
		            $conn->query(deal_sqlite(deal_sql($line,$t5),$type,1));
		        }
		        fclose($f);


				#保存管理员信息
			    $conn->query(deal_sql("insert into cms_admin (adminid,adminname,adminpass,penname,pid,logintimes,lastlogindate,lastloginip,isshow,readonly) values (1,'".$t6."', '".md5($t7)."', '创始人',0,0,".time().", '',1,0)",$t5));
			
			    $rnd='cms_'.mt_rand(1000,9999);

				#生成配置文件
				$str=<<<EOF
<?php
return [
	#前缀
	'PREFIX'         => '%s',
	#后台目录
	'ADMIN'          => 'admin',
	#缓存目录
	'COMPILE_DIR'    => 'cache',
	#页面缓存开关
	'HTML_CACHE'     => false,
	#页面缓存目录
	'HTML_CACHE_DIR' => 'html',
	#页面缓存时间，单位分钟
	'HTML_CACHE_TIME'=> 5,
	#页面代码压缩
	'HTML_ZIP'       => false,
	#不支持Path_Info时使用的变量字符，支持时请留空
	'PATHINFO'       => '',
	#是否显示程序查询次数和内存
	'PROCESSED'     => true,
	#数据库
	'DEFAULT_DB'     => [
			#数据库类型（支持：mysql和sqlite）
			'DB_TYPE'    => '%s',
			#表前缀
			'DB_PREFIX'  => '%s',
			#Sqlite数据库名称
			'DB_NAME'  => '%s',
			#数据库IP
			'DB_HOST'    => '%s',
			#数据库端口
			'DB_PORT'    => '%s',
			#数据库名称
			'DB_BASE'    => '%s',
			#数据库用户名
			'DB_USER'    => '%s',
			#数据库密码
			'DB_PASS'    => '%s',
			
		]
	];
EOF;
				$str=sprintf($str,$rnd,$type,$t5,$t8,$t0,$t1,$t2,$t3,$t4);
				if(@file_put_contents('../data/config.php',$str))
				{
					file_put_contents('install.lock',time());
					$arr['state']='success';
					$arr['msg']='安装成功';
				}
				else
				{
					$arr['msg']='配置文件写入失败';
				}
			}
			echo json_encode($arr);
		}
		else
		{
			$this->add('sqlite',extension_loaded('pdo_sqlite'));
			$this->add('rand',mt_rand(10000,99999));
			$this->show('config.php');
		}
	}

	function result()
	{
		$this->show('result.php');
	}
}


$cms=new installController();
switch(F('get.act'))
{
	case 'check':
		check_install();
		$cms->check();
		break;
	case 'config':
		check_install();
		$cms->config();
		break;
	case 'result':
		$cms->result();
		break;
	default:
		check_install();
		$cms->index();
		break;
}