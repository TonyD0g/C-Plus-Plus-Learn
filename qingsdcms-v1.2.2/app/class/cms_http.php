<?php
final class cms_http
{
	public static function check()
	{
		if(!function_exists('curl_init'))
	    {
			exit('curl_init函数未开启，请检查');
	    }
	}
	
	public static function get($url,$type=0,$timeout=1000,$head='')
	{
		self::check();
		$head=($head='')?FALSE:$head;
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch,CURLOPT_HEADER,$head);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		$result=curl_exec($ch);
		$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);
		curl_close($ch);
		return ($type==1)?['state'=>$code,'msg'=>$result]:$result;
	}

	public static function post($url,$data='',$type=0,$timeout=1000,$head=[])
	{
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		#设置header
		#curl_setopt($ch,CURLOPT_HEADER,$head);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$head);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_POST,TRUE);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$result=curl_exec($ch);
		$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);
		curl_close($ch);
		return ($type==1)?['state'=>$code,'msg'=>$result]:$result;
	}

}