<?php
class Index extends HomeController
{
	public $page;
	public $self;
	public function __construct()
	{
		parent::__construct();
		$this->page=getint(F('get.page'),1);
		$this->self=get_field(2,$this->db);
	}
	
	#网站首页
	public function Index()
	{
		$seo_title=C('seo_title')?C('seo_title'):C('web_name');
		$this->assign('seo_title',$seo_title);
		$this->assign('seo_key',C('seo_key'));
		$this->assign('seo_desc',C('seo_desc'));
		$field=$this->self;
		$self=[];
		if(is_array($field))
		{
			foreach($field as $key=>$val)
			{
				$self[$val['field_key']]=$val;
			}
		}
		$this->assign('self',$self);
		$this->assign('position',[['name'=>'首页','url'=>THIS_LOCAL]]);
		$this->display(T('home'));
	}

	#栏目页
	public function cate()
	{
		$classid=getint(F('classid'),0);
		$page=$this->page;
		if($classid>0)
		{
			$cate=C('class');
			$data=$cate[$classid];
			if(count($data)==0)
			{
				$this->error_tips('栏目不存在');
				return;
			}
			$field=$this->self;
			$self=[];
			if(is_array($field))
			{
				foreach($field as $key=>$val)
				{
					$self[$val['field_key']]=$val;
				}
			}
			$this->assign('self',$self);
			foreach($data as $key=>$val)
			{
				$this->assign($key,$val);
			}
			
			$pid=explode(',',get_tree_parent($classid));
			$parentid=implode(',',$pid);
			$topid=$pid[0];

			$seo_title=($data['cate_title'])?$data['cate_title']:$data['cate_name'];
			$this->assign('page_name',$data['cate_name']);
			if($page>1)
			{
				$seo_title.="_第{$page}页";
			}
			$seo_title.='_'.C('web_name');
			$this->assign('seo_title',$seo_title);
			$this->assign('seo_key',$data['cate_key']?$data['cate_key']:$data['cate_name']);
			$this->assign('seo_desc',$data['cate_desc']?$data['cate_desc']:$data['cate_name']);
			$this->assign('classid',$classid);
			$this->assign('pid',$pid);
			$this->assign('topid',$topid);
			$this->assign('parentid',$parentid);

			#面包屑
			$position=[];
			foreach($pid as $key=>$val)
			{
				$position[$key]=['name'=>get_catename($val),'url'=>cateurl($val)];
			}
			$this->assign('position',$position);

			$join='';
			$sonid=$data['sonid'];
			$where="classid in($sonid)";

			#获取当前栏目的模板设置
			switch($data['cate_type'])
			{
				#链接
				case '-2':
					gourl($data['cate_url']);
					return;
					break;
				#单页
				case '-1':
					$piclist='';
					$content='';
					$rs=$this->db->row("select piclist,content from cms_page where cid=$classid limit 1");
					if($rs)
					{
						$piclist=$rs['piclist'];
						$content=$rs['content'];
					}
					else
					{
						$arr=explode(',',$sonid);
						if(count($arr)>=2)
						{
							$rs=$this->db->row("select piclist,content from cms_page a left join cms_class b on a.cid=b.cateid where cid in($sonid) order by cate_order,cateid limit 1");
							if($rs)
							{
								$piclist=$rs['piclist'];
								$content=$rs['content'];
							}
						}
						
					}
					#手机版下强制去掉图片的尺寸
					if($this->is_wap())
					{
						$content=self::deal_param($content,$title);
					}
					#内链替换
					$content=self::sitelink($content);
					$pagenum=0;
					$page_data=explode('_cms_content_page_',$content);
					$pagenum=count($page_data);
					$page=($page>=$pagenum)?$pagenum:$page;
					$content=$page_data[$page-1];
					if($piclist!='')
					{
						$piclist=jsdecode($piclist);
					}
					$this->assign('piclist',$piclist);
					$this->assign('content',$content);
					$this->assign('page',$page);
					$this->assign('pagenum',$pagenum);
					$cate_temp=!isempty($data['cate_show'])?$data['cate_show']:T('page');
					if(C('mobile_open') && C('mobile_auto') && $this->is_wap())
					{
						if(!is_file("theme/".C('THEME_DIR')."/mobile/".$cate_temp))
						{
							$cate_temp=T('page');
						}
					}
					else
					{
						if(!is_file("theme/".C('THEME_DIR')."/".$cate_temp))
						{
							$cate_temp=T('page');
						}
					}
					break;
				default:
					if(!isempty($data['cate_list']))
					{
						$cate_temp=$data['cate_list'];
						if(C('mobile_open') && C('mobile_auto') && $this->is_wap())
						{
							if(!is_file("theme/".C('THEME_DIR')."/mobile/".$cate_temp))
							{
								$cate_temp=T('list');
							}
						}
						else
						{
							if(!is_file("theme/".C('THEME_DIR').'/'.$cate_temp))
							{
								$cate_temp=T('list');
							}
						}
					}
					else
					{
						$cate_temp=T('list');
					}
					$table="cms_data left join cms_show on cms_data.cid=cms_show.id";
					$where="isshow=1 and ($where)";
					$this->assign('table',$table);
					$this->assign('where',$where);
					$this->assign('order','ordnum desc,id desc');
					$this->assign("join",$join);
					break;
			}
			$this->display($cate_temp);
		}
	}

