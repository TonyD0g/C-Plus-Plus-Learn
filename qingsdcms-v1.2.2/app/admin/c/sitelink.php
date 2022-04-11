<?php
class Sitelink extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_sitelink';
		$this->temproot='extend/sitelink/';
	}

	public function switchs()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$isshow=getint(F('isshow'),0);
			$rs=$this->db->row("select id from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,"id=$id",['isshow'=>$isshow]);
			}
		}
		$this->success('修改成功');
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
			$this->cache();
		}
		else
		{
			$this->display($this->temproot."index.php");
		}
	}

	public function cache()
	{
		$rs=$this->db->load("select title,url,num from ".$this->tbname." where isshow=1 order by ordnum,id limit 50");
		$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($rs, true).";\n?>";
		if(!savefile('data/config/sitelink.php',$data))
		{
			$this->error('data/config/sitelink.php写权限不足，请检查');
		}
		unset($data);
	}

	public function add()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'null','关键字不能为空'],[F('t1'),'null','链接网址不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select * from ".$this->tbname." where title='".F('t0')."' limit 1");
				if($rs)
				{
					$this->error('关键字已存在');
				}
				else
				{
					$d=[];
					$d['title']=F('t0');
					$d['url']=F('t1');
					$d['num']=getint(F('t2'),0);
					$d['ordnum']=getint(F('t3'),0);
					$d['isshow']=getint(F('t4'),0);
					$this->db->add($this->tbname,$d);
					$this->success('添加成功');
					$this->cache();
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
			$data=[[F('t0'),'null','关键字不能为空'],[F('t1'),'null','链接网址不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['title']=F('t0');
				$d['url']=F('t1');
				$d['num']=getint(F('t2'),0);
				$d['ordnum']=getint(F('t3'),0);
				$d['isshow']=getint(F('t4'),0);
				$this->db->update($this->tbname,"id=$id",$d);
				$this->success('保存成功');
				$this->cache();
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
			$this->cache();
		}
	}

}