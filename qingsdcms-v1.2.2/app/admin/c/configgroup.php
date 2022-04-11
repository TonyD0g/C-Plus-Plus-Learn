<?php
class Configgroup extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_config_group';
		$this->temproot='system/group/';
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
			$this->display($this->temproot."index.php");
		}
		
	}

	public function add()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'null','分组名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where gname='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('菜单名称已存在');
				}
				else
				{
					$d=[];
					$d['gname']=F('t0');
					$d['ordnum']=getint(F('t1'),0);
					$d['isshow']=getint(F('t2'),0);
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
			$data=[[F('t0'),'null','分组名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['gname']=F('t0');
				$d['ordnum']=getint(F('t1'),0);
				$d['isshow']=getint(F('t2'),0);
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
			$rs=$this->db->row("select id from cms_config where gid=$id limit 1");
			if($rs)
			{
				$this->error('请先删除分组的字段');
			}
			else
			{
				$this->db->del($this->tbname,"id=$id");
				$this->success('删除成功');
			}
		}
	}

}