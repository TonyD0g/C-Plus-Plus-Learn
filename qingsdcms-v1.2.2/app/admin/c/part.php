<?php
class Part extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_part';
		$this->temproot='config/part/';
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
			$data=[[F('t0'),'null','部门名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where title='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('部门名称已存在');
				}
				else
				{
					$d=[];
					$d['title']=F('t0');
					$d['ordnum']=getint(F('t1'),0);
					$d['page_list']='';
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
			$data=[[F('t0'),'null','部门名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['title']=F('t0');
				$d['ordnum']=getint(F('t1'),0);
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
			$rs=$this->db->row("select adminid from cms_admin where pid=$id limit 1");
			if($rs)
			{
				$this->error('请先删除管理员');
			}
			else
			{
				$this->db->del($this->tbname,'id='.$id.'');
				$this->success('删除成功');
			}
		}
	}

	public function page()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','至少选择一个权限']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d['page_list']=F('t0');
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
			$rs=$this->db->row("select page_list from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->assign('page_list',explode(",",$rs['page_list']));
				$this->display($this->temproot."page.php");
			}
		}
	}

}