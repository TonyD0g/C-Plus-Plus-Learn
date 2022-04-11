<?php
class Cache extends AdminsController
{
	public function index()
	{
		$data=[];
		if(file_exists(C('COMPILE_DIR').'/'.C('admin').''))
		{
			$data[0]=['title'=>'后台缓存','path'=>C('COMPILE_DIR').'/'.C('admin').'','id'=>1];
		}
		if(file_exists(C('COMPILE_DIR').'/home'))
		{
			$data[1]=['title'=>'前台缓存','path'=>C('COMPILE_DIR').'/home','id'=>2];
		}
		if(file_exists(C('COMPILE_DIR').'/plug'))
		{
			$data[2]=['title'=>'插件缓存','path'=>C('COMPILE_DIR').'/plug','id'=>3];
		}
		if(file_exists(C('COMPILE_DIR').'/'.C('HTML_CACHE_DIR').''))
		{
			$data[3]=['title'=>'页面缓存','path'=>C('COMPILE_DIR').'/'.C('HTML_CACHE_DIR').'','id'=>4];
		}
		if(file_exists(C('COMPILE_DIR').'/data'))
		{
			$data[4]=['title'=>'数据缓存','path'=>C('COMPILE_DIR').'/data','id'=>5];
		}
		if(file_exists(C('COMPILE_DIR').'/temp'))
		{
			$data[5]=['title'=>'临时文件','path'=>C('COMPILE_DIR').'/temp','id'=>6];
		}
		$this->assign("data",$data);
		$this->display("system/cache.php");
	}

	public function del()
	{
		$file='';
		switch (getint(F('get.id'),0))
		{
			case '1':
				$file=C('COMPILE_DIR').'/'.C('admin');
				break;
			case '2':
				$file=C('COMPILE_DIR').'/home';
				break;
			case '3':
				$file=C('COMPILE_DIR').'/plug';
				break;
			case '4':
				$file=C('COMPILE_DIR').'/'.C('HTML_CACHE_DIR');
				break;
			case '5':
				$file=C('COMPILE_DIR').'/data';
				break;
			case '6':
				$file=C('COMPILE_DIR').'/temp';
				break;
		}
		if($file!='')
		{
			delfolder($file);
		}
		$this->success('清理成功');
	}
	
	public function clear()
	{
		delfolder(C('COMPILE_DIR'));
		$this->success('清理成功');
	}

}