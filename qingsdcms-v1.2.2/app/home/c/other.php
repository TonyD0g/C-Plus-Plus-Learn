<?php
class Other extends HomeController
{
	public $page;
	public function __construct()
	{
		parent::__construct();
		$this->page=getint(F('get.page'),1);
	}

	#测试项，可以删除
	public function test()
	{
	    
	}

	public function check()
	{
		if(IS_POST)
		{
			session("checkdemo",1688);
			$this->success("ok");
		}
	}

	public function label()
	{
		$seo_title='Tags标签';
		$this->assign('position',[['name'=>$seo_title,'url'=>N('label')]]);
		$this->assign('page_name',$seo_title);
		if($this->page>1)
		{
			$seo_title.="_第{$this->page}页";
		}
		$seo_title.='_'.C('web_name');
		$this->assign('seo_title',$seo_title);
		$this->assign('seo_key',C('seo_key'));
		$this->assign('seo_desc',C('seo_desc'));
		$this->display(T('label'));
	}

	public function tags()
	{
		$id=getint(F("id"),0);
		if($id==0)
		{
			gourl(WEB_ROOT);
			return;
		}
		else
		{
			$rs=$this->db->row("select title from cms_tags where id=$id limit 1");
			if(!$rs)
			{
				$this->error_tips('标签ID错误');
			}
			else
			{
				$tagname=$rs['title'];
			}
		}
		$where="isshow=1 and (title like binary '%$tagname%' or tags like binary '%$tagname%')";
		$seo_title=$tagname;
		$this->assign('position',[['name'=>'Tags标签','url'=>N('label')],['name'=>$seo_title,'url'=>N('tags','','id='.$id.'')]]);
		$this->assign('page_name',$seo_title);
		if($this->page>1)
		{
			$seo_title.="_第{$this->page}页";
		}
		$seo_title.='_Tags标签_'.C('web_name');
		$this->assign('seo_title',$seo_title);
		$this->assign('seo_key',C('seo_key'));
		$this->assign('seo_desc',C('seo_desc'));
		$this->assign('tagname',$tagname);
		$this->assign('keyword',$tagname);
		$this->assign('table','cms_show');
		$this->assign('where',$where);
		$this->assign('order','ordnum desc,id desc');
		$this->display(T('tags'));
	}

	public function search()
	{
		if(IS_POST)
		{
			$keyword=enhtml(urldecode(F('keyword')));
			$classid=getint(F('classid'),0);
			if(isempty($keyword))
			{
				$this->error('关键字不能为空');
				return;
			}
			session("search",['keyword'=>$keyword,'classid'=>$classid]);
			gourl(N('search'));
		}
		else
		{
			$keyword=enhtml(urldecode(F('keyword')));
			$classid=getint(F('classid'),0);
			if($keyword=='')
			{
				$data=session("search");
				if(!isempty($data) && count($data)>0)
				{
					$keyword=$data['keyword'];
					$classid=getint($data['classid']);
				}
			}
			if(isempty($keyword))
			{
				$this->error_tips('关键字不能为空');
			}
			$where="isshow=1 and title like '%{$keyword}%' ";
			if($classid>0)
			{
				$sonid=get_sonid_all($classid);
				$where.=" and classid in($sonid)";
			}
			$seo_title=$keyword;
			$this->assign('position',[['name'=>'站内搜索','url'=>N('search')],['name'=>$seo_title,'url'=>'']]);
			$this->assign('page_name','站内搜索');
			if($this->page>1)
			{
				$seo_title.="_第{$this->page}页";
			}
			$seo_title.='_'.C('web_name');
			$this->assign('seo_title',$seo_title);
			$this->assign('seo_key',C('seo_key'));
			$this->assign('seo_desc',C('seo_desc'));
			$this->assign('keyword',$keyword);
			$this->assign('classid',$classid);
			$this->assign('table','cms_show');
			$this->assign('where',$where);
			$this->assign('order','ordnum desc,id desc');
			$this->display(T('search'));
		}
		
	}

	public function sitemap()
	{
		$seo_title='网站地图';
		$this->assign('position',[['name'=>$seo_title,'url'=>N('sitemap')]]);
		$this->assign('page_name',$seo_title);
		$seo_title.='_'.C('web_name');
		$this->assign('seo_title',$seo_title);
		$this->assign('seo_key',C('seo_key'));
		$this->assign('seo_desc',C('seo_desc'));
		$this->display(T('sitemap'));
	}

	public function book()
	{
		if(IS_POST)
		{
			if(getint(C('state_book'),0)==0)
			{
				$this->error('未开启留言功能');
				return;
			}
			$total=C('state_name')+C('state_mobile')+C('state_email')+C('state_qq')+C('state_message');
			if($total==0)
			{
				$this->error('缺少可填写项目');
				return;
			}
			$postip=getip();
			if(C('state_limit')>0)
			{
				$rs=$this->db->row("select createdate from cms_book where postip='$postip' order by id desc limit 1");
				if($rs)
				{
					if((time()-$rs['createdate'])/60<C('state_limit'))
					{
						$this->error('提交频繁');
						return;
					}
				}
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
			if(C('state_code')==1)
			{
				$code=session('vcode');
				$data=array_merge($data,[[F('code'),'null','验证码不能为空'],[$code,'null','无法获取系统验证码'],[$code==md5(strtolower(F('code'))),'other','验证码不正确']]);
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
				$d['isshow']=0;
				$d['reply']='';
				$d['postip']=$postip;
				$d['createdate']=time();
				$this->db->add('cms_book',$d);
				$this->success('提交成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			if(getint(C('state_book'),0)==0)
			{
				$this->error_tips('未开启留言功能');
				return;
			}
			$seo_title='在线留言';
			$this->assign('position',[['name'=>$seo_title,'url'=>N('book')]]);
			$this->assign('page_name',$seo_title);
			if($this->page>1)
			{
				$seo_title.="_第{$this->page}页";
			}
			$seo_title.='_'.C('web_name');
			$this->assign('seo_title',$seo_title);
			$this->assign('seo_key',C('seo_key'));
			$this->assign('seo_desc',C('seo_desc'));
			$this->display(T('book'));
		}
	}

	public function code()
	{
		$c=new cms_captcha();
        $c->doimg();
        $code=$c->getCode();
        session('vcode',$code);
	}
	
}