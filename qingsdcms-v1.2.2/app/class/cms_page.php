<?php
final class cms_page
{
	public $totalnum;
	private $pagesize;
	private $thispage;
	public $totalpage;
	private $url;
	private $config=[
		'home'  => '首页',
		'pre'   => '上一页',
		'next'  => '下一页',
		'last'  => '末页',
	];

	public function __construct($totalnum,$totalpage,$pagesize=20,$thispage=1)
	{
		$this->totalnum=$totalnum;
		$this->totalpage=$totalpage;
		$this->pagesize=$pagesize;
		$this->thispage=$thispage;
		$this->url=$this->getParam();
		if($this->totalnum==0)
		{
			$this->totalpage=0;
		}
		if($this->totalpage==0)
		{
			$this->thispage=1;
		}
		if($this->thispage>$this->totalpage)
		{
			$this->thispage=1;
		}
		if(ismobile())
		{
			$this->config=[
				'home'  => '<<',
				'pre'   => '<',
				'next'  => '>',
				'last'  => '>>'
			];
		}
	}
	
	private function getParam()
	{
		$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"],"?") ? "" : "?");
		$parse=parse_url($url);
		if(isset($parse['query']))
		{
			parse_str($parse['query'],$params);
			unset($params['page']);
			$url=$parse['path'].'?'.http_build_query($params);
		}
		return $url;
	}

	private function getUrl($num)
	{
		if(C('url_mode')==1)
		{
			$str=$this->url.'&page='.$num;
			$str=str_replace("?&","?",$str);
			if($num==1)
			{
				$str=str_replace('&page='.$num.'','',$str);
			}
		}
		else
		{
			$arr=sdcms::$route;
			if(defined('ROUTE_KEY') && ROUTE_KEY!='')
			{
				unset($arr['m']);
				unset($arr['c']);
				unset($arr['a']);
				unset($arr['p']);
				if($num>1)
				{
					$arr['page']=$num;
				}
				else
				{
					unset($arr['page']);
				}
				return U(ROUTE_KEY,http_build_query($arr));
			}
			$arr=array_merge($arr,$_GET);
			if(!isempty(C('pathinfo')))
			{
				unset($arr[C('pathinfo')]);
			}
			if(!empty($arr['alias']))
			{
				$arr['m']=$arr['alias'];
				unset($arr['c']);
				unset($arr['a']);
				if(isset($arr['param']))
				{
					unset($arr[$arr['param']]);
					unset($arr['param']);
				}
				unset($arr['alias']);
			}
			$arr['page']=$num;
			if($arr['m']!='plug')
			{
				unset($arr['p']);
			}
			$str=http_build_query($arr,'','&');
			$str=str_replace('m=','',$str);
			$str=str_replace('p=','',$str);
			$str=str_replace('c=','',$str);
			$str=str_replace('a=','',$str);
			$str=str_replace('=',C('url_mid'),$str);
			$str=str_replace('&',C('url_mid'),$str);
			if(isempty(C('pathinfo')))
			{
				$str=(C('url_mode')==2)?(WEB_ROOT.'index.php/'.$str.C('url_cate_ext')):(WEB_ROOT.$str.C('url_cate_ext'));
			}
			else
			{
				$str=(C('url_mode')==2)?(WEB_ROOT.'index.php?'.C('pathinfo').'='.$str.C('url_cate_ext')):(WEB_ROOT.$str.C('url_cate_ext'));
			}
			$str=str_replace('%2F','/',$str);
			if($num==1)
			{
				$m=(C('url_mid')=='/')?'\\'.C('url_mid'):C('url_mid');
				$str=str_replace(C('url_mid').'page'.C('url_mid').$num.'','',$str);
			}
		}
		return str_replace('%2C',',',$str);
	}

	public function pageList($j=5)
	{
		if(ismobile() || $_SERVER['HTTP_HOST']==C('mobile_domain'))
		{
			return self::pageList_mobile($j);
		}
		else
		{
			return self::pageList_pc($j);
		}
	}

