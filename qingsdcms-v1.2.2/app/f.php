<?php
#系统资源
function C($a=null)
{
	static $_config=[];
	if(empty($a))
	{
		return $_config;
	}
	if(is_string($a))
	{
		if(!strpos($a,'.'))
		{
			$a=strtoupper($a);
			return isset($_config[$a])?$_config[$a]:null;
		}
		else
		{
			$a=explode('.',$a);
			$a[0]=strtoupper($a[0]);
			return isset($_config[$a[0]][$a[1]])?$_config[$a[0]][$a[1]]:null;
		}
	}
	if(is_array($a))
	{
		$_config=array_merge($_config,array_change_key_case($a,CASE_UPPER));
		return null;
	}
	return null;
}

#F函数（get和post）
function F($a,$b='')
{
	$a=strtolower($a);
	if(!strpos($a,'.'))
	{
		$method='other';
	}
	else
	{
		list($method,$a)=explode('.',$a,2);
	}
	switch($method)
	{
		case 'get':
			$input=$_GET;
			break;
		case 'post':
			$input=$_POST;
			break;
		case 'other':
			switch(REQUEST_METHOD)
			{
				case 'GET':
					$input=$_GET;
					break;
				case 'POST':
					$input=$_POST;
					break;
				default:
					return '';
					break;
			}
			break;
		default:
			return '';
			break;
	}
	$data=isset($input[$a])?$input[$a]:$b;
	if(is_string($data))
	{
		$data=enhtml(trim($data));
	}
	return $data;
}

#模板资源
function T($a)
{
	$b=isset(C('sys_theme_config')[$a])?C('sys_theme_config')[$a]:'';
	if($b=='') exit('【'.$a.'】模板配置不存在');
	return $b;
}

#解决部分服务器获取不到：REQUEST_URI
function getlocal()
{
	if(isset($_SERVER['REQUEST_URI']))
	{ 
		$_SERVER['REQUEST_URI']=$_SERVER['REQUEST_URI'];
	}
	elseif(isset($_SERVER['HTTP_X_REWRITE_URL']))
	{
		$_SERVER['REQUEST_URI']=$_SERVER['HTTP_X_REWRITE_URL'];
	}
	elseif(isset($_SERVER['REDIRECT_URL']))
	{ 
		$_SERVER['REQUEST_URI']=$_SERVER['REDIRECT_URL'];
	}
	elseif(isset($_SERVER['ORIG_PATH_INFO']))
	{
		$_SERVER['REQUEST_URI']=$_SERVER['ORIG_PATH_INFO'];
		if(!empty($_SERVER['QUERY_STRING']))
		{
			$_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING'];
		}
	}
	return enhtml(mb_convert_encoding($_SERVER['REQUEST_URI'],'utf-8','gbk'));
}

#Pjax判断
function is_pjax()
{
	$a=false;
	if(isset($_GET['_pjax']) && !isempty($_GET['_pjax']))
	{
		$a=true;
	}
	return $a;
}

#去掉bom
function require_bom($a)
{
	if(!is_file($a))
	{
		exit("无法加载文件：{$a}");
	}
	$b=file_get_contents($a);
	$c[1]=substr($b,0,1);
    $c[2]=substr($b,1,1);
    $c[3]=substr($b,2,1);
	if(ord($c[1])==239 && ord($c[2])==187 && ord($c[3])==191)
	{
		$d=substr($b,3);
        file_put_contents($a,$d);
	}
	unset($b);
	unset($c);
	return (array)require($a);
}

function jsencode($a)
{
	return str_replace('\t','',json_encode($a,320));
}

function jsdecode($a,$b=0)
{
	if(isempty($a))
	{
		return false;
	}
	if($b==1)
	{
		$a=str_replace("\r","\\r",$a);
		$a=str_replace("\n","\\n",$a);
	}
	return json_decode($a,true);
}

