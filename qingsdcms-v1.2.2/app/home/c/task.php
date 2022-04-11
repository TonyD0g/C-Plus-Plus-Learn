<?php
if(!defined('IN_CMS')) exit;

$time=time();
$rs=$this->db->load("select id from cms_show where isshow=0 and isauto=1 and createdate<=$time limit 10");
if($rs)
{
	foreach($rs as $key=>$val)
	{
		$this->db->update("cms_show","id=".$val['id']."",['isshow'=>1,'isauto'=>0]);
	}
}
unset($time);
unset($rs);