	#内容页
	public function show()
	{
		$id=getint(F('id'),0);
		$page=$this->page;
		if($id>0)
		{
			$where='';
			if(ADMIN_ID==0)
			{
				$where=' and isshow=1';
			}
			$rs=$this->db->row("select * from cms_show where id=$id $where limit 1");
			if(!$rs)
			{
				$this->error_tips('内容不存在');
				return;
			}
			else
			{
				$title=$rs['title'];
				#外链跳转
				if($rs['isurl']==1)
				{
					gourl(str_replace('&amp;','&',$rs['url']));
					return;
				}
				#标签ID处理
				$tagslist=jsdecode($rs['tagslist']);
				$tag_arr=[];
				if(count($tagslist)>0)
				{
					foreach($tagslist as $key => $val)
					{
						$tag_arr[$key]=['name'=>$val['name'],'url'=>U('other/tags','id='.$val['id'].'')];
					}
				}
				$rs['tagslist']=$tag_arr;
				#处理结束
				$classid=$rs['classid'];
				$title=$rs['title'];
				$seo_title=$rs['show_title'];
				$seo_key=$rs['show_key'];
				$seo_desc=$rs['show_desc'];
				$cate_name='';
				$rc=$this->db->row("select * from cms_class where cateid=$classid limit 1");
				if($rc)
				{
					$cate_name=$rc['cate_name'];
					$rs=array_merge($rs,$rc);
				}
				else
				{
					$this->error_tips('内容所在栏目ID错误');
					return;
				}
				#更新人气
				$rs['hits']=$rs['hits']+1;
				if($rs['isshow']==1)
				{
					$this->db->update('cms_show','id='.$id.'',['hits'=>$rs['hits']]);
				}
				$seo_title=($seo_title)?$seo_title:$title;
				$this->assign('page_name',$cate_name);
				if($page>1)
				{
					$seo_title.="_第{$page}页";
				}
				$seo_title.='_'.$cate_name.'_'.C('web_name');
				$this->assign('seo_title',$seo_title);
				$this->assign('seo_key',$seo_key?$seo_key:$title);
				$this->assign('seo_desc',$seo_desc?$seo_desc:$title);
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
				$show_temp=isempty($rs['show_theme'])?$rs['cate_show']:$rs['show_theme'];


				#获取父类ID集合
				$pid=explode(',',get_tree_parent($classid));
				$parentid=implode(',',$pid);

				#获取顶级分类ID
				$topid=$pid[0];
				$this->assign('classid',$classid);
				$this->assign('pid',$pid);
				$this->assign('topid',$topid);
				$this->assign('parentid',$parentid);

				#面包屑
				$position=[];
				foreach($pid as $key=>$val)
				{
					$position[$key]=['name'=>get_catename($val),'url'=>cateurl($val)];
				}
				$this->assign('position',$position);

				#模板处理
				if(!isempty($show_temp))
				{
					if(C('mobile_open') && C('mobile_auto') && $this->is_wap())
					{
						if(!is_file("theme/".C('THEME_DIR')."/mobile/".$show_temp))
						{
							$show_temp=T('show');
						}
					}
					else
					{
						if(!is_file("theme/".C('THEME_DIR')."/".$show_temp))
						{
							$show_temp=T('show');
						}
					}
				}
				else
				{
					$show_temp=T('show');
				}
				$rs=$this->db->row("select * from cms_data where cid=".$id." limit 1");
				if($rs)
				{
					foreach($rs as $key=>$val)
					{
						switch($key)
						{
							case 'content':
								#手机版下强制去掉图片的尺寸
								if($this->is_wap())
								{
									$val=self::deal_param($val);
								}
								$page=getint(F('get.page'),1);
								$pagenum=0;
								$page_data=explode('_cms_content_page_',$val);
								$pagenum=count($page_data);
								$page=($page>=$pagenum)?$pagenum:$page;
								$content=$page_data[$page-1];
								$this->assign($key,self::sitelink($page_data[$page-1]));
								$this->assign('page',$page);
								$this->assign('pagenum',$pagenum);
								break;
							case 'piclist':
								if($val!='')
								{
									$val=jsdecode($val);
								}
								$this->assign($key,$val);
							default:
								$this->assign($key,$val);
								break;
						}
					}
					$field=(is_array($this->self))?deal_field_show($this->self,$rs):[];
					$this->assign('field',$field);
				}
				$this->display($show_temp);
			}
		}
	}