function is_really_writable($file)
{
    if(is_dir($file))
    {
        $file=rtrim($file,'/').'/'.'cmstest.html';
        if(($fp = @fopen($file,'ab'))===FALSE)
        {
            return FALSE;
        }
        fclose($fp);
        @chmod($file,0777);
        unlink($file);
        return TRUE;
    }
    elseif(($fp = @fopen($file, 'ab'))===FALSE)
    {
        return FALSE;
    }
    fclose($fp);
    return TRUE;
}

function md5_16($a)
{
	return substr(md5($a),8,16);
}

function savefile($file,$data)
{
	if(!is_really_writable($file))
	{
		return false;
	}
	else
	{
		if(@file_put_contents($file,$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

#判断是否空值
function isempty($a)
{
	return (SYSVERSION)?($a==''):(empty($a));
}

function session($a,$b='')
{
	$prefix=C('PREFIX').$a;
	if($b=='')
	{
		return isset($_SESSION[$prefix])?$_SESSION[$prefix]:null;
	}
	elseif($b=='[del]')#删除单个变量
	{
		unset($_SESSION[$prefix]);
	}
	elseif($b=='[delete]')#删除全部
	{
		session_unset();
        session_destroy();
	}
	else
	{
		$_SESSION[$prefix]=$b;
	}
}

function cookie($a,$b='')
{
	$a=!isempty($a)?$a:'';
	$b=!isempty($b)?$b:'';
	$prefix=C('PREFIX').$a;
	if($b=='')
	{
		return isset($_COOKIE[$prefix])?$_COOKIE[$prefix]:null;
	}
	elseif($b=='[del]')
	{
		setcookie($prefix,'',time()-1,'/','','');
	}
	else
	{
		setcookie($prefix,$b,time()+86400,'/','','');
	}
}

function theme_html($a)
{
	return str_replace(['&',"'",'"','<','>'],['&amp;','&#39;','&#34;','&lt;','&gt'],$a);
}

function enhtml($a)
{
	if(is_array($a))
	{
		foreach($a as $key=>$val)
		{
			$a[$key]=enhtml($val);
		}
	}
	else
	{
		$a=($a!='')?$a:'';
		$a=filterExp(htmlspecialchars(stripslashes($a),ENT_QUOTES,'UTF-8'));
		$a=str_replace('&amp;','&',$a);
		return $a;
	}
}

function dehtml($a)
{
	return htmlspecialchars_decode($a);
}

function nohtml($a)
{
	if(is_string($a))
	{
		$a=dehtml($a);
		$a=str_replace('_cms_content_page_','',$a);
		$a=str_replace('　','',$a);
		$a=str_replace('	','',$a);
		$a=str_replace("\r\n",'',$a);
		$a=preg_replace("@<style(.*?)</style>@is",'',$a);
		$a=trim(strip_tags($a));
	}
	return $a;
}

function deal_even($a)
{
	if(is_array($a))
	{
		foreach($a as $key=>$val)
		{
			$a[$key]=deal_even($val);
		}
	}
	else
	{
		#开始检测
		$eventlist='script|iframe|marquee|import\(|command\(|msgbox\(|prompt\(|confirm\(|expression|alert\(|onblur|onchange|onclick|onfocus|onload|onmouse|onselect|onsubmit|onunload|onkey|onresize|onerror|onscroll|ondbkclick|oncontextmenu|ondrag|onLose|onseek|onstart|onstop|onabort|onactivate|onafter|onbefore|onbounce|oncontrol|oncopy|oncut|ondata|ondeactivate|onended|onfinish|onhelp|oninput|onoffline|ononline|onpaste|onpause|eval\(|document\.|fromCharCode|\(\)\;}';
		$num=preg_match_all('/^'.$eventlist.'/i',rawurldecode(htmlspecialchars_decode($a)),$match);
		if($num)
		{
			echo jsencode(['state'=>'error','msg'=>'请勿提交非法参数']);
			exit();
		}
	}
}

function filterExp($a)
{
	return (preg_match('/^select|insert|create|update|delete|alter|union|sleep|payload|_schema|hex\(|replace\(|concat\(|assert|cmdshell|wshshell|extractvalue|benchmark|greatest|least|passthru|popen|between|get_lock|updatexml|getenv|\'|\\\\|\.\.\/|\.\/|load_file|outfile|dumpfile/i',$a))?'':$a;
}


function check_bad($str)
{
	$num=preg_match_all("/(phpinfo|pack\(|str_rot13|system\(|eval\(|request\[|execute\(|file_put_contents|file_get_contents|exec\(|chroot\(|scandir\(|chgrp\(|chown\(|shell_exec\(|pcntl_exec\(|proc_open\(|popen\(|fget\(|putenv\(|proc_get_status|error_log\(|dll\(|pfsockopen\(|syslog\(|readlink\(|symlink\(|stream_socket_server|preg_replace\(|delfolder\(|unlink\(|mkdir\(|fopen\(|fread\(|fwrite\(|fputs\(|tmpfile\(|flock\(|load_file\(|outfile\(|chmod\(|delete\(|payload\(|fclose\(|copy\(|feof\(|fgetc\(|fgets\(|assert\(|cmdshell\(|wshshell\(|_post\[|_get\[|_file\(|create_function|call_user_func|passthru\(|array_walk|getenv\(|register_|escapeshellcmd\(|rmdir\(|rename\(|readfile\(|debug_|session_|array_filter|array_flip|array_merge|shell_|parse_str|glob\(|ini_get\(|ini_set\(|ini_alter()\(|ini_restore\(|import_|move_uploaded_file\(|get_defined_|get_included_)/Ui",str_replace(["'.'","\".\""],"",$str),$match);
	return $num?$num:0;
}

function getint($a,$b=0)
{
	if(is_array($a))
	{
		$a=implode($a);
	}
	$c=($a!='')?(!preg_match("/^[-0-9.]+$/",$a))?$b:substr($a,0,11):$b;
	return floatval($c);
}

#格式化小数
function getprice($a,$b=2)
{
	return number_format($a,$b,'.','');
}

function iif($a,$b,$c)
{
	return $a?$b:$c;
}

#cut函数
function cut($a,$b,$c=0)
{
	$d=mb_strcut($a,0,$b,'UTF8');
	if(strlen($a)>$b && $c==1) $d.='…';
	return $d;
}

#getip函数
function getip($type=0)
{
    $type=$type?1:0;
    static $ip=NULL;
    if($ip!==NULL) return $ip[$type];
    if(isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        $cip=$_SERVER["HTTP_CLIENT_IP"];
    }
    elseif(isset($_SERVER['HTTP_X_REAL_IP']))
    {
        $ip=$_SERVER['HTTP_X_REAL_IP'];     
    }
    elseif(isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $arr=explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos=array_search('unknown',$arr);
        if(false!==$pos) unset($arr[$pos]);
        $ip=trim($arr[0]);
    }
    elseif(isset($_SERVER['REMOTE_ADDR']))
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    $long=sprintf("%u",ip2long($ip));
    $ip=$long?array($ip,$long):array('0.0.0.0',0);
    return enhtml($ip[$type]);
}

#跳转
function gourl($a,$b=0,$c='')
{
	$c=(isempty($c))?"系统将在{$b}秒之后自动跳转到【{$a}】":$c;
	if($b===0)
	{
		header('Location:'.$a);
		exit();
	}
	else
	{
		header("refresh:{$b};url={$a}");
		echo $c;
	}
}

function ismobile()
{
	if(isweixin())
	{
		return true;
	}
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    if(isset($_SERVER['HTTP_VIA']))
    {
        return stristr($_SERVER['HTTP_VIA'], "wap")?true:false;
    }
    if(isset($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords=array("android","phone","ipod","mqqbrowser","blackberry","nokia","windowsce","symbian","lg","ucweb","skyfire","webos","incognito","blackberry","mobile","bada"); 
        if(preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
	}
    if(isset($_SERVER['HTTP_ACCEPT']))
    { 
        if((strpos($_SERVER['HTTP_ACCEPT'],'vnd.wap.wml')!==false)&&(strpos($_SERVER['HTTP_ACCEPT'],'text/html')===false||(strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml')<strpos($_SERVER['HTTP_ACCEPT'],'text/html'))))
        {
            return true;
        }
    }
    return false;
}

#是否微信浏览器
function isweixin()
{
	return (bool)(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'micromessenger'));	
}

#获取内容中所有图片，返回数组
function get_all_picurl($a,$b='')
{
	#去掉反斜杠
	$a=stripslashes($a);
	$num=preg_match_all('/<img.*?src="(.*?)".*?>/is',$a,$match);
	if($num)
	{
		$d=[];
		for($i=0;$i<$num;$i++)
		{
			if(isempty($b))
			{
				$d[$i]=$match[1][$i];
			}
			else
			{
				if(!strpos($match[1][$i],$b)&&strpos($match[1][$i],"://"))
				{
					$d[$i]=$match[1][$i];
				}
			}
			
		}
		return array_unique($d);
	}
	else
	{
		return '';
	}
}

#字符串加密解密
function authcode($string,$type='D',$key='',$expiry=0)
{
	$ckey_length=4;
	$key=md5($key);
	$keya=md5(substr($key,0,16));
	$keyb=md5(substr($key,16,16));
	$keyc=$ckey_length?($type=='D'?substr($string,0,$ckey_length):substr(md5(microtime()),-$ckey_length)):'';
	$cryptkey=$keya.md5($keya.$keyc);
	$key_length=strlen($cryptkey);
	$string=$type=='D'?base64_decode(substr($string,$ckey_length)):sprintf('%010d',$expiry?$expiry+time():0).substr(md5($string.$keyb),0,16).$string;
	$string_length=strlen($string);
	$result='';
	$box=range(0,255);
	$rndkey=array();
	for($i=0;$i<=255;$i++)
	{
		$rndkey[$i]=ord($cryptkey[$i%$key_length]);
	}
	for($j=$i=0;$i<256;$i++)
	{
		$j=($j+$box[$i]+$rndkey[$i])%256;
		$tmp=$box[$i];
		$box[$i]=$box[$j];
		$box[$j]=$tmp;
	}
	for($a=$j=$i=0;$i<$string_length;$i++)
	{
		$a=($a+1)%256;
		$j=($j+$box[$a])%256;
		$tmp=$box[$a];
		$box[$a]=$box[$j];
		$box[$j]=$tmp;
		$result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
	}
	if($type=='D')
	{
		if((substr($result,0,10)==0||substr($result,0,10)-time()>0)&&substr($result,10,16)==substr(md5(substr($result,26).$keyb),0,16))
		{
			return substr($result,26);
		}
		else
		{ 
			return '';
		}
	}
	else
	{  
		return $keyc.str_replace('=','',base64_encode($result));
	}
}

#文件单位
function formatBytes($a)
{ 
	$units=['B','K','M','G','TB']; 
	for($i=0;$a>=1024&&$i<4;$i++)
	{
		$a/=1024;
	}
	return round($a,2).' '.$units[$i]; 
}

function versiontonum($a)
{
    $b=explode(".",$a);
    if(count($b)<=2)
    {
    	return $a;
    }
    else
    {
    	$c=$b[0];
    	unset($b[0]);
    	$d=implode('',$b);
    	return (float)($c.".".$d);
    }
}

function badwords($a,$b)
{
	if(is_array($a))
	{
		foreach($a as $key => $val)
		{
			$a[$key]=badwords($val);
		}
	}
	else
	{
		$a=strtr($a,$b);
	}
	return $a;
}

#创建文件夹(无限级)
function mkfolder($a)
{
	if(!is_dir($a))
	{
		return mkdir($a,0777,true);
	}
}

#删除文件夹(包含子目录)
function delfolder($a)
{
    $a=str_replace('','/',$a);
    $a=substr($a,-1)=='/'?$a:$a.'/';
    if(!is_dir($a))
    {
        return false;
    }
    $b=opendir($a);
    while(false!==($file=readdir($b)))
    {
        if($file=='.'||$file=='..')
        {
            continue;
        }
        if(!is_dir($a.$file))
        {
            unlink($a.$file);
        }
        else
        {
            delfolder($a.$file);
        }
    }
    closedir($b);
    return rmdir($a);
}

function filter_query($var)
{
	return deal_str($var);
}

function deal_str($a)
{
	if(is_array($a))
	{
		foreach($a as $key=>$val)
		{
			$a[$key]=deal_str($val);
		}
	}
	else
	{
		$a=addslashes($a);
	}
	return $a;
}

#副域名处理，使用301重定向
function domain()
{
	#副域名处理，使用301重定向
	if(C('web_domain')!='' && C('web_domains')!='')
	{
		if(in_array($_SERVER['HTTP_HOST'],explode("\r\n",C('web_domains'))))
		{
			if($_SERVER['HTTP_HOST']!=C('web_domain'))
			{
				$url=THIS_URL;
				Header("HTTP/1.1 301 Moved Permanently");
				Header("Location:$url");
				exit();
			}
			
		}
	}
}

#是否手机域名访问
function iswap()
{
	$_ismobile=false;
	if(C('mobile_open')==1)
	{
		if(!isempty(C('mobile_domain')))
		{
			list($sys_domain)=explode(':',$_SERVER['HTTP_HOST'],2);
			if(strtolower(C('mobile_domain'))==$sys_domain)
			{
				$_ismobile=true;
			}
			unset($sys_domain);
		}
	}
	return $_ismobile;
}

#栏目Url
function cateurl($a)
{
	$cate=C('class');
	$a=(string)$a;
	if(!isset($cate[$a]))
	{
		return '';
	}
	$d=$cate[$a];
	$b=(is_array($d))?$d['cate_url']:'';
	$c=0;
	if(is_array($d))
	{
		if($d['cate_type']=='-2')
		{
			return $b;
		}
	}
	return UU($a,$b);
}

#URL组装
function U($a='',$b='',$c=1)
{
	return geturl($a,$b,$c);
}

#$type=1，为插件使用
function geturl($url='',$vars='',$type=1)
{
	$strs=cms_route::url($url,$vars);
	$arr=parse_url($url);	
	$url=!empty($arr['path'])?$arr['path']:ACTION_NAME;
	if(isset($arr['fragment']))
	{
		$anchor=$arr['fragment'];
	}
	$query=[];
	if(isset($arr['query']))
	{
		parse_str($arr['query'],$query);
	}
	if(is_string($vars))
	{
		parse_str($vars,$vars);
	}
	elseif(!is_array($vars))
	{
		$vars=[];
	}
	#合并两个数组
	$vars=array_merge($query,$vars);
	$umid=C('url_mid');
	if($url)
	{
		$url=trim(str_replace($umid,'/',$url),'/');
		$path=explode('/',$url);
		if(!empty($path))
		{
			$a=end($path);
			array_pop($path);
		}
		else
		{
			$a=ACTION_NAME;
		}
		if(!empty($path))
		{
			$c=end($path);
			array_pop($path);
		}
		else
		{
			$c=CONTROLLER_NAME;
		}
		if(!empty($path))
		{
			$m=end($path);
			array_pop($path);
		}
		else
		{
			$m=MODULE_NAME;
		}
		$p='';
		if(!PLUG_NAME)
		{
			if($m=='plug')
			{
				$p=$c;
				$c=$a;
				$a='index';
			}
		}
		else
		{
			$p=PLUG_NAME;
		}
	}
	$str='';
	if(C('url_mode')==1)
	{
		$str.="c=$c&a=$a";
		if($m!='home')
		{
			$str="m=$m&".$str;
		}
		if($p)
		{
			$str.="&p=$p";
		}
		$str="?".$str;
		$param=http_build_query($vars);
		if($param!='')
		{
			$str.='&'.$param;
		}
	}
	else
	{
		if($strs)
		{
			$str=$strs;
		}
		else
		{
			$param=http_build_query($vars);
			$param=str_replace(['=','&'],$umid,$param);
			$str="$c$umid$a$umid";
			$str=($param!='')?("$c$umid$a$umid".$param):(trim(trim($str,'/'),$umid));
			$str=($p&&$type==1)?("$m$umid$p$umid".$str):("$m$umid".$str);
		}
		$str=$str.C('url_ext');
	}
	if(C('url_mode')==2)
	{
		$str='index.php'.(isempty(C('pathinfo'))?('/'):('?'.C('pathinfo').'=')).$str;
	}
	if(isset($anchor))
	{
		$str.='#'.$anchor;
	}
	return WEB_ROOT.$str;
}

#$d是否使用主域名
function N($a,$b=0,$c='',$d=0)
{
	if($b==0 || $b=='') $b=C('URL_MODE');
	if(strlen($c))
	{
		if($b==1)
		{
			$c='&'.$c;
		}
		else
		{
			$umid=C('url_mid');
			$c=str_replace(['=','&'],$umid,$c);
			$c=$umid.$c;
		}
	}
	$webroot=WEB_ROOT;
	if($d==1)
	{
		$webroot=C('web_http').C('web_domain').WEB_ROOT;
	}
	switch($b)
	{
		case '1':
			return $webroot.'?m='.$a.$c;
			break;
		case '2':
			return $webroot.'index.php'.((isempty(C('pathinfo')))?'/':('?'.C('pathinfo').'=')).$a.$c.C('URL_CATE_EXT');
			break;
		case '3':
			return $webroot.$a.$c.C('URL_CATE_EXT');
			break;
	}
}

function UU($a,$b='')
{
	$webroot=WEB_ROOT;
	$umid=C('url_mid');
	if(!isempty($b))
	{
		$str="$b$umid";
		if(C('url_mode')==1)
		{
			$str="?m=$b";
			$str=WEB_ROOT.$str;
		}
		else
		{
			if(C('url_mode')==2)
			{
				$str='index.php'.((C('pathinfo')=='') ? '/' : ('?'.C('pathinfo').'=')).$str;
			}
			$str=trim(trim($str,'/'),$umid);
			$str=$webroot.$str.C('url_cate_ext');
		}
		return $str;
	}
	else
	{
		if(C('url_mode')==1)
		{
			return U('home/index/cate','classid='.$a);
		}
		else
		{
			if(!isempty(C('url_list')))
			{
				if(C('url_mode')==2)
				{
					$str='index.php'.(((C('pathinfo')=='') ? '/'.C('url_list'):'?'.C('pathinfo').'='.C('url_list')))."$umid$a$umid";
				}
				else
				{
					$str=C('url_list')."$umid$a$umid";
				}
				$str=trim(trim($str,'/'),$umid);
				$str=$webroot.$str.C('url_cate_ext');
				return $str;
			}
			else
			{
				return U('home/index/cate','classid='.$a);
			}
		}
	}
}

#内容URL
function showurl($a,$b='',$c=0)
{
	return link_url($a,$b,$c);
}

#内容URL
function link_url($a,$b,$c)
{
	/*
	a：内容ID
	b：是别名
	c：栏目ID
	*/
	$webroot=WEB_ROOT;

	if(isempty($b))
	{
		if(C('url_mode')==1)
		{
			return U('home/index/show','id='.$a.'');
		}
		else
		{
			#获取内容所在类别的别名
			$alias=get_catealias($c);
			$pid=explode(',',get_tree_parent($c));
			#获取顶级分类ID
			$topid=$pid[0];
			#如果当前栏目没有别名，则获取顶级栏目的别名，如果顶级栏目没有别名，则调用系统内容的映射
			$alias=get_cate_self($alias,$topid,'cate_url',C('url_show'));
			#全部使用一级别名作为URL（弃用）
			#$alias=get_cate_info($topid,'cate_url','');
			#$alias=!isempty($alias)?$alias:C('url_show');
			$domain=$webroot;
			if(!isempty($alias))
			{
				$prefix='';
				if(C('url_mode')==2)
				{
					$prefix=isempty(C('pathinfo'))?'index.php/':'index.php?'.C('pathinfo').'=';
				}
				return $domain.$prefix.$alias.C('url_mid').$a.C('url_ext');
			}
			else
			{
				return U('home/index/show','id='.$a.'');
			}
		}
	}
	else
	{
		switch (C('url_mode'))
		{
			case '1':
				return WEB_ROOT.'?m='.$b;
				break;
			case '2':
				return WEB_ROOT.'index.php'.((C('pathinfo')=='')?'/':('?'.C('pathinfo').'=')).$str.$b.C('url_ext');
				break;
			default:
				return WEB_ROOT.$str.$b.C('url_ext');
				break;
		}
	}
}

#内容分页
function pagelist($a,$b=0,$c=5)
{
	if($b<=1)
	{
		return '';
	}
	$page=new cms_page(1,$b,20,$a);
	return $page->pageList($c);
}

function deal_sqlite($sql)
{
	if(!DB_TYPE)
	{
		$sql=str_replace('into','\u0069\u006e\u0074\u006f',$sql);
		$sql=str_replace('NOT NULL AUTO_INCREMENT','PRIMARY KEY AUTOINCREMENT NOT NULL',$sql);
		$sql=str_replace('ENGINE=MyISAM DEFAULT CHARSET=utf8','',$sql);
		$sql=preg_replace("/,PRIMARY KEY \((.*?)\)/s",'',$sql);
		$sql=str_replace(['varchar','mediumtext'],'TEXT',$sql);
		$sql=preg_replace("/ (int|smallint|tinyint|decimal)(.*?) /s",' INTEGER ',$sql);
		$sql=str_replace('\u0069\u006e\u0074\u006f','into',$sql);
	}
	return $sql;
}

#栏目导航高亮
function is_active($classid,$pid=0,$style=' class="active"')
{
	return(in_array($classid,explode(',',$pid)))?$style:'';
}

function get_cate_info($id,$field,$default='')
{
	$data=C('class');
	return isset($data[$id])?$data[$id][$field]:$default;
}

#获取栏目父ID
function get_followid($id)
{
	return get_cate_info($id,'followid',0);
}

#获取栏目名称
function get_catename($id)
{
	return get_cate_info($id,'cate_name');
}

#获取栏目别名
function get_catealias($id)
{
	if(get_cate_info($id,'cate_type')==-2)
	{
		return '';
	}
	return get_cate_info($id,'cate_url');
}

#获取某一分类的子类数量
function get_sonid_num($id)
{
	return get_cate_info($id,'child',0);
}

#查找某一分类的所有子类
function get_sonid_all($id)
{
	$str='';
	$dt=explode(',',$id);
	foreach($dt as $key => $val)
	{
		$str.=','.get_cate_info($val,'sonid',$val);
	}
	return trim($str,',');
}

#查找某一分类的所有父类
function get_tree_parent($id)
{
	return get_cate_info($id,'parent',$id);
}

function get_cate_self($t0,$t1,$t2,$t3)
{
	if(strlen($t0))
	{
		return $t0;
	}
	else
	{
		if(get_cate_info($t1,'cate_type')==-2)
		{
			return $t3;
		}
		$t4=get_cate_info($t1,$t2,'');
		return (strlen($t4))?$t4:$t3;
	}
}

#后台相关
function is_admin()
{
	$info=session('admin_info');
	return (isempty($info)?0:$info['adminid']);
}

function get_admin_info($a)
{  
	$info=session('admin_info');
	return (isempty($info)?'':$info[$a]);
}

#会员相关(预留)
function is_user()
{
	$info=session('user_info');
	return (empty($info)?0:$info['id']);
}

function get_user_info($a)
{  
	$info=session('user_info');
	return $info[$a];
}

#运行时间
function runtime()
{
	$GLOBALS['end']=['0'=>microtime(true),'1'=>memory_get_usage()];
	return 'Processed in '.getprice(($GLOBALS['end'][0]-$GLOBALS['begin'][0]),6).' s , Memory '.formatBytes(($GLOBALS['end'][1]-$GLOBALS['begin'][1])).' , '.$GLOBALS['query'].' queries';
}