<?php
final class cms_route
{
	/*
	url重组解决方案
	*/
	public static function url($key,$str)
	{
		$key=trim($key,'/');
		if($key=='')
		{
			return '';
		}
		$route=CMS_ROUTE;
		$arr=explode('/',$key);
		if(count($arr)==1)
		{
			$key=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.$key;
		}
		elseif(count($arr)==2)
		{
			$key=MODULE_NAME.'/'.$key;
		}
		$data=[];
		if(is_array($route) && count($route)>0)
		{
			if(is_string($str))
			{
				parse_str($str,$data);
			}
			elseif(!is_array($str))
			{
				$data=[];
			}
			$url=self::find($key,$route,$data);
			$url=$url?$url:'';
			return str_replace('/',C('url_mid'),$url);
		}
		else
		{
			return '';
		}
	}

	private static function find($key,$route,$data)
	{
		$url=array_search($key,$route);
		unset($route[$url]);
		if($url)
		{
			foreach($data as $kk=>$val)
			{
				$url=str_replace(['[:'.$kk.']', '<'.$kk.'?>',':'.$kk,'<'.$kk.'>'],$val,$url);
			}
			if(strpos($url,":"))
			{
				$url=self::find($key,$route,$data);
			}
			return $url;
		}
	}

	#自定义路由处理
	public static function route($url)
	{
		$route=CMS_ROUTE;
		if(is_array($route) && count($route)>0)
		{
			$k=[];
			foreach($route as $key=>$val)
			{
				$arr=explode('/',$key);
				$t=[];
				foreach($arr as $v)
				{
					if(substr($v,0,1)==":")
					{
						$t[]="(\/(?<".substr($v,1,strlen($v)-1).">\w+))";
					}
					else
					{
						$t[]=$v;
					}
				}
				$k[$key]=join($t);
			}
			foreach($k as $key=>$val)
			{
				if(preg_match('/^'.$val.'/u',$url,$match))
				{
					#根据key获取对应的路由隐射
					$str=$route[$key];
					define('ROUTE_KEY',$route[$key]);
					foreach($match as $kk=>$vv)
					{
		                if (is_string($kk)) 
		                {
		                	$str.="/".$kk."/".$vv;
		                }
		            }
		            $str=str_replace('/',C('url_mid'),$str);
	                return $str;
	            }
			}
		}
		define('ROUTE_KEY','');
		return '';
	}

