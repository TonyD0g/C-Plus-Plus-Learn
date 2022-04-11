<?php
class Index extends AdminsController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Index()
	{
		if(IS_POST)
		{
			$type=getint(F('type'),0);
			$authtype=($type==1)?"network":"local";
			$code=str_replace(["\r\n","\n"],"",F('code'));
			$data=['BIZ_ID'=>$code];
			$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($data, true).";\n?>";
			if(savefile('data/biz.php',$data))
			{
				if(!APP_DEMO)
				{
					savefile('data/auth.php',"<?php\nif(!defined('IN_CMS')) exit;\n#local:为本地授权，network:为网络授权\nreturn ".var_export(['sys_auth_type'=>$authtype], true).";\n?>");
				}
				$this->success('保存成功');
			}
			else
			{
				$this->error('data/biz.php写权限不足，请检查');
			}
		}
		else
		{
			$where='';
			if(get_admin_info('pid')!=0)
			{
				$where=' and id in('.PAGE_LEVER.')';
			}
			$this->assign('where',$where);
			$this->display("index.php");
		}
	}

	public function login()
	{
		$this->display("login.php");
	}

	public function right()
	{
		$count=[];
		$count['content']['total']=$this->db->count("select count(1) from cms_show");
		$count['content']['num']=$this->db->count("select count(1) from cms_show where isshow=0");
		$count['link']['total']=$this->db->count("select count(1) from cms_link");
		$count['link']['num']=$this->db->count("select count(1) from cms_link where isshow=0");
		$count['book']['total']=$this->db->count("select count(1) from cms_book");
		$count['book']['num']=$this->db->count("select count(1) from cms_book where isshow=0");

 		$services=[
             '运行环境'=>PHP_OS.'　'.$_SERVER["SERVER_SOFTWARE"],
             'Php版本'=>PHP_VERSION,
             '服务器Ip'=>gethostbyname($_SERVER['SERVER_NAME']),
             '上传限制'=>ini_get('upload_max_filesize'),
             'Gzip压缩'=>$_SERVER['HTTP_ACCEPT_ENCODING'],
        ];

		$this->assign('count',$count);
		$this->assign('services',$services);
		$where='1=1';
		if(get_admin_info('pid')!=0)
		{
			$where=" loginname='".get_admin_info('adminname')."'";
		}
		$this->assign('where',$where);
		$this->assign('authtype',C('sys_auth_type'));
		$this->display('right.php');
	}

	public function pass()
	{
		if(IS_POST)
		{
			$data=[[F('t0'),'null','原密码不能为空'],[md5(F('t0'))==get_admin_info('adminpass'),'other','原密码错误'],[F('t1'),'null','新密码不能为空'],[F('t2'),'null','确认密码不能为空'],[F('t1')==F('t2'),'other','两次密码不一致']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['adminpass']=md5(F('t1'));
				$this->db->update('cms_admin','adminid='.ADMIN_ID.'',$d);
				$a=session('admin_info');
				$a['adminpass']=md5(F('t1'));
				session('admin_info',$a);
				$this->success('修改成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$this->display("config/admin/pass.php");
		}
	}
	
	public function check()
	{
		$loginstate=0;
		if(IS_POST)
		{
			$ip=getip();
			if(C('admin_logintimes')>0)
			{
				$fail_times=$this->db->count("select count(1) from cms_log_login where loginip='$ip' and loginstate=0 and logindate>".strtotime("-1 day")."");
				if($fail_times>=C('admin_logintimes'))
				{
					$this->error('系统已禁止您今日登录');
					return;
				}
			}
			$t3=session('scode');
			$data=[
				[F('t0'),'username','用户名为3-12位字符'],
				[F('t1'),'password','密码为5-16位字符']
			];
			if(C('admin_code')==1)
			{
				$data=array_merge($data,[[F('t2'),'null','验证码不能为空'],[$t3,'null','无法获取系统验证码'],[$t3==md5(strtolower(F('t2'))),'other','验证码不正确']]);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$rs=$this->db->row("select adminid,adminname,adminpass,penname,pid,isshow,logintimes,page_list,readonly from cms_admin a left join cms_part b on a.pid=b.id where adminname='".F('t0')."' and adminpass='".md5(F('t1'))."' limit 1");
				if(!$rs)
				{
					$this->error('用户名或密码错误');
				}
				else
				{
					if($rs['isshow']==0)
					{
						$this->error('用户被锁定，不能登录');
					}
					else
					{
						$adminid=$rs['adminid'];
						$logintimes=$rs['logintimes'];
						session('admin_info',$rs);
						$this->db->update('cms_admin',"adminid=$adminid",['logintimes'=>$logintimes+1,'lastlogindate'=>time(),'lastloginip'=>$ip]);
						$loginstate=1;
						$this->success('登录成功');
						if(C('admin_log')>0)
						{
							$this->db->del('cms_log_login',"logindate<=".strtotime("-".C('admin_log')." day")."");
							$this->db->del('cms_log',"createdate<=".strtotime("-".C('admin_log')." day")."");
						}
					}
				}
			}
			else
			{
				$this->error($v->msg);
			}
			
			if(C('admin_log_login')==1)
			{
				$d['loginname']=enhtml(F('t0'));
				$d['loginip']=$ip;
				$d['logindate']=time();
				$d['loginmsg']=$this->msg;
				$d['loginstate']=$loginstate;
				$this->db->add('cms_log_login',$d);
			}
		}
		else
		{
			$this->error('来源错误');
		}
	}

	public function out()
	{
		session('admin_info','[del]');
		gourl(U('index'));
	}

	public function code()
	{
		$c=new cms_captcha();
        $c->doimg();
        $code=$c->getCode();
        session('scode',$code);
	}
	
}