<?php
class LogError extends AdminsController
{
	private $logroot;
	public function __construct()
	{
		parent::__construct();
		$this->logroot='data/log';
	}

	public function index()
	{
		mkfolder($this->logroot);
		$root=$this->logroot;
		$db=self::deal_arr(scandir($root),$root);
		$this->assign('db',$db[0]);
		$this->display("system/log/error.php");
	}

	public function view()
	{
		$key=decode(F('key'));
		$key=str_replace('..','',$key);
		if(!is_file($this->logroot.'/'.$key))
		{
			echo '日志文件名错误';
		}
		else
		{
			echo file_get_contents($this->logroot.'/'.$key);
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$key=decode(F('get.key'));
			$key=str_replace('..','',$key);
			@unlink($this->logroot.'/'.$key);
			$this->success('删除成功');
		}
	}

	public function clear()
	{
		if(IS_POST)
		{
			$root=$this->logroot;
			$db=self::deal_arr(scandir($root),$root);
			foreach ($db[0] as $rs)
			{
				@unlink($root.'/'.$rs[0]);
			}
			$this->success('清理成功');
		}
	}
	
	public function deal_arr($data,$root)
	{
		if(!$data)
		{
			die('【scandir】函数不支持，请在Php.ini中找到去掉限制');
		}
		unset($data[0]);unset($data[1]);
		$a=[];
		foreach ($data as $key=>$val)
		{
			if(is_file($root.'/'.$val))
			{
				$a[$key]=['0'=>iconv("gb2312","utf-8",$val),'1'=>filemtime($root.'/'.$val),'2'=>formatBytes(filesize($root.'/'.$val))];
				$a[$key][3]=encode($a[$key][0]);
			}
			else
			{
				unset($data[$key]);
			}
		}
		rsort($a);
		return ['0'=>$a];
	}
}