	public function pageList_pc($j=5)
	{
		if($this->totalpage==1)
		{
			#return '';
		}
		$i=$j;
		$begin=$this->thispage;
   		$end=$this->thispage; 
   		while(true)
   		{
   			if($begin>1)
   			{
   				$begin=$begin-1;
   				$i=$i-1;
   			}
   			if($i>1&&$end<$this->totalpage)
   			{
   				$end=$end+1;
   				$i=$i-1;
   			}
   			if(($begin<=1&&$end>=$this->totalpage)||$i<=1)
   			{
   				break;
   			}
   		}
   		$str='';
   		$str.='<li><a>总数：'.$this->totalnum.'</a></li>';
  		
   		if($this->thispage>1)
   		{
   			$str.='<li><a href="'.$this->getUrl($this->thispage-1).'">'.$this->config['pre'].'</a></li>';
   		}
   		if($begin!=1)
   		{
   			$str.='<li><a href="'.$this->getUrl(1).'">1...</a></li>';
   		}
   		for($i=$begin;$i<=$end;$i++)
   		{
   			if($i==$this->thispage)
   			{
   				$str.='<li class="active"><a href="'.$this->getUrl($i).'">'.$this->thispage.'</a></li>';
   			}
   			else
   			{
   				$str.='<li><a href="'.$this->getUrl($i).'">'.$i.'</a></li>';
   			}
   		}
   		if($end!=$this->totalpage)
   		{
   			$str.='<li><a href="'.$this->getUrl($this->totalpage).'">...'.$this->totalpage.'</a></li>';
   		}
   		if($this->thispage<$this->totalpage)
   		{
   			$str.='<li><a href="'.$this->getUrl($this->thispage+1).'">'.$this->config['next'].'</a></li>';
   		}
   		$str.='<li><a>'.$this->thispage.'/'.$this->totalpage.'</a></li>';
   		return $str;
  	}

	public function showpage($a)
	{
		if($this->totalpage==0)
		{
			return '';
		}
		return self::pageList($a);
	}

	public function pageList_mobile()
	{
		if($this->totalpage<=1)
		{
			return '';
		}
		$str='';
		$str.='<li>'.self::home().'</li>';
		$str.='<li>'.self::pre().'</li>';
		$str.='<li>'.self::next().'</li>';
		$str.='<li>'.self::last().'</li>';
		$str.='<li><a>'.$this->thispage.'/'.$this->totalpage.'</a></li>';
		return $str;
	}

	public function home()
	{
		if($this->totalpage==0)
		{
			return '';
		}
		if($this->thispage==1)
		{
			return '<a>'.$this->config['home'].'</a>';
		}
		else
		{
			return '<a href="'.$this->getUrl(1).'">'.$this->config['home'].'</a>';
		}
	}

	public function pre()
	{
		if($this->totalpage==0)
		{
			return '';
		}
		if($this->thispage>1&&$this->thispage<=$this->totalpage)
		{
			return '<a href="'.$this->getUrl($this->thispage-1).'">'.$this->config['pre'].'</a>';
		}
		else
		{
			return '<a>'.$this->config['pre'].'</a>';
		}
		
	}

	public function next()
	{
		if($this->totalpage==0)
		{
			return '';
		}
		if($this->thispage<$this->totalpage)
		{
			return '<a href="'.$this->getUrl($this->thispage+1).'">'.$this->config['next'].'</a>';
		}
		else
		{
			return '<a>'.$this->config['next'].'</a>';
		}
	}

	public function last()
	{
		if($this->totalpage==0)
		{
			return '';
		}
		if($this->thispage<$this->totalpage)
		{
			return '<a href="'.$this->getUrl($this->totalpage).'">'.$this->config['last'].'</a>';
		}
		else
		{
			return '<a>'.$this->config['last'].'</a>';
		}
	}
	
}