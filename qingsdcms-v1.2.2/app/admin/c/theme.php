<?php
class Theme extends AdminsController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$folder=scandir('theme');
		if(!$folder)
		{
			die('【scandir】函数不支持，请在Php.ini中去掉限制');
		}
		unset($folder[0]);
		unset($folder[1]);
		$type=getint(F('type'),0);
		foreach($folder as $key=>$val)
		{
			if(!is_dir('theme/'.$val))
			{
				unset($folder[$key]);
			}
			else
			{
				unset($folder[$key]);
				if(is_file('theme/'.$val.'/_theme.php'))
				{
					$info=require('theme/'.$val.'/_theme.php');
					$folder[$val]=['app'=>$val,'key'=>encode($val),'title'=>$info['title'],'image'=>$info['image'],'author'=>$info['author'],'url'=>$info['url'],'isstall'=>(C('theme_dir')==$val)?1:0,'isdown'=>1];
				}
			}
		}
		if($type==1)
		{
			$data=self::applist();
			foreach($folder as $key => $val)
			{
				if(isset($data[$key]))
				{
					$old=$data[$key];
					if(C('theme_dir')==$val['app'])
					{
						$old['isstall']=1;
						$old['author']=$val['author'];
						if($val['url']!='')
						{
							$old['url']=$val['url'];
						}
					}
					if(is_dir('theme/'.$val['app']))
					{
						$old['isdown']=1;
					}
					$data[$key]=$old;
				}
			}
			$this->assign('folder',$data);
		}
		else
		{
			$this->assign('folder',$folder);
		}
		$this->assign('type',$type);
		if($type==0)
		{
			$this->display("theme/local.php");
		}
		else
		{
			$this->display("theme/net.php");
		}
	}

	function applist()
	{
		$result=cms_http::post(SYS_API_URL."/templist","",1);
		if($result['state']=='200')
		{
			$arr=jsdecode($result['msg']);
			if($arr['state']=='success')
			{
				$data=$arr['msg'];
				foreach($data as $key=>$val)
				{
					$val['id']=$key;
					$data[$val['app']]=$val;
					unset($data[$key]);
				}
				return $data;
			}
			else
			{
				return [];
			}
		}
		else
		{
			savefile(SYS_PATH.'data/log/'.date('Y-m-d-H-i-s').'.txt','无法获取模板服务器列表');
			return [];
		}
	}

	public function down()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			if($id<=0)
			{
				$this->error('参数错误');
				return;
			}
			$uname=C('sys_uname');
			$upass=C('sys_upass');
			if($uname=='' || $upass=='')
			{
				$this->error("未绑定官网账号");
				return;
			}
			$upass=decode($upass,C('prefix'));
			if(is_array($upass))
			{
				$this->error("绑定的密码解密失败，请重新绑定");
				return;
			}
			#连接插件服务器，获取文件
			$result=cms_http::post(SYS_API_URL."/tempshow","uname={$uname}&upass={$upass}&id={$id}",1);
			if($result['state']=='200')
			{
				$arr=jsdecode($result['msg']);
				$msg=$arr['msg'];
				if($arr['state']=='error')
				{
					$this->error($msg);
					return;
				}
				$name=$msg['name'];
				$url=$msg['url'];
			}
			else
			{
				$this->error('无法连接模板服务器');
				return;
			}
			#下载文件
			$res=cms_http::get($url,1);
			if($res['state']!=200)
			{
				$this->error($url.'获取失败');
				return;
			}
			$root='cache/temp';
			$filename=$root.'/'.$name.'.zip';
			mkfolder($root);
			$res=savefile($filename,$res['msg']);
			if(!$res)
			{
				$this->error('【'.$root.'】读写权限不足');
				return;
			}
			$result=cms_zip::unzip($filename,"theme/$name");
	    	if($result)
	    	{
	    		#删除临时文件
	    		@unlink($filename);
	    		$this->success('下载解压成功');
	    	}
	    	else
	    	{
	    		$this->error("解压失败：$result");
	    	}
		}
	}

	public function config()
	{
		if(IS_POST)
		{
			$config=F('config');
			if(!is_file('theme/'.$config.'/_theme.php'))
			{
				$this->error('模板配置错误');
			}
			else
			{
				$d=[];
				$d['THEME_DIR']=$config;
				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($d, true).";\n?>";

				if(savefile('data/config/theme.php',$data))
				{
					$this->success('应用成功');
				}
				else
				{
					$this->error('应用失败：data/config/theme.php未保存成功');
				}
			}
		}
	}

	public function lists()
	{
		$dir=decode(F('root'));
		$dir=str_replace('..','',$dir);
		$root='theme/'.$dir;
		if(!is_dir($root))
		{
			die('非法路径');
		}
		list($theme)=explode('/',$dir);
		self::check_note($theme);
		$name=require('theme/'.$theme.'/_note.php');
		$data=self::deal_arr(scandir($root),$root,$dir);
		$folder=$data[0];
		$file=$data[1];
		$arr=explode('/',$dir);
		$str='';
		$position='';
		foreach($arr as $key=>$val)
		{
			if($key==0)
			{
				$str=$val;
			}
			else
			{
				$str.='/'.$val;
			}
			$position.=' > <a href="'.U('lists','root='.encode($str).'').'">'.$val.'</a>';
		}
		$arr=explode('/',$dir);
		array_shift($arr);
		$note=implode('/',$arr);
		if($note){$note.='/';}

		$this->assign('dir',$dir);
		$this->assign('note',$note);
		$this->assign('position',$position);
		$this->assign('folder',$folder);
		$this->assign('file',$file);
		$this->assign('name',$name);
		$this->display('theme/list.php');
	}

	public function edit()
	{
		if(IS_POST)
		{
			$dir=decode(F('t0'));
			$dir=str_replace('..','',$dir);
			$root='theme/'.$dir;
			if(!is_file($root))
			{
				$this->error('非法文件');
				return;
			}
			$data=explode("/",$dir);
			if(count($data)>2 && $data[1]=='block')
			{
				$this->error('非法文件');
				return;
			}
			list($theme)=explode('/',$dir);
			self::check_note($theme);
			$name=require('theme/'.$theme.'/_note.php');
			$db=explode('/',$dir);
			unset($db[0]);
			$note=implode('/',$db);
			if(strlen(F('t1'))==0)
			{
				unset($name[$note]);
			}
			else
			{
				$name[$note]=F('t1');
			}
			$text=self::deal_text($_POST['t2'],$dir);
			$data=[[$text,'null','内容不能为空']];
			if(check_bad($text)>0)
			{
				$data=array_merge($data,[[(1>1),'other','请勿提交非法内容']]);
			}
			$text=str_replace(['?php','?>',"< if(!defined('IN_CMS')) exit;"],'',$text);
			
			$v=new cms_verify($data);
			if($v->result())
			{
				if(strpos($root,'.php'))
				{
					$text="<?php if(!defined('IN_CMS')) exit;?>".$text;
				}
				file_put_contents($root,$text);
				$this->success('保存成功');
				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($name, true).";\n?>";
				file_put_contents('theme/'.$theme.'/_note.php', $data);
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$dir=decode(F('get.root'));
			$dir=str_replace('..','',$dir);
			$root='theme/'.$dir;
			if(!is_file($root))
			{
				die('非法文件');
			}
			$data=explode("/",$dir);
			if(count($data)>2 && $data[1]=='block')
			{
				die('非法文件');
			}
			if(self::isImage($root))
			{
				die('图像文件不可编辑');
			}
			$arr=explode('/',$dir);
			array_pop($arr);
			list($theme)=explode('/',$dir);
			self::check_note($theme);
			$name=require('theme/'.$theme.'/_note.php');
			$remark='';
			$db=explode('/',$dir);
			unset($db[0]);
			$note=implode('/',$db);
			if(isset($name[$note]))
			{
				$remark=$name[$note];
			}
			$arr=explode('/',$dir);
			array_pop($arr);
			$str='';
			$position='';
			foreach($arr as $key=>$val)
			{
				if($key==0)
				{
					$str=$val;
				}
				elseif($key!=count($arr))
				{
					$str.='/'.$val;
				}
				$position.=' > <a href="'.U('lists','root='.encode($str).'').'">'.$val.'</a>';
			}
			$data=file_get_contents($root);
			if(APP_DEMO) $data='您的账户没有查看模板代码权限';
			$this->assign('file',$dir);
			$this->assign('file_code',encode($dir));
			$this->assign('remark',$remark);
			$this->assign('data',str_replace("<?php if(!defined('IN_CMS')) exit;?>",'',$data));
			$this->assign('old',encode(implode('/',$arr)));
			$this->assign('position',$position);
			$this->display('theme/edit.php');
		}
	}

	function isImage($filename)
	{
		$result=false;
	    if(file_exists($filename))
	    {
	    	$info=pathinfo($filename);
	        $ext=$info['extension'];
	        if(in_array($ext,['gif','jpg','jpeg','png','bmp']))
	        {
	        	$result=true;
	        }
	    }
	    return $result;
	}

	public function deal_arr($data,$root,$dir='')
	{
		unset($data[0]);unset($data[1]);
		$a=[];
		$b=[];
		foreach($data as $key=>$val)
		{
			if(is_dir($root.'/'.$val))
			{
				$a[$key]=['0'=>iconv("gb2312","utf-8",$val),'1'=>filemtime($root.'/'.$val)];
				$dir=rtrim($dir,"/");
				$a[$key][2]=encode($dir.'/'.$a[$key][0]);
			}
			elseif(is_file($root.'/'.$val))
			{
				$b[$key]=['0'=>iconv("gb2312","utf-8",$val),'1'=>filemtime($root.'/'.$val),'2'=>formatBytes(filesize($root.'/'.$val))];
				$b[$key][3]=encode($dir.'/'.$b[$key][0]);
			}
			else
			{
				unset($data[$key]);
			}
		}
		return ['0'=>$a,'1'=>$b];
	}

	public function check_note($theme)
	{
		if(!file_exists('theme/'.$theme.'/_note.php'))
		{
			$d="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export([], true).";\n?>";
			file_put_contents('theme/'.$theme.'/_note.php', $d);
		}
	}

	public function deal_text($str,$dir)
	{
		$arr=pathinfo($dir);
		if($arr['extension']!='css')
		{
			$str=str_replace('../','',$str);
		}
		if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
			return $str;
		}
		else
		{
			return stripslashes($str);
		}
	}

	public function template()
	{
		$root=decode(F('root'));
		$root=str_replace('..','',$root);
		if($root=='')
		{
			$root='theme/'.C('theme_dir').'/';
		}
		else
		{
			$root='theme/'.C('theme_dir').'/'.$root.'/';
		}

		$dir=str_replace('theme/'.C('theme_dir').'/','',$root);
		if(!is_dir($root))
		{
			die($root.'文件夹不存在');
		}
		$arr=explode('/',ltrim($dir,"/"));
		$str='';
		$position='';
		$default='theme/'.C('theme_dir').'/';
		foreach($arr as $key=>$val)
		{
			if($key==0)
			{
				$str=$val;
			}
			else
			{
				$str.='/'.$val;
			}
			$position.=' > <a href="'.U('template','root='.encode($str).'').'">'.$val.'</a>';
		}
		$data=self::deal_arr(scandir($root),$root,$dir);
		$folder=$data[0];
		$file=$data[1];
		self::check_note(C('theme_dir'));
		$name=require('theme/'.C('theme_dir').'/_note.php');
		$this->assign('folder',$folder);
		$this->assign('file',$file);
		$this->assign('name',$name);
		$this->assign('root',$root);
		$this->assign('dir',$dir);
		$this->assign('position',$position);
		$this->display("theme/template.php");
	}

}