	#手机站替换图片/视频的尺寸
	private function deal_param($content,$title='')
	{
		$num=preg_match_all("/\<img(.*?)\>/s",$content,$match);
		if($num)
		{
			for($i=0;$i<$num;$i++)
			{
				$a=$match[0][$i];#主体部分
				$b=self::get_for_param($match[1][$i],$title);
				$param='';
				foreach($b as $k=>$v)
				{
					$param.=' '.$k.'="'.$v.'"';
				}
				$str='<img'.$param.'>';
				$content=str_replace($a,$str,$content);
			}
		}
		$content=preg_replace('/<video.*?src="(.*?)".*?>/is','<video src="$1" controls autoplay preload="auto" x5-video-player-type="h5-page" webkit-playsinline="true" x-webkit-airplay="true" playsinline="true" style="object-fit:fill;width:100%;">',$content);
		return $content;
	}

	private function get_for_param($a,$b)
	{
		$a=trim($a,"/");
		$xml='<xml><tag '.$a.' /></xml>';
        $xml=simplexml_load_string($xml);
        $xml=(array)($xml->tag->attributes());
        $arr=array_change_key_case($xml['@attributes']);
        if(!isset($arr['alt']))
        {
        	$arr['alt']=$b;
        }
        unset($arr['width']);
        unset($arr['height']);
        return $arr;
	}

	#内链替换
	private function sitelink($content)
	{
		$data=require('data/config/sitelink.php');
		foreach($data as $key=>$val)
		{
			$str='<a href="'.$val['url'].'" target="_blank">'.$val['title'].'</a>';
			$num=($val['num']==0)?-1:$val['num'];
			$content=preg_replace('#(?=[^>]*(?=<(?!/a>)|$))'.$val['title'].'#',$str,$content,$num);
		}
		return $content;
	}

}