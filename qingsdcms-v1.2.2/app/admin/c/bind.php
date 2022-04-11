<?php
class Bind extends AdminsController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(IS_POST)
		{
			$uname=F('uname');
			$upass=F('upass');
			if($uname=='' || $upass=='')
			{
				$this->error("用户名和密码不能为空");
				return;
			}
			$upass=md5($upass);
			#连接官网服务器验证
			$result=cms_http::post(SYS_API_URL."/bind","uname={$uname}&upass={$upass}",1);
			if($result['state']=='200')
			{
				$arr=jsdecode($result['msg']);
				$msg=$arr['msg'];
				if($arr['state']=='success')
				{
					#保存绑定资料
					$dt=['sys_uname'=>$uname,'sys_upass'=>encode($upass,C('prefix'))];
					$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($dt,true).";\n?>";
					if(savefile('data/config/bind.php',$data))
					{
						$this->success('绑定成功');
					}
					else
					{
						$this->error('data/config/bind.php写权限不足，请检查');
					}
				}
				else
				{
					$this->error($msg);
					return;
				}
			}
			else
			{
				$this->error("无法连接官网服务器");
			}
		}
		else
		{
			$this->display("config/bind.php");
		}
	}

	public function clear()
	{
		if(IS_POST)
		{
			$dt=['sys_uname'=>'','sys_upass'=>''];
			$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($dt,true).";\n?>";
			if(savefile('data/config/bind.php',$data))
			{
				$this->success('解除绑定成功');
			}
			else
			{
				$this->error('data/config/bind.php写权限不足，请检查');
			}
		}
	}


}