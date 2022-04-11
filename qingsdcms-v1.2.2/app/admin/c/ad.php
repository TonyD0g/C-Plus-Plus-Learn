<?php
class Ad extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_ad';
		$this->temproot='extend/ad/';
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
				$this->db->update($this->tbname."_group","gid=$id",['gnum'=>getint($ordnum[$key],0)]);
			}
			$this->success('保存成功');
		}
		else
		{
			$this->display($this->temproot."group/index.php");
		}
	}

	public function add()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'null','广告组名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname."_group where gname='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('广告组名称已存在');
				}
				else
				{
					$d=[];
					$d['gname']=F('t0');
					$d['gnum']=getint(F('t1'),0);
					$this->db->add($this->tbname."_group",$d);
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
			$this->display($this->temproot."group/add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','广告组名称不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['gname']=F('t0');
				$d['gnum']=getint(F('t1'),0);
				$this->db->update($this->tbname."_group","gid=$id",$d);
				$this->success('保存成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$rs=$this->db->row("select * from ".$this->tbname."_group where gid=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
				$this->display($this->temproot."group/edit.php");
			}
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select * from ".$this->tbname."_group where gid=$id limit 1");
			if($rs)
			{
				if($rs['gkey']!='')
				{
					$this->error('系统自带广告组禁止删除');
					return;
				}
				$ra=$this->db->row("select id from ".$this->tbname." where cid=$id limit 1");
				if($ra)
				{
					$this->error('请先删除广告组下面的广告内容');
				}
				else
				{
					$this->db->del($this->tbname."_group","gid=$id");
				}
			}
			$this->success('删除成功');
		}
		
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

	public function lists()
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
			$cid=getint(F('cid'),0);
			$rs=$this->db->row("select gname from ".$this->tbname."_group where gid=$cid limit 1");
			if($rs)
			{
				$this->assign("cid",$cid);
				$this->assign("gname",$rs['gname']);
				$this->display($this->temproot."list/index.php");
			}
		}
	}

	public function addad()
	{
		$field=get_field($this->db,3);
		$editor=[];
		$draglist=[];
		foreach($field as $key => $val)
		{
			if($val['field_type']=="12")
			{
				$editor[$key]=$val['field_key'];
			}
			if($val['field_type']=="13")
			{
				$draglist[$key]=$val['field_key'];
			}
		}
		if(IS_POST)
		{
			$data=[[F('t0'),'null','名称不能为空'],[F('t1'),'null','图片不能为空'],[F('t2'),'null','网址不能为空']];
			$data=array_merge($data,field_rule($field));
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where name='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('名称已存在');
				}
				else
				{
					$cid=getint(F('get.cid'),0);
					$d=field_form($field);
					$d['cid']=$cid;
					$d['name']=F('t0');
					$d['pic']=F('t1');
					$d['url']=F('t2');
					$d['ordnum']=getint(F('t3'),0);
					$d['isshow']=getint(F('t4'),0);
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
			$cid=getint(F('cid'),0);
			$rs=$this->db->row("select gname from ".$this->tbname."_group where gid=$cid limit 1");
			if($rs)
			{
				$this->assign("cid",$cid);
				$this->assign("gname",$rs['gname']);
				$this->assign("field",$field);
				$this->assign("editor",$editor);
				$this->assign("draglist",$draglist);
				$this->display($this->temproot."list/add.php");
			}
		}
	}

	public function editad()
	{
		$field=get_field($this->db,3);
		$editor=[];
		$draglist=[];
		foreach($field as $key => $val)
		{
			if($val['field_type']=="12")
			{
				$editor[$key]=$val['field_key'];
			}
			if($val['field_type']=="13")
			{
				$draglist[$key]=$val['field_key'];
			}
		}
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$data=[[F('t0'),'null','名称不能为空'],[F('t1'),'null','图片不能为空'],[F('t2'),'null','网址不能为空']];
			$data=array_merge($data,field_rule($field));
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=field_form($field);
				$d['name']=F('t0');
				$d['pic']=F('t1');
				$d['url']=F('t2');
				$d['ordnum']=getint(F('t3'),0);
				$d['isshow']=getint(F('t4'),0);
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
			$cid=getint(F('cid'),0);
			$rg=$this->db->row("select gname from ".$this->tbname."_group where gid=$cid limit 1");
			if($rg)
			{
				$this->assign("cid",$cid);
				$this->assign("gname",$rg['gname']);
				
			}
			$rs=$this->db->row("select * from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
				$this->assign('record',$rs);
			}
			$this->assign("field",$field);
			$this->assign("editor",$editor);
			$this->assign("draglist",$draglist);
			$this->display($this->temproot."list/edit.php");
		}
	}

	public function delad()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select * from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->del($this->tbname,"id=$id");
			}
			$this->success('删除成功');
		}
	}

}