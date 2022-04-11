<?php
class Config extends AdminsController
{
	private $tbname,$temproot;
	public function __construct()
	{
		parent::__construct();
		$this->tbname='cms_config';
		$this->temproot='config/';
	}

	public function index()
	{
		$id=getint(F('get.id'),0);
		if($id==0)
		{
			$rs=$this->db->row("select id from cms_config_group where isshow=1 order by ordnum,id limit 1");
			if($rs)
			{
				$id=$rs['id'];
			}
		}
		if(IS_POST)
		{
			$data=$this->db->load("select id,ckey,ctype from ".$this->tbname." where isshow=1 and gid=$id order by ordnum,id");
			if(count($data)==0)
			{
				$this->error('没有数据可保存');
				return;
			}
			else
			{
				foreach ($data as $key=>$rs)
				{
					$cid=$rs['id'];
					$var='';
					if($rs['ctype']==7)
					{
						$array=F($rs['ckey']);
						if(is_array($array))
						{
							$var=implode(',',$array);
						}
						unset($array);
					}
					else
					{
						if($rs['ckey']=='count_code')
						{							
							$var=$_POST[$rs['ckey']];
						}
						else
						{
							$var=F($rs['ckey']);
						}	
					}
					$this->db->update($this->tbname,'id='.$cid.'',['cvalue'=>$var]);
				}
				$rs=$this->db->load("select ckey,cvalue from ".$this->tbname." where isshow=1 and ctype<9 order by ordnum,id");
				$data=[];
		        foreach ($rs as $c)
		        {
		            $data[strtoupper($c['ckey'])]=$c['cvalue'];
		        }
				$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($data, true).";\n?>";
				if(savefile('data/config/config.php',$data))
				{
					$this->success('保存成功');
				}
				else
				{
					$this->error('data/config/config.php写权限不足，请检查');
				}
			}
		}
		else
		{
			$this->assign('id',$id);
			$this->display($this->temproot."config.php");
		}
	}
}