	public static function geturl()
	{
		if(!isempty(C('pathinfo')))
		{				
			$pathinfo=F('get.'.C('pathinfo'));
		}
		else
		{
			$pathinfo=!empty($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:(!empty($_SERVER['ORIG_PATH_INFO'])?$_SERVER['ORIG_PATH_INFO']:'');
		}
		$pathinfo=str_replace($_SERVER['SCRIPT_NAME'],'',$pathinfo);
		if(!isempty(C('url_ext')))
		{
			if(strpos($pathinfo,C('url_ext')))
			{
				$pathinfo=substr($pathinfo,0,(strlen($pathinfo)-strlen(C('url_ext'))));
			}
		}
		$pathinfo=str_replace('/',C('url_mid'),$pathinfo);
		$pathinfo=trim($pathinfo,C('url_mid'));
		$pathinfo=trim($pathinfo,'/');
		return $pathinfo;
	}

	public static function check($route,$alias)
	{
		if(isset($route['m']))
		{
			#先检查是否为别名
			if(isset($alias[$route['m']]))
			{
				$route['alias']=$route['m'];
				$d=$alias[$route['m']];
				$route['m']='home';
				if($d['types']==1)
				{
					switch($d['app'])
					{
						case 'class':
							$route['c']='index';
							$route['a']='cate';
							$route['classid']=$d['sid'];
							$route['param']='classid';
							$_GET['classid']=$d['sid'];
							break;
						case 'show':
							$route['c']='index';
							$route['a']='show';
							$route['id']=$d['sid'];
							$route['param']='id';
							$_GET['id']=$d['sid'];
							break;
					}
				}
				else
				{
					$str=explode('/',$d['app']);
					$route['c']=$str[0];
					$route['a']=$str[1];
				}
			}
		}
		return $route;
	}

	public static function init()
	{
		$route=[];
		$alias=require('data/config/alias.php');
		$alias_key=self::get_alias($alias);
		
		if(C('url_mode')==1)
		{
			$pathinfo=$_SERVER['QUERY_STRING'];
			parse_str($pathinfo,$route);
			$route=self::check($route,$alias);
			if(isset($route['m']))
			{
				$routes=CMS_ROUTE;
				if(is_array($routes) && count($routes)>0)
				{
					if(isset($routes[$route['m']]))
					{
						$v=$routes[$route['m']];
						$arr=explode('/',$v);
						$route['m']=$arr[0];
						$route['c']=$arr[1];
						$route['a']=$arr[2];
					}
				}
			}
			$root=$pathinfo;
		}
		else
		{
			$pathinfo=self::geturl();
			#兼容旧版
			if(strpos("||".$pathinfo,"tags".C('url_mid')."id".C('url_mid').""))
			{
				$pathinfo=str_replace("tags".C('url_mid')."id".C('url_mid')."","tags".C('url_mid'),$pathinfo);
			}
			$root=$pathinfo;
			if(isempty($pathinfo))
			{
				$pathinfo=str_replace('/',C('url_mid'),sdcms::$url);
			}
			else
			{
				#将$_GET参数添加到$pathinfo中
				if(is_array($_GET))
				{
					#剔除掉s变量
					if(!isempty(C('pathinfo')))
					{				
						unset($_GET[C('pathinfo')]);
					}
					foreach($_GET as $key=>$val)
					{
						#剔除为空的变量
						if(!($val!=''))
						{
							$pathinfo=$pathinfo.C('url_mid').$key.C('url_mid').$val;
						}
					}
				}
				$pinfo=self::route($pathinfo);
				if($pinfo)
				{
					$pathinfo=$pinfo;
				}
				else
				{
					$m=(C('url_mid')=='/')?'\\'.C('url_mid'):C('url_mid');
					#通过正则提取page页数
					$num=preg_match_all("/(.+?)".$m."page".$m."(\d+)/s",$pathinfo,$match);
					if($num)
					{
						#页数赋值给数组
						$_GET['page']=$match[2][0];
						$pathinfo=$match[1][0];
					}
					#通过正则提取uid数值，作用：记录内容的分享者ID
					$num=preg_match_all("/(.+?)".$m."uid".$m."(\d+)/s",$pathinfo,$match);
					if($num)
					{
						#页数赋值给数组
						$_GET['uid']=$match[2][0];
						$pathinfo=$match[1][0];
					}
					#多余的参数被吃掉了，要补全
					#列表页正则映射
					$is_list=0;
					if(!isempty(C('url_list')))
					{
						$num=preg_match_all("/(".C('url_list').")".$m."(\d+)/s",$pathinfo,$match);
						if($num)
						{
							$last=substr($pathinfo,strlen($match[0][0]),strlen($pathinfo)-strlen($match[0][0]));
							$route['alias']=$match[0][0];
							$route['param']='classid';
							$_GET['classid']=$match[2][0];
							$pathinfo='home/index/cate/classid/'.$match[2][0].$last;
							$pathinfo=str_replace('/',C('url_mid'),$pathinfo);
							$is_list=1;
						}
					}

					#内容页映射
					if($is_list==0)
					{
						$num=preg_match_all("/\/([0-9a-z_-]*?)$m(\d+)/is",'/'.$pathinfo,$match);
						if($num)
						{
							if(array_key_exists($match[1][0],$alias_key))
							{
								$last=substr($pathinfo,strlen($match[0][0]),strlen($pathinfo)-strlen($match[0][0]));
								if($last)
								{
									$last=C('url_mid').$last;
								}
								$route['alias']=substr($match[0][0],1);
								$route['param']='id';
								$_GET['id']=$match[2][0];
								$pathinfo='home/index/show/id/'.$match[2][0].$last;
								$pathinfo=str_replace('/',C('url_mid'),$pathinfo);
							}
						}

					}
				}
			}

			$arr=explode(C('url_mid'),$pathinfo);
			$route['m']=array_shift($arr);

			if($route['m']=='plug')
			{
				$route['p']=enhtml(array_shift($arr));
				$route['c']=enhtml(array_shift($arr));
				$route['a']=enhtml(array_shift($arr));
			}
			else
			{
				#先检查是否为别名
				if(isset($alias[$route['m']]))
				{
					$route=self::check($route,$alias);
				}
				else
				{
					$route['c']=enhtml(array_shift($arr));
					$route['a']=enhtml(array_shift($arr));
				}
			}

			if(count($arr)%2!=0)
			{
				sdcms::error('Url Error');
			}
			else
			{
				foreach($arr as $k=>$v)
				{
					if($k%2!=0)
					{
						#修复搜索汉字出错的BUG
						$result=$arr[$k];
						$result=rawurldecode($result);
						$encode=mb_detect_encoding($result,['UTF-8','GBK','GB2312']);
						if($encode!='UTF-8')
						{
							$result=mb_convert_encoding($result,'utf-8',$encode);   
						}
						$route[$arr[$k-1]]=enhtml($result);
					}
				}
				#删除为空的变量：2022-01-10新增
				foreach($_GET as $k=>$v)
				{
					if(trim($v)=='')
					{
						unset($_GET[$k]);
					}
				}
				$_GET=array_merge($_GET,$route);
			}
		}
		if(empty($route['m'])) $route['m']='home';
		if(empty($route['c'])) $route['c']='index';
		if(empty($route['a'])) $route['a']='index';
		if(empty($route['p'])) $route['p']='';

		sdcms::$url=$pathinfo;
		sdcms::$route=$route;
		unset($pathinfo);
		return $route;
	}

	private static function get_alias($alias)
	{
		foreach($alias as $key => $val)
		{
			#剔除掉非栏目和内容页的别名
			if($val['types']==0)
			{
				unset($alias[$key]);
			}
		}
		if(!isempty(C('url_show')))
		{
			$alias[C('url_show')]=['id'=>-2,'alias'=>C('url_show'),'app'=>'show'];
		}
		return $alias;
	}

}