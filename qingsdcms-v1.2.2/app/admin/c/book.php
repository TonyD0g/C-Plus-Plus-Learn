<?php
class Book extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_book';
		$this->temproot='extend/book/';
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
			$this->assign("total",C('state_name')+C('state_mobile')+C('state_email')+C('state_qq')+5);
			$this->display($this->temproot."index.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$total=C('state_name')+C('state_mobile')+C('state_email')+C('state_qq')+C('state_message');
			if($total==0)
			{
				$this->error('缺少可填写项目');
				return;
			}
			$data=[];
			$name='';
			$mobile='';
			$email='';
			$qq='';
			$message='';

			if(C('state_name')==1)
			{
				$name=substr(trim(F('name')),0,20);
				$data=array_merge($data,[[$name,'null','姓名不能为空']]);
			}
			if(C('state_mobile')==1)
			{
				$mobile=substr(trim(F('mobile')),0,11);
				$data=array_merge($data,[[$mobile,'null','手机号不能为空'],[$mobile,'mobile','手机号格式不正确']]);
			}
			if(C('state_email')==1)
			{
				$email=substr(trim(F('email')),0,50);
				$data=array_merge($data,[[$email,'null','邮箱不能为空'],[$email,'email','邮箱格式不正确']]);
			}
			if(C('state_qq')==1)
			{
				$qq=substr(trim(F('qq')),0,50);
				$data=array_merge($data,[[$qq,'null','QQ不能为空'],[$qq,'qq','QQ格式不正确']]);
			}
			if(C('state_message')==1)
			{
				$message=substr(trim(F('message')),0,500);
				$data=array_merge($data,[[$message,'null','留言内容不能为空']]);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['name']=$name;
				$d['mobile']=$mobile;
				$d['email']=$email;
				$d['qq']=$qq;
				$d['message']=$message;
				$d['reply']=F('reply');
				$d['replydate']=time();
				$d['isshow']=getint(F('isshow'),0);
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
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$this->db->del($this->tbname,"id=$id");
		}
		$this->success('删除成功');
	}

}