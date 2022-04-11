<?php
class Menu extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_menu';
		$this->temproot='system/menu/';
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
				$this->db->update($this->tbname,'id='.$id.'',['isshow'=>$isshow]);
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
			$fid=getint(F('get.fid'),0);
			$this->assign('fid',$fid);
			$this->display($this->temproot."index.php");
		}
	}

	public function add()
	{
		$fid=getint(F('get.fid'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','菜单名称不能为空']];
			if($fid!=0)
			{
				array_push($data,[F('t1'),'null','控制器名称不能为空'],[F('t2'),'null','动作名称不能为空']);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where followid=$fid and title='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('菜单名称已存在');
				}
				else
				{
					$d=[];
					$d['title']=F('t0');
					$d['cname']=F('t1');
					$d['aname']=F('t2');
					$d['dname']=F('t3');
					$d['ordnum']=getint(F('t4'),0);
					$d['isshow']=F('t5');
					$d['followid']=$fid;
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
			$this->assign('fid',$fid);
			$this->display($this->temproot."add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','菜单名称不能为空']];
			if(getint(F('t6'),0)!=0)
			{
				array_push($data,[F('t1'),'null','控制器名称不能为空'],[F('t2'),'null','动作名称不能为空']);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['title']=F('t0');
				$d['cname']=F('t1');
				$d['aname']=F('t2');
				$d['dname']=F('t3');
				$d['ordnum']=getint(F('t4'),0);
				$d['isshow']=F('t5');
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
			$rs=$this->db->row("select id from ".$this->tbname." where followid=$id limit 1");
			if($rs)
			{
				$this->error('请先删除子菜单');
			}
			else
			{
				$this->db->del($this->tbname,"id=$id");
				$this->success('删除成功');
			}
		}
	}
}