<?php
class Category extends AdminsController
{
	private $name,$tbname,$classdata,$temproot;
	public $badword=[];
	public function __construct()
	{
		parent::__construct();
		$this->name='class';
		$this->tbname='cms_class';
		$this->classdata=C($this->name);
		$this->temproot='content/class/';
		$this->badword=getword($this->db);
	}

	private function get_class_postion($id,$mid=' > ')
	{
		$data=$this->classdata;
		$arr=explode(",",get_tree_parent($id));
		$html='';
		for($i=0;$i<count($arr);$i++)
		{
			if($arr[$i]!=0)
			{
				$html.=$mid.'<a href="'.U("index","fid=".$arr[$i]."").'">'.$data[$arr[$i]]['cate_name'].'</a>';
			}
		}
		return $html;
	}

	public function switchs()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$state=getint(F('state'),0);
			$type=getint(F('get.type'),0);
			switch ($type)
			{
				case '2':
					$field='isnew';
					break;
				default:
					$field='ismenu';
					break;
			}
			$rs=$this->db->row("select cateid from ".$this->tbname." where cateid=$id limit 1");
			if($rs)
			{
				$this->db->update($this->tbname,'cateid='.$id.'',[$field=>$state]);
			}
			$this->success('修改成功');
		}
		
	}
	
	public function index()
	{
		if(IS_POST)
		{
			$mid=F('mid');
			$ordnum=F('ordnum');
			foreach($mid as $key=>$val)
			{
				$id=getint($val,0);
				$this->db->update($this->tbname,"cateid=$id",['cate_order'=>getint($ordnum[$key],0)]);
			}
			$this->success('保存成功');
			$this->cache();
		}
		else
		{
			$fid=getint(F('get.fid'),0);
			$this->assign('fid',$fid);
			$position='';
			$pid=null;
			if($fid!=0)
			{
				$pid=get_followid($fid);
				$position=self::get_class_postion($fid);
			}
			$this->assign('pid',$pid);
			$this->assign('position',$position);
			$this->assign('classdata',$this->classdata);
			$this->display($this->temproot."index.php");
		}
	}

	public function cache()
	{
		$rs=$this->db->load("select * from ".$this->tbname." order by cate_order,cateid");
		$old=cms_tree::get_trees($rs,0);
		$tree=[];
		foreach($old as $key=>$val) 
		{
			$tree[$val['cateid']]=$old[$key];
		}
		$tree=cms_tree::get_tree($tree);
		
		$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($tree,true).";\n?>";
		if(!savefile('data/config/'.$this->name.'.php',$data))
		{
			$this->error('data/config/'.$this->name.'.php写权限不足，请检查');
		}
		cache_alias($this->db);
	}

	public function refresh()
	{
		$this->cache();
		$this->success('更新成功');
	}

	public function add()
	{
		$fid=getint(F('get.fid'),0);
		$field=get_field($this->db,1);
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
			$way=getint(F('way'),1);
			$data=[[F('t0'),'null','栏目名称不能为空']];
			if(getint(F('t1'),0)!=-2)
			{
				$data=check_add_alias(F('t2'),$data,$this->db);
			}
			
			$data=array_merge($data,field_rule($field));
			$v=new cms_verify($data);
			if($v->result())
			{
				if($way==1)
				{
					$rs=$this->db->row("select * from ".$this->tbname." where followid=$fid and cate_name='".F('t0')."' limit 1");
					if($rs)
					{
						$this->error('栏目名称已存在');
					}
					else
					{
						$d=field_form($field);
						$d['cate_name']=badwords(F('t0'),$this->badword);
						$d['cate_type']=getint(F('t1'),0);
						$d['cate_url']=F('t2');
						$d['cate_page']=getint(F('t3'),20);
						$d['cate_order']=getint(F('t4'),0);
						$d['cate_title']=F('t5');
						$d['cate_key']=F('t6');
						$d['cate_desc']=F('t7');
						$d['cate_list']=F('t8');
						$d['cate_show']=F('t9');
						$d['ismenu']=getint(F('t10'),0);
						$d['isnew']=getint(F('t11'),0);
						$d['isgroup']=getint(F('t12'),0);
						$d['cate_en']=F('t13');
						$d['cate_pic']=F('t14');
						$d['followid']=$fid;
						$this->db->add($this->tbname,$d);
						$newid=$this->db->newid;
						if(getint(F('t1'),0)!=-2 && F('t2')!='')
						{
							add_alias(F('t2'),$this->name,$newid,$this->db);
						}
						$this->success('添加成功');
						$this->cache();
					}
				}
				else
				{
					$d=field_form($field);
					$d['cate_name']='';
					$d['cate_type']=getint(F('t1'),1);
					$d['cate_url']='';
					$d['cate_page']=getint(F('t3'),20);
					$d['cate_order']=getint(F('t4'),0);
					$d['cate_title']=F('t5');
					$d['cate_key']=F('t6');
					$d['cate_desc']=F('t7');
					$d['cate_list']=F('t8');
					$d['cate_show']=F('t9');
					$d['ismenu']=getint(F('t10'),0);
					$d['isnew']=getint(F('t11'),0);
					$d['isgroup']=getint(F('t12'),0);
					$d['cate_en']=F('t13');
					$d['cate_pic']=F('t14');
					$d['followid']=$fid;
					$db=str_replace("\r\n",":",F('t0'));
					$db=explode(':',$db);
					foreach($db as $key=>$val)
					{
						$name=badwords($val,$this->badword);
						if(trim($name)!='')
						{
							$rs=$this->db->row("select * from ".$this->tbname." where followid=$fid and cate_name='".$name."' limit 1");
							if(!$rs)
							{
								$d['cate_name']=$name;
								$this->db->add($this->tbname,$d);
								$newid=$this->db->newid;
							}
						}
						
					}
					$this->success('添加成功');
					$this->cache();
				}
			}
			else
			{
				$this->error($v->msg);
			}
			
		}
		else
		{
			$this->assign('fid',$fid);
			$position='';
			if($fid!=0)
			{
				$position=self::get_class_postion($fid);
			}
			$this->assign('position',$position);
			$this->assign("field",$field);
			$this->assign("editor",$editor);
			$this->assign("draglist",$draglist);
			$this->display($this->temproot."add.php");
		}
	}

	public function edit()
	{
		$id=getint(F('get.id'),0);
		$fid=getint(F('get.fid'),0);
		$field=get_field($this->db,1);
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
			$data=[[F('t0'),'null','栏目名称不能为空']];
			if(getint(F('t1'),0)!=-2)
			{
				$data=check_edit_alias(F('t2'),$id,$data,$this->db);
			}
			
			$data=array_merge($data,field_rule($field));
			$v=new cms_verify($data);
			if($v->result())
			{
				$d=field_form($field);
				$d['cate_name']=badwords(F('t0'),$this->badword);
				$d['cate_type']=getint(F('t1'),1);
				$d['cate_url']=F('t2');
				$d['cate_page']=getint(F('t3'),20);
				$d['cate_order']=getint(F('t4'),0);
				$d['cate_title']=F('t5');
				$d['cate_key']=F('t6');
				$d['cate_desc']=F('t7');
				$d['cate_list']=F('t8');
				$d['cate_show']=F('t9');
				$d['ismenu']=getint(F('t10'),0);
				$d['isnew']=getint(F('t11'),0);
				$d['isgroup']=getint(F('t12'),0);
				$d['cate_en']=F('t13');
				$d['cate_pic']=F('t14');
				$this->db->update($this->tbname,"cateid=$id",$d);
				$this->success('保存成功');
				if(getint(F('t1'),0)!=-2)
				{
					if(F('t2')=='')
					{
						$this->db->del('cms_alias',"sid=$id and app='class'");
					}
					else
					{
						$rs=$this->db->row("select id from cms_alias where app='class' and sid=$id limit 1");
						if($rs)
						{
							$this->db->update('cms_alias','id='.$rs['id'].'',['alias'=>F('t2')]);
						}
						else
						{
							$this->db->add('cms_alias',['alias'=>F('t2'),'app'=>'class','sid'=>$id,'types'=>1]);
						}
					}
				}
				$apply=F('apply');
				if(is_array($apply))
				{
					if(get_sonid_num($id)>0)
					{
						$sonid=get_sonid_all($id);
						if(in_array(1,$apply))
						{
							$c['cate_list']=F('t8');
							$c['cate_show']=F('t9');
						}
						if(in_array(2,$apply))
						{
							$c['cate_page']=getint(F('t3'),0);
						}
						if(in_array(3,$apply))
						{
							$c['ismenu']=getint(F('t10'),0);
						}
						if(in_array(4,$apply))
						{
							$c['isnew']=getint(F('t11'),0);
						}
						if(in_array(5,$apply))
						{
							$c['isgroup']=getint(F('t12'),0);
						}
						$this->db->update($this->tbname,'cateid in('.$sonid.')',$c);
					}
				}
				$this->cache();
			}
			else
			{
				$this->error($v->msg);
			}
		}
		else
		{
			$rs=$this->db->row("select * from ".$this->tbname." where cateid=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
				$position=self::get_class_postion($id);
				$total=0;
				if($rs['cate_type']>0)
				{
					$total=$this->db->count("select count(1) from cms_show where classid in(".get_sonid_all($id).")");
				}
				$this->assign('position',$position);
				$this->assign('fid',$fid);
				$this->assign('total',$total);
				$this->assign('record',$rs);
				$this->assign("field",$field);
				$this->assign("editor",$editor);
				$this->assign("draglist",$draglist);
				$this->display($this->temproot."edit.php");
			}
		}
	}

	public function move()
	{
		$id=getint(F('get.id'),0);
		if(IS_POST)
		{
			$t0=getint(F('t0'),0);
			$old_fid=get_followid($id);
			$isok=1;
			if($t0==$id)
			{
				$this->error('不能移动到自己');
				$isok=0;
			}
			if($t0!=0)
			{
				if($t0==$old_fid)
				{
					$this->error('没有移动');
					$isok=0;
				}
				$old_sonid=explode(',',get_sonid_all($id));
				if(in_array($t0,$old_sonid))
				{
					$this->error('不能移动到子栏目');
					$isok=0;
				}
			}
			else
			{
				if($t0==$old_fid)
				{
					$this->error('没有移动');
					$isok=0;
				}
			}
			if($isok==1)
			{
				$this->db->update($this->tbname,"cateid=$id",['followid'=>$t0]);
				$this->success('移动成功');
				$this->cache();
			}
		}
		else
		{
			$rs=$this->db->row("select * from ".$this->tbname." where cateid=$id limit 1");
			if($rs)
			{
				foreach($rs as $key=>$val)
				{
					$this->assign($key,$val);
				}
				$position=self::get_class_postion($id);
				$this->assign('position',$position);
				$this->assign('data',$this->classdata);
				$this->assign('id',$id);
				$this->assign('sonid',explode(',',get_sonid_all($id)));
				$this->display($this->temproot."move.php");
			}
		}
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$rs=$this->db->row("select cate_type from ".$this->tbname." where cateid=$id limit 1");
			if(!$rs)
			{
				$this->error('栏目ID错误');
				return;
			}
			$cate_type=$rs['cate_type'];
			$rs=$this->db->row("select cateid from ".$this->tbname." where followid=$id limit 1");
			if($rs)
			{
				$this->error('请先删除子栏目');
			}
			else
			{
				$rs=$this->db->row("select count(1) as num from cms_show where classid=$id limit 1");
				if($rs['num']!=0)
				{
					$this->error('请先删除内容');
				}
				else
				{
					if($cate_type==-1)
					{
						$this->db->del('cms_page',"cid=$id");
					}
					$this->db->del($this->tbname,"cateid=$id");
					del_alias($id,$this->name,$this->db);
					$this->success('删除成功');
				}
				$this->cache();
			}
		}
	}

}