<?php
class Content extends AdminsController
{
	private $name,$tbname,$classdata,$temproot;
	public $badword=[];
	public function __construct()
	{
		parent::__construct();
		$this->name='show';
		$this->tbname='cms_show';
		$this->classdata=C('class');
		$this->temproot='content/';
		$this->badword=getword($this->db);
	}

	public function tree()
	{
		$classid=getint(F('get.classid'),0);
		$this->assign("cate",$this->classdata);
		$this->assign("classid",$classid);
		$this->display($this->temproot."tree.php");
	}

	public function move()
	{
		if(IS_POST)
		{
			$id=F('id');
			$classid=getint(F('classid'),0);
			if($classid>0)
			{
				$arr=explode(',',$id);
				foreach($arr as $key=>$val)
				{
					$val=getint($val,0);
					$this->db->update($this->tbname,"id=$val",['classid'=>$classid]);
				}
				$this->success('操作成功');
			}
		}
	}

	public function btach()
	{
		$type=getint(F('type'),0);
		$id=F('id');
		switch($type)
		{
			case '1':
				self::btach_some("isshow",1,$id);
				break;
			case '2':
				self::btach_some("isshow",0,$id);
				break;
			case '3':
				self::btach_some("isnice",1,$id);
				break;
			case '4':
				self::btach_some("isnice",0,$id);
				break;
			case '99':
				self::btach_clear($id);
				break;
		}
		$this->success('操作成功');
	}

	public function btach_some($field,$val,$id)
	{
		if(IS_POST)
		{
			$d=[$field=>$val];
			$arr=explode(',',$id);
			foreach($arr as $key=>$val)
			{
				$val=getint($val,0);
				$this->db->update($this->tbname,"id=$val",$d);
			}
		}
	}

	public function btach_clear($id)
	{
		if(IS_POST)
		{
			$arr=explode(',',$id);
			foreach($arr as $key=>$val)
			{
				$val=getint($val,0);
				$rs=$this->db->row("select id,tags from ".$this->tbname." where id=$val");
				if($rs)
				{
					$tags=$rs['tags'];
					self::del_tags($tags);
					$this->db->del($this->tbname,"id=$val");
					$this->db->del('cms_data',"cid=$val");
					del_alias($val,$this->name,$this->db);
				}
			}
		}
	}

