<?php
class Configgroupfield extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_config';
		$this->temproot='system/field/';
	}

	public function switchs()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$isshow=getint(F('isshow'),0);
			$rs=$this->db->row("select id from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,"id=$id",['isshow'=>$isshow]);
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
			$gid=getint(F('get.gid'),0);
			$this->assign('gid',$gid);
			$this->display($this->temproot."index.php");
		}
	}

	public function add()
	{
		$gid=getint(F('get.gid'),0);
		if(IS_POST)
		{
			$gid=getint(F('get.gid'),0);
			$data=[[F('t0'),'null','字段名称不能为空'],[strtolower(F('t1')),'field','字段Key只能为字母和数字的组合']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where ckey='".strtolower(F('t1'))."' limit 1");
				if($rs)
				{
					$this->error('字段Key已被占用');
				}
				else
				{
					$d=[];
					$d['ctitle']=F('t0');
					$d['ckey']=strtolower(F('t1'));
					$d['ctype']=getint(F('t2'),0);
					$d['dvalue']=str_replace("\r\n",",",F('t3'));
					$d['dtext']=F('t4');
					$d['ordnum']=getint(F('t5'),0);
					$d['rtype']=getint(F('t6'),0);
					$d['utype']=getint(F('t8'),0);
					$d['isshow']=getint(F('t7'),0);
					$d['gid']=$gid;
					$d['cvalue']='';
					$d['issys']=0;
					$this->db->add($this->tbname,$d);
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
			$this->assign('gid',$gid);
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
				$d['ctitle']=F('t0');
				$d['ctype']=getint(F('t2'),0);
				$d['dvalue']=str_replace("\r\n",",",F('t3'));
				$d['dtext']=F('t4');
				$d['ordnum']=getint(F('t5'),0);
				$d['rtype']=getint(F('t6'),0);
				$d['utype']=getint(F('t8'),0);
				$d['isshow']=getint(F('t7'),0);
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
					if($key=="dvalue")
					{
						$this->assign($key,str_replace(",","\r\n",$val));
					}
					else
					{
						$this->assign($key,$val);
					}
				}
				$this->display($this->temproot."edit.php");
			}
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select issys from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				if($rs['issys']==1)
				{
					$this->error('系统字段不能删除');
				}
				else
				{
					$this->db->del($this->tbname,"id=$id");
					$this->success('删除成功');
				}
			}
		}
	}

}