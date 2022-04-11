<?php
class Block extends AdminsController
{
	public function index()
	{
		$dir='block';
		$root='theme/'.C('theme_dir').'/'.$dir;
		mkfolder($root);
		self::check_note();
		$name=require('theme/'.C('theme_dir').'/_note.php');
		$data=self::deal_arr(scandir($root),$root);
		$file=$data[0];
		$this->assign('dir',$dir);
		$this->assign('file',$file);
		$this->assign('name',$name);
		$this->display('theme/block/list.php');
	}

	public function add()
	{
		if(IS_POST)
		{
			$t1=strtolower(F('t1'));
			$t1=str_replace('..','',$t1);
			$file=C('theme_dir').'/block/'.$t1.'.php';
			$data=[[F('t0'),'null','区块说明不能为空'],[$t1,'field','关键字只能为字母和数字的组合'],[!file_exists('theme/'.$file),'other','关键字已存在，请更换']];
			$v=new cms_verify($data);
			if($v->result())
			{
				self::check_note();
				$name=require('theme/'.C('theme_dir').'/_note.php');
				$name['block/'.$t1.'.php']=F('t0');

				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($name, true).";\n?>";
				file_put_contents('theme/'.C('theme_dir').'/_note.php', $data);

				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export([0=>self::deal_text($_POST['t2'])], true).";\n?>";
				file_put_contents('theme/'.$file,$data);
				$this->success('添加成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$this->display('theme/block/add.php');
		}
	}

	public function edit()
	{
		if(IS_POST)
		{
			$dir=decode(F('t1'));
			$dir=str_replace('..','',$dir);
			$root='theme/'.C('theme_dir').'/block/'.$dir.'.php';
			if(!is_file($root))
			{
				$this->error('非法文件');
				return;
			}
			$data=[[F('t0'),'null','区块说明不能为空'],[file_exists($root),'other','区块不存在']];
			$v=new cms_verify($data);
			if($v->result())
			{
				self::check_note();
				$name=require('theme/'.C('theme_dir').'/_note.php');
				$name['block/'.$dir.'.php']=F('t0');
				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($name, true).";\n?>";
				file_put_contents('theme/'.C('theme_dir').'/_note.php', $data);
				
				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export([0=>self::deal_text($_POST['t2'])], true).";\n?>";
				file_put_contents($root,$data);
				$this->success('保存成功');
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
			$root='theme/'.C('theme_dir').'/block/'.$dir;
			if(!is_file($root))
			{
				die('非法文件');
			}
			$arr=explode('/',$dir);
			array_pop($arr);
			list($theme)=explode('/',$dir);
			self::check_note();
			$name=require('theme/'.C('theme_dir').'/_note.php');
			$title='';
			if(isset($name['block/'.$dir]))
			{
				$title=$name['block/'.$dir];
			}
			$content=require($root);
			$this->assign('title',$title);
			$this->assign('key',basename($root,'.php'));
			$this->assign('key_code',encode(basename($root,'.php')));
			$this->assign('content',$content[0]);
			$this->display('theme/block/edit.php');
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$key=decode(F('get.key'));
			$key=str_replace('..','',$key);
			self::check_note();
			$name=require('theme/'.C('theme_dir').'/_note.php');
			unset($name['block/'.$key]);
			$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($name, true).";\n?>";
			file_put_contents('theme/'.C('theme_dir').'/_note.php', $data);
			@unlink('theme/'.C('theme_dir').'/block/'.$key);
			$this->success('删除成功');
		}
		
	}

	public function deal_arr($data,$root,$name=[])
	{
		if(!$data)
		{
			die('【scandir】函数不支持，请在Php.ini中找到去掉限制');
		}
		unset($data[0]);
		unset($data[1]);
		$a=[];
		foreach ($data as $key=>$val)
		{
			if(is_file($root.'/'.$val))
			{
				$a[$key]=['0'=>iconv("gb2312","utf-8",$val),'1'=>filemtime($root.'/'.$val)];
				$a[$key][2]=encode($a[$key][0]);
			}
			else
			{
				unset($data[$key]);
			}
		}
		return ['0'=>$a];
	}

	public function check_note()
	{
		if(!file_exists('theme/'.C('theme_dir').'/_note.php'))
		{
			$d="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export([], true).";\n?>";
			file_put_contents('theme/'.C('theme_dir').'/_note.php', $d);
		}
	}

	public function deal_text($str)
	{
		$str=str_replace('../','',$str);
		if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
			return $str;
		}
		else
		{
			return stripslashes($str);
		}
	}

}