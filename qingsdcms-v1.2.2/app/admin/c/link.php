<?php
class Link extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_link';
		$this->temproot='extend/link/';
	}

	public function btach()
	{
		$type=getint(F('type'),0);
		$id=F('id');
		switch ($type)
		{
			case '1':
				self::btach_some("isshow",1,$id);
				break;
			case '2':
				self::btach_some("isshow",0,$id);
				break;
			case '3':
				self::btach_clear($id);
				break;
		}
		$this->success('操作成功');
	}

	public function btach_clear($id)
	{
		if(IS_POST)
		{
			$arr=explode(',',$id);
			foreach($arr as $key=>$val)
			{
				$val=getint($val,0);
				$this->db->del($this->tbname,"id=$val");
			}
		}
	}

	public function btach_some($field,$val,$id)
	{
		if(IS_POST)
		{
			$d=[];
			$d[$field]=$val;
			$arr=explode(',',$id);
			foreach($arr as $key=>$val)
			{
				$val=getint($val,0);
				$this->db->update($this->tbname,"id=$val",$d);
			}
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
			$type=getint(F('get.type'),0);
			$where='1=1 ';
			switch ($type)
			{
				case '1':
					$where.=' and isshow=0';
					break;
				case "2":
					$where.=' and isshow=1';
					break;
			}
			$this->assign("where",$where);
			$this->assign("type",$type);
			$this->display($this->temproot."index.php");
		}
	}

	public function add()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'null','网站名称不能为空'],[F('t2'),'null','网址不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where name='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('网站名称已存在');
				}
				else
				{
					$d=[];
					$d['name']=F('t0');
					$d['url']=F('t1');
					$d['ordnum']=getint(F('t2'),0);
					$d['isshow']=getint(F('t3'),0);
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
			$data=[[F('t0'),'null','网站名称不能为空'],[F('t2'),'null','网址不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['name']=F('t0');
				$d['url']=F('t1');
				$d['ordnum']=getint(F('t2'),0);
				$d['isshow']=getint(F('t3'),0);
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
			$this->db->del($this->tbname,"id=$id");
			$this->success('删除成功');
		}
	}

}