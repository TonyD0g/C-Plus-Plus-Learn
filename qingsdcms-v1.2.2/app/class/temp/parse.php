<?php
if(!defined('IN_CMS')) exit;
$num=preg_match_all("/\{block\([\"]?([^\"]+)[\"]\)\}/",$this->content,$match);
if($num)
{
	for($i=0;$i<$num;$i++)
	{
		$str='<?php $data_block=include("theme/'.C('theme_dir').'/block/'.$match[1][$i].'.php");echo $data_block[0];?>';
		$this->content=str_replace($match[0][$i],$str,$this->content);
	}
}
$this->content=preg_replace_callback('/{no}(.*?){\/no}/is',array($this,'parseLiteral'),$this->content);
$this->content=preg_replace('/\{if\s+(.*?)\}/','<?php if ($1) { ?>',$this->content);
$this->content=preg_replace('/\{elseif\s+(.*?)\}/','<?php } elseif ($1) { ?>',$this->content);
$this->content=preg_replace('/\{else\}/','<?php } else { ?>',$this->content);
$this->content=preg_replace('/\{\/if\}/','<?php }?>',$this->content);
$this->content=preg_replace('/\{foreach\s+(\S+)\s+as\s+(\S+)\}/','<?php foreach($1 as $2) { ?>',$this->content);
$this->content=preg_replace('/\{foreach\s+(\S+)\s+as\s+(\S+)\s*=>\s*(\S+)\}/','<?php foreach($1 as $2 => $3) { ?>',$this->content);
$this->content=preg_replace('/\{\/foreach\}/','<?php }?>',$this->content);
$num=preg_match_all("/\{for(.*?)\}(.*?){\/for\}/s",$this->content,$match);
if($num)
{
	for($i=0;$i<$num;$i++)
	{
		$a=$match[0][$i];
		$b=$this->get_for_param($match[1][$i]);
		$c=$match[2][$i];
		$str="<?php for ($b){?>$c<?php }?>";
		$this->content=str_replace($a,$str,$this->content);
	}
}
$num=preg_match_all("/\{switch\s+(.*?)\}(.*?){\/switch\}/s",$this->content,$match);
if($num)
{
	for($i=0;$i<$num;$i++)
	{
		$a=$match[0][$i];
		$b=$match[1][$i];
		$c=str_replace("\r\n","",$match[2][$i]);
		$c=ltrim($c," ");
		$c=ltrim($c,"　");
		$str="<?php switch ($b){?>$c<?php }?>";
		$this->content=str_replace($a,$str,$this->content);
	}
}

$this->content=preg_replace('/\{case\s+(.*?)\}/','<?php case $1: ?>',$this->content);
$this->content=preg_replace('/\{\/case\}/','<?php break; ?>',$this->content);
$this->content=preg_replace('/\{default}/','<?php default: ?>',$this->content);
$this->content=self::deal_loop();
$this->content=preg_replace('/cms\[(.*?)\]/i','C(strtoupper(\'$1\'))',$this->content);
$this->content=preg_replace('/\$(\w+)\.(\w+)/is','$$1[\'$2\']',$this->content);
$this->content=preg_replace('/\{\$(.*?)\}/','<?php echo $$1;?>',$this->content);
$this->content=preg_replace('/\{php\s+(.*?)\}/','<?php $1;?>',$this->content);
$this->content=preg_replace('/\{:(.*?)}/','<?php echo $1;?>',$this->content);
$this->content=preg_replace('/\{([a-zA-Z0-9_])}/','<?php echo $1;?>',$this->content);
$this->content=preg_replace('/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s','<?php echo $1;?>',$this->content);
$this->content=preg_replace('/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/','<?php echo $1;?>',$this->content);
$this->content=preg_replace_callback('/<!--###nocompile(\d+)###-->/is',array($this,'restoreLiteral'),$this->content);

$this->content=preg_replace('#<!--[^\!\[]*?(?<!\/\/)-->#','',$this->content);