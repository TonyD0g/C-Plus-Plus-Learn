<?php
if(!defined('IN_CMS')) exit;
$num=preg_match_all("/\{include(.*?)}/",$this->content,$match);
if($num)
{
	for($i=0;$i<$num;$i++)
	{
		$arr=$this->parse_attr($match[1][$i]);
		$oldname=$arr['file'];
		$root=(substr($arr['file'],0,7)=='mobile/')?'mobile/':'';
		$md5name=$this->compileDir.$root.substr(md5($arr['file']),8,16).".php";
		$content=$this->content;
		$this->parse_include_twos($oldname,$md5name);
		$this->content=$content;
		unset($content);
		$file='<?php include $this->tp->parse_include_twos("'.$oldname.'");?>';
		$this->content=str_replace($match[0][$i],$file."\r\n",$this->content);
	}
	$this->parse_include();
}