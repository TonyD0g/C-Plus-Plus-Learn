<?php
class PlugController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$plugname=PLUG_NAME;
		$this->tp->isCache=false;
		$this->tp->skinDir="app/plug/$plugname/v/";
		$this->tp->cacheDir="app/plug/$plugname/html/";
		$this->tp->compileDir=C('COMPILE_DIR')."/plug/$plugname/";

		if(IS_POST)
		{
			$token=F('token');
			if($token!=session("_token_plug_"))
			{
				$this->error('Token检验失败，请刷新重试');
				exit();
			}
		}
	}

	public function display($a,$b='')
	{
		#添加token
		if(session("_token_plug_")=="")
		{
			$token=md5(uniqid('',true));
			session("_token_plug_",$token);
		}
		else
		{
			$token=session("_token_plug_");
		}
		$this->assign("token",$token);
		$this->tp->display($a,$b);
	}

	public function check_admin()
	{
		if(ADMIN_ID==0)
		{
			die('没有管理权限');
		}
		define('APP_DEMO',(get_admin_info('readonly')==1?true:false));
		if(getint(get_admin_info('pid'),0)!=0)
		{
			define('PAGE_LEVER',get_admin_info('page_list'));
			if(strlen(PAGE_LEVER)==0)
			{
				die('没有管理权限');
			}
			else
			{
				$rs=$this->db->load("select cname from cms_menu where followid>0 and id in(".PAGE_LEVER.")");
				if($rs)
				{
					$mname=C('ADMIN');
					foreach($rs as $key=>$value)
					{
						$rs[$key]=$mname.'/'.$value['cname'];
					}
					if(!(in_array(''.$mname.'/plug',$rs)))
					{
						die('没有管理权限');
					}
				}
			}
		}
	}

	public function _before_action()
	{
		if(IS_POST)
		{
			if(APP_DEMO)
			{
				$this->success('操作成功！！');
				exit();
			}
		}
	}

}