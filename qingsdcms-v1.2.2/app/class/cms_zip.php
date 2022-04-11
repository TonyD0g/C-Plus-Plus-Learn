<?php
final class cms_zip
{
	public static function check()
	{
		if(!function_exists('gzopen'))
		{
			exit('zlib扩展未启用');
		}
		require_once APP_SYS_PATH."/class/zip/pclzip.php";
	}

	public static function zip($from,$new)
	{
		self::check();
		$zip=new PclZip($new);
		$result=$zip->create($from,PCLZIP_OPT_REMOVE_PATH,$from);
		if($result==0)
		{
			return "Error : ".$zip->errorInfo(true);
		}
		else
		{
			return true;
		}
	}

	public static function unzip($from,$to)
	{
		self::check();
		$zip=new PclZip($from);
		$result=$zip->extract(PCLZIP_OPT_PATH,$to,PCLZIP_OPT_REPLACE_NEWER);
		if($result==0)
		{
			return "Error : ".$zip->errorInfo(true);
		}
		else
		{
			return true;
		}
	}
}