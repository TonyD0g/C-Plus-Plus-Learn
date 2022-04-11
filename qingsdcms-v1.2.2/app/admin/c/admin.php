<?php
class Admin extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_admin';
		$this->temproot='config/admin/';
	}

	public function switchs()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$type=getint(F('get.type'),0);
			$state=getint(F('state'),0);
			switch($type)
			{
				case '1':
					$field='isshow';
					break;
				case '2':
					$field='readonly';
					break;
			}
			$rs=$this->db->row("select adminid from ".$this->tbname." where adminid=".$id." limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,"adminid=$id",[$field=>$state]);
			}
			$this->success('修改成功');
		}
	}

	public function index()
	{
		$this->display($this->temproot."index.php");
	}

	public function add()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'username','请填写3-20位数字、字母、下划线'],[F('t1'),'password','请填写5-16位字符，不能包含空格'],[F('t2'),'null','笔名不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where adminname='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('用户名已存在');
				}
				else
				{
					$d=[];
					$d['adminname']=F('t0');
					$d['adminpass']=md5(F('t1'));
					$d['penname']=isempty(F('t2'))?F('t0'):F('t2');
					$d['pid']=getint(F('t3'),0);
					$d['isshow']=getint(F('t4'),0);
					$d['readonly']=getint(F('t5'),0);
					$d['logintimes']=0;
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
			$this->display($this->temproot."add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$rs=$this->db->row("select * from ".$this->tbname." where adminid=$id limit 1");
			if($rs)
			{
				$d=[];
				if(strlen(F('t1'))!=0)
				{
					$d['adminpass']=md5(F('t1'));
				}
				$d['penname']=isempty(F('t2'))?$rs['adminname']:F('t2');
				$d['pid']=getint(F('t3'),0);
				$d['isshow']=getint(F('t4'),0);
				$d['readonly']=getint(F('t5'),0);
				$this->db->update($this->tbname,"adminid=$id",$d);
			}
			
			$this->success('保存成功');
		}
		else
		{
			$rs=$this->db->row("select * from ".$this->tbname." where adminid=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
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
			if($id==ADMIN_ID)
			{
				$this->error('不能删除自己');
			}
			else
			{
				$this->db->del($this->tbname,"adminid=$id");
				$this->success('删除成功');
			}
		}
	}

}