	public function switchs()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$type=getint(F('get.type'),0);
			$state=getint(F('state'),0);
			switch ($type)
			{
				case '1':
					$field='isnice';
					break;
				case '2':
					$field='isshow';
					break;
			}
			$rs=$this->db->row("select id from ".$this->tbname." where id=$id limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,"id=$id",[$field=>$state]);
			}
			$this->success('修改成功');
		}
		
	}

	public function taglist()
	{
		$this->display($this->temproot."tags.php");
	}

	public function index()
	{
		$str='';
		$cate=C('class');
		foreach($cate as $index=>$key)
		{
			if(get_sonid_num($key['cateid'])!=0 || $key['cate_type']!=-2)
			{
				$str.="{id:$index,pId:".$key['followid'].",name:'".$key['cate_name']."',url:'".geturls($key['cateid'],$key['cate_type'])."',target:'content_body'},";
			}
		}
		$this->assign('str',$str);
		$this->display($this->temproot."index.php");
	}

	public function order()
	{
		if(IS_POST)
		{
			$mid=F('mid');
			$ordnum=F('ordnum');
			foreach($mid as $key=>$val)
			{
				$id=getint($val,0);
				$this->db->update($this->tbname,"id=$id",['ordnum'=>getint($ordnum[$key],0)]);
			}
			$this->success('保存成功');
		}
	}

	public function lists()
	{
		$where='1=1 ';
		$keyword=trim(F('get.keyword'));
		$classid=getint(F('get.classid'),0);
		if(strlen($keyword)>0)
		{
			$where.=" and (title like binary '%".$keyword."%')";
		}
		$position='';
		if($classid>0)
		{
			$sonid=get_sonid_all($classid);
			$where.=' and classid in('.$sonid.')';	
			$position=self::get_postion($classid);
		}
		$type=getint(F('get.type'),0);
		switch($type)
		{
			case '1':
				$where.=' and isshow=1';
				break;
			case "2":
				$where.=' and isshow=0';
				break;
		}
		$this->assign("where",$where);
		$this->assign("type",$type);
		$this->assign("keyword",$keyword);
		$this->assign("classid",$classid);
		$this->assign("position",$position);
		$this->display($this->temproot."list.php");
	}

	public function page()
	{
		$classid=getint(F('get.classid'),0);
		if(IS_POST)
		{
			$t0=!isset($_POST['t0'])?'':$_POST['t0'];
			$data=[[1==1,'null','内容不能为空']];
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=[];
				$d['content']=badwords($t0,$this->badword);
				if(C('state_page')==1)
				{
					$d['piclist']=jsencode(F('t1'));
				}
				$rs=$this->db->row("select content,piclist from cms_page where cid=$classid limit 1");
				if($rs)
				{
					$this->db->update('cms_page',"cid=$classid",$d);
				}
				else
				{
					$d['cid']=$classid;
					$this->db->add('cms_page',$d);
				}
				$this->success('保存成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$content='';
			$piclist='';
			$isdel=0;
			$rs=$this->db->row("select content,piclist from cms_page where cid=$classid limit 1");
			if($rs)
			{
				$content=$rs['content'];
				$piclist=$rs['piclist'];
				$isdel=1;
			}
			$this->assign("classid",$classid);
			$this->assign("content",$content);
			$this->assign("piclist",$piclist);
			$this->assign("position",self::get_postion($classid,1));
			$this->assign("isdel",$isdel);
			$this->display($this->temproot."page.php");
		}
	}

	public function add()
	{
		$field=get_field($this->db,2);
		$editor=[];
		$draglist=[];
		foreach($field as $key => $val)
		{
			if($val['field_type']=="12")
			{
				$editor[$key]=$val['field_key'];
			}
			if($val['field_type']=="13")
			{
				$draglist[$key]=$val['field_key'];
			}
		}
		if(IS_POST)
		{
			$data=[[F('title'),'null','标题不能为空']];
			$data=check_add_alias(F('alias'),$data,$this->db);
			$data=array_merge($data,field_rule($field));
			$classid=getint(F('classid'),0);
			if($classid<=0)
			{
				$data=array_merge($data,[[1<>1,'other','栏目ID错误']]);
			}
			#检查标题是否存在
			$rs=$this->db->row("select id from $this->tbname where title='".F('title')."' limit 1");
			if($rs)
			{
				$data=array_merge($data,[[(1>1),'other','标题重复，请更换']]);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$pic=F('pic');
				if($pic=='' && getint(F('savepic'),0)==1 && isset($_POST['content']))
				{
					$pic_array=get_all_picurl($_POST['content']);
					if(is_array($pic_array))
					{
						$pic=$pic_array[0];
					}
				}
				$intro=(isempty(F('intro')))?trim(cut(nohtml(F('content')),510)):F('intro');
				$tags=self::deal_tags(F('tags'));
				$d=[];
				$d['title']=badwords(F('title'),$this->badword);
				$d['classid']=$classid;
				$d['intro']=badwords($intro,$this->badword);
				$d['tags']=$tags;
				$d['alias']=F('alias');
				$d['ordnum']=getint(F('ordnum'),0);
				$d['pic']=$pic;
				$d['ispic']=is_pic($pic);
				$d['isauto']=getint(F('isauto'),0);
				$d['isshow']=getint(F('isshow'),0);
				if(strtotime(F('createdate'))>time() && $d['isauto']==1)
				{
					$d['isshow']=0;
				}
				$d['show_title']=F('show_title');
				$d['show_key']=F('show_key');
				$d['show_desc']=F('show_desc');
				$d['isurl']=!isempty(F('url'))?1:0;
				$d['url']=F('url');
				$d['hits']=getint(F('hits'),0);
				$d['isnice']=getint(F('isnice'),0);
				$d['createdate']=strtotime(F('createdate'));
				$d['lastupdate']=time();
				$d['show_theme']=F('show_theme');
				$d['adminid']=ADMIN_ID;
				$this->db->add($this->tbname,$d);
				$newid=$this->db->newid;
				$piclist=(C('state_content')==1)?jsencode(F('piclist')):'""';
				$content=(!isset($_POST['content'])?'':$_POST['content']);
				$content=badwords($content,$this->badword);
				$fdata=['cid'=>$newid,'piclist'=>$piclist,'content'=>$content];
				$fdata=array_merge($fdata,field_form($field));
				$this->db->add('cms_data',$fdata);
				add_alias(F('alias'),$this->name,$newid,$this->db);
				#Tags处理
				if(C('state_tags')==1)
				{
					self::add_tags($tags,'');
					self::deal_content_tags($tags,$newid);
				}
				$this->success('添加成功');
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$classid=getint(F('classid'),0);
			$isgroup=0;
			if($classid>0)
			{
				$cate=$this->classdata;
				$data=$cate[$classid];
				if(count($data)>0)
				{
					$isgroup=$data['isgroup'];
				}
			}
			$this->assign("classid",$classid);
			$this->assign("isgroup",$isgroup);
			$this->assign("classdata",$this->classdata);
			$this->assign("field",$field);
			$this->assign("editor",$editor);
			$this->assign("draglist",$draglist);
			$this->display($this->temproot."add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		$field=get_field($this->db,2);
		$editor=[];
		$draglist=[];
		foreach($field as $key => $val)
		{
			if($val['field_type']=="12")
			{
				$editor[$key]=$val['field_key'];
			}
			if($val['field_type']=="13")
			{
				$draglist[$key]=$val['field_key'];
			}
		}
		if(IS_POST)
		{
			$data=[[F('title'),'null','标题不能为空']];
			$data=check_edit_alias(F('alias'),$id,$data,$this->db,$this->db);
			$data=array_merge($data,field_rule($field));
			$classid=getint(F('classid'),0);
			if($classid<=0)
			{
				$data=array_merge($data,[[1<>1,'other','栏目ID错误']]);
			}
			#检查标题是否存在
			$rs=$this->db->row("select id from $this->tbname where title='".F('title')."' and id<>$id limit 1");
			if($rs)
			{
				$data=array_merge($data,[[(1>1),'other','标题重复，请更换']]);
			}
			$v=new cms_verify($data);
			if($v->result())
			{
				$tags_old=$this->db->load_field('tags','cms_show',"id=$id");
				$pic=F('pic');
				if($pic=='' && getint(F('savepic'),0)==1 && isset($_POST['content']))
				{
					$pic_array=get_all_picurl($_POST['content']);
					if(is_array($pic_array))
					{
						$pic=$pic_array[0];
					}
				}
				$intro=(isempty(F('intro')))?trim(cut(nohtml(F('content')),510)):F('intro');
				$tags=self::deal_tags(F('tags'));
				$d=[];
				$d['title']=badwords(F('title'),$this->badword);
				$d['classid']=$classid;
				$d['intro']=badwords($intro,$this->badword);
				$d['tags']=$tags;
				$d['alias']=F('alias');
				$d['ordnum']=getint(F('ordnum'),0);
				$d['pic']=$pic;
				$d['ispic']=is_pic($pic);
				$d['isauto']=getint(F('isauto'),0);
				$d['isshow']=getint(F('isshow'),0);
				if(strtotime(F('createdate'))>time() &&$d['isauto']==1)
				{
					$d['isshow']=0;
				}
				$d['show_title']=F('show_title');
				$d['show_key']=F('show_key');
				$d['show_desc']=F('show_desc');
				$d['isurl']=!isempty(F('url'))?1:0;
				$d['url']=F('url');
				$d['hits']=getint(F('hits'),0);
				$d['isnice']=getint(F('isnice'),0);
				$d['createdate']=strtotime(F('createdate'));
				$d['lastupdate']=time();
				$d['show_theme']=F('show_theme');
				$this->db->update($this->tbname,"id=$id",$d);
				$piclist=(C('state_content')==1)?jsencode(F('piclist')):'""';
				$content=(!isset($_POST['content'])?'':$_POST['content']);
				$content=badwords($content,$this->badword);
				if($this->db->count("select count(1) from cms_data where cid=$id")==0)
				{
					$fdata=['cid'=>$id,'piclist'=>$piclist,'content'=>$content];
					$fdata=array_merge($fdata,field_form($field));
					$this->db->add('cms_data',$fdata);
				}
				else
				{
					$fdata=['piclist'=>$piclist,'content'=>$content];
					$fdata=array_merge($fdata,field_form($field));
					$this->db->update('cms_data',"cid=$id",$fdata);
				}
				#Tags处理
				if(C('state_tags'))
				{
					self::add_tags($tags,$tags_old);
					self::deal_content_tags($tags,$id);
				}
				edit_alias(F('alias'),$this->name,$id,$this->db);
				$this->success('保存成功');
			}
			else
			{
				$this->error($v->msg);  
			}
		}
		else
		{
			$rs=$this->db->row("select a.*,b.isgroup from ".$this->tbname." a left join cms_class b on a.classid=b.cateid where id=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
			}
			$rs=$this->db->row("select * from cms_data where cid=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
			}
			$this->assign("classdata",$this->classdata);
			$this->assign('record',$rs);
			$this->assign("field",$field);
			$this->assign("editor",$editor);
			$this->assign("draglist",$draglist);
			$this->display($this->temproot."edit.php");
		}
	}

	public function copy()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select * from ".$this->tbname." where id=$id");
			if($rs)
			{
				unset($rs['id']);
				$rs['alias']='';
				$rs['isshow']=0;
				$rf=$this->db->row("select * from cms_data where cid=$id");
				if($rf)
				{
					unset($rf['dataid']);
					$this->db->add($this->tbname,$rs);
					$nid=$this->db->newid;
					$rf['cid']=$nid;
					$this->db->add('cms_data',$rf);
				}
				$this->success('复制成功');
			}
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select tags from ".$this->tbname." where id=$id");
			if($rs)
			{
				$tags=$rs['tags'];
				self::del_tags($tags);
				$this->db->del($this->tbname,"id=$id");
				$this->db->del("cms_data","cid=$id");
				del_alias($id,$this->name,$this->db);
			}
			$this->success('删除成功');
		}
	}

	public function delpage()
	{
		if(IS_POST)
		{
			$classid=getint(F('get.classid'),0);
			$this->db->del('cms_page',"cid=$classid");
			$this->success('删除成功');
		}
	}

	private function get_postion($id,$type=0,$mid=' > ')
	{
		$data=$this->classdata;
		$arr=explode(",",get_tree_parent($id));
		$html='';
		for($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]!=0)
			{
				$html.=$mid.'<a href="'.geturls($arr[$i],$data[$arr[$i]]['cate_type']).'">'.$data[$arr[$i]]['cate_name'].'</a>';
			}
		}
		return $html;
	}

	public function deal_tags($a)
	{
		$a=str_replace('，', ',',$a);
		$data=explode(',',$a);
		if(count($data)>5)
		{
			$i=0;
			foreach($data as $key=>$val)
			{
				if($i>=5)
				{
					unset($data[$key]);
				}
				$i++;
			}
			$a=implode(',',$data);
		}
		return $a;
	}

	public function add_tags($a,$b)
	{
		self::del_tags($b);
		if(strlen($a))
		{
			$data=explode(',',$a);
			foreach($data as $key=>$value)
			{
				$rs=$this->db->row("select id,hits from cms_tags where title='".$value."' limit 1");
				if($rs)
				{
					$hits=$rs['hits']+1;
					if(!APP_DEMO) $this->db->update('cms_tags','id='.$rs['id'].'',['hits'=>$hits]);
				}
				else
				{
					if(!APP_DEMO) $this->db->add('cms_tags',['title'=>$value,'hits'=>1]);
				}
			}
		}
	}

	public function del_tags($a)
	{
		if(strlen($a))
		{
			$data=explode(',',$a);
			foreach($data as $key=>$value)
			{
				$rs=$this->db->row("select id,hits from cms_tags where title='".$value."' limit 1");
				if($rs)
				{
					$hits=($rs['hits']==1)?0:$rs['hits']-1;
					if(!APP_DEMO) $this->db->update('cms_tags','id='.$rs['id'].'',['hits'=>$hits]);
				}
			}
		}
	}

	public function deal_content_tags($a,$id)
	{
		$arr=[];
		if(!isempty($a))
		{
			$data=explode(',',$a);
			$i=0;
			foreach($data as $key=>$val)
			{
				$rs=$this->db->row("select id from cms_tags where title='".$val."' limit 1");
				if($rs)
				{
					$arr[$i]=['name'=>$val,'id'=>$rs['id']];
					$i++;
				}
			}
		}
		$result=jsencode($arr);
		if(!APP_DEMO) $this->db->update('cms_show',"id=$id",['tagslist'=>$result]);
	}

}