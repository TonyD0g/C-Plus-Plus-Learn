<?php
function thumb($file,$width=200,$height=200,$type=1)
{
	if($type==0 || C('thumb_auto')==0)
	{
		return $file;
	}
	if(isempty($file))
	{
		return '';
	}
	if(strpos($file,'://'))
	{
		return $file;
	}
	if(preg_match(WEB_ROOT."upfile(.*)\$/",$file,$matches))
    {
        $file=$matches[0];
    }
    if(!file_exists(SYS_PATH.$file))
    {
    	return WEB_ROOT.$file;
    }
    $newpic=dirname($file).'/thumb_'.$width.'_'.$height.'_'.basename($file);
    if(!file_exists(SYS_PATH.$newpic)||filemtime(SYS_PATH.$newpic)<filemtime(SYS_PATH.$file))
    {
    	$image=new cms_image();
    	return $image->thumb($file,$width,$height,$newpic);
    }
    return WEB_ROOT.$newpic;
}

function get_field($id,$db)
{
    $rs=$db->load("select * from cms_field where mid=$id and isshow=1 order by ordnum,id");
    return ($rs)?$rs:'';
}

function field($a,$b,$c)
{
    if(isset($c[$b]))
    {
        $rs=$c[$b];
        switch ($rs['field_type'])
        {
            case '2':
                return date('Y-m-d',$a);
                break;
            case '10':
                return deal_checkbox($a,$rs['field_list']);
                break;
            case '9':
            case '11':
                return deal_defaults($a,$rs['field_list']);
                break;
            default:
                return $a;
                break;
        }
    }
    else
    {
        return $a;
    }
}

function deal_field_show($field,$record)
{
    $data=[];
    foreach($field as $key=>$rs)
    {
        switch ($rs['field_type'])
        {
            case '2':
                $data[$rs['field_title']]=date('Y-m-d',$record[$rs['field_key']]);
                break;
            case '10':
                $data[$rs['field_title']]=deal_checkbox($record[$rs['field_key']],$rs['field_list']);
                break;
            case '9':
            case '11':
                $data[$rs['field_title']]=deal_defaults($record[$rs['field_key']],$rs['field_list']);
                break;
            case '13':
                $data[$rs['field_title']]=deal_piclist($record[$rs['field_key']]);
                break;
            case '15':
                $data[$rs['field_title']]=deal_downlist($record[$rs['field_key']]);
                break;
            default:
                $data[$rs['field_title']]=$record[$rs['field_key']];
                break;
        }
    }
    return $data;
}

function deal_checkbox($a,$b)
{
    $r='';
    $c=explode(',',$b);
    foreach($c as $key=>$val)
    {
        list($d,$e)=explode('|', $val);
        if(strpos('-_-,'.$a.',',','.$e.','))
        {
            $r.=$d.' ';
        }
    }
    return $r;
}

function deal_defaults($a,$b)
{
    $c=explode(',',$b);
    foreach($c as $key=>$val)
    {
        list($d,$e)=explode('|', $val);
        if($e==$a)
        {
            return $d;
        }
    }
}

function deal_piclist($a)
{
    $str='';
    $b=jsdecode($a);
    if(is_array($b))
    {
        foreach($b as $key=>$val)
        {
            $str.='<a href="'.$val['image'].'" class="ui-lightbox"><img src="'.$val['image'].'"></a><br>';
        }
    }
    return $str;
}

function deal_downlist($a)
{
    $str='';
    $b=jsdecode($a);
    if(is_array($b))
    {
        foreach($b as $key=>$val)
        {
            $str.='<a href="'.$val['url'].'" target="_blank">'.$val['name'].'</a><br>';
        }
    }
    return $str;
}

function redkey($a,$b)
{
    return str_replace($b,'<span class="ui-text-red">'.$b.'</span>',$a);
}