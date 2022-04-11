<?php
class field extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_field';
		$this->temproot='extend/field/';
	}
	
	public function switchs()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$state=getint(F('state'),0);
			$rs=$this->db->row("select id from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,"id=$id",['isshow'=>$state]);
			}
			$this->success('修改成功');
		}
	}

	public function index()
	{
		if(IS_POST)
		{
			$mid=F('mid');
			$ordnum=F('ordnum');
			foreach($mid as $key=>$val)
			{
				$id=getint($val,0);
				$this->db->update($this->tbname,"id=$id",['ordnum'=>getint($ordnum[$key],0)]);
			}
			$this->success('保存成功');
		}
		else
		{
			$mid=getint(F('get.mid'),0);
			$where='1=1';
			if($mid>0)
			{
				$where="mid=$mid";
			}
			$this->assign('mid',$mid);
			$this->assign('where',$where);
			$this->display($this->temproot."index.php");
		}
	}

	public function add()
	{
		if(IS_POST)
		{
			$mid=getint(F('mid'),0);
			$prefix=getint(F('prefix'),0);
			$t1=strtolower(F('t1'));
			if($prefix==1)
			{
				$t1='my'.$t1;
			}
			$data=[[F('t0'),'null','字段名称不能为空'],[$t1,'field','字段Key只能为字母和数字的组合']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where field_key='".$t1."' and mid=$mid limit 1");
				if($rs)
				{
					$this->error('字段Key已使用，请更换');
				}
				else
				{
					$d=[];
					$d['field_title']=F('t0');
					$d['field_key']=$t1;
					$d['field_type']=getint(F('t2'),0);
					$d['field_upload_type']=getint(F('t3'),0);
					$d['field_editor']=getint(F('t4'),0);
					$d['field_list']=str_replace("\r\n",",",F('t5'));
					$d['field_radio']=getint(F('t6'),0);
					$d['field_length']=getint(F('t7'),0);
					$d['field_default']=F('t8');
					$d['field_tips']=F('t9');
					$d['field_rule']=getint(F('t10'),0);
					$d['field_sql']=F('t13');
					$d['field_table']=F('t14');
					$d['field_join']=F('t15');
					$d['field_where']=str_replace(['&lt;','&gt;'],['<','>'],F('t16'));
					$d['field_order']=F('t17');
					$d['field_value']=F('t18');
					$d['field_label']=F('t19');
					$d['ordnum']=getint(F('t11'),0);
					$d['isshow']=getint(F('t12'),0);
					$d['mid']=$mid;
					$this->db->add($this->tbname,$d);
					$tablename=self::get_tablename($mid);
					$str=' add '.$t1.' '.str_replace('DEFAULT NULL',"DEFAULT ''",F('t13'));
					$this->db->query("alter table $tablename $str");
					$this->success('添加成功');
				}
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$mid=getint(F('get.mid'),0);
			$this->assign('mid',$mid);
			$this->display($this->temproot."add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','字段名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['field_title']=F('t0');
				$d['field_upload_type']=getint(F('t3'),0);
				$d['field_editor']=getint(F('t4'),0);
				$d['field_list']=str_replace("\r\n",",",F('t5'));
				$d['field_radio']=getint(F('t6'),0);
				$d['field_length']=getint(F('t7'),0);
				$d['field_default']=F('t8');
				$d['field_tips']=F('t9');
				$d['field_rule']=getint(F('t10'),0);
				$d['field_table']=F('t13');
				$d['field_join']=F('t14');
				$d['field_where']=str_replace(['&lt;','&gt;'],['<','>'],F('t15'));
				$d['field_order']=F('t16');
				$d['field_value']=F('t17');
				$d['field_label']=F('t18');
				$d['ordnum']=getint(F('t11'),0);
				$d['isshow']=getint(F('t12'),0);
				$this->db->update($this->tbname,"id=$id",$d);
				$this->success('保存成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$rs=$this->db->row("select * from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					if($key=="field_list")
					{
						$this->assign($key,str_replace(",","\r\n",$val));
					}
					else
					{
						$this->assign($key,$val);
					}
				}
				$mid=getint(F('get.mid'),0);
				$this->assign('mid',$mid);
				$this->display($this->temproot."edit.php");
			}
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select mid,field_key from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->del($this->tbname,"id=$id");
				$tablename=self::get_tablename($rs['mid']);
				$str=' drop '.$rs['field_key'];
				$old_field=$rs['field_key'];
				if(DB_TYPE)
				{
					$this->db->query("alter table $tablename $str");
				}
				else
				{
					$result=$this->db->query("PRAGMA table_info($tablename)");
					$data=$result->fetchall();
					$db=[];
					foreach($data as $key=>$val)
					{
						if($val['name']!=$old_field)
						{
							$db[]=$val['name'];
						}
					}
					$field=implode(',',$db);
					#创建临时表
					$this->db->query("create table cms_temp as select $field from $tablename");

					#删除原表
					$this->db->query("drop table $tablename");
					
					#修改临时表名为原表名
					$this->db->query("alter table cms_temp rename to $tablename");
				}
				$this->success('删除成功');
			}
		}
	}

	public function get_tablename($mid)
	{
		$tbname='';
		switch ($mid)
		{
			case '1':
				$tbname='cms_class';
				break;
			case '2':
				$tbname='cms_data';
				break;
			case '3':
				$tbname='cms_ad';
				break;
		}
		return $tbname;
	}

}