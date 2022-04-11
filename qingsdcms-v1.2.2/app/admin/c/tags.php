<?php
class Tags extends AdminsController
{
	public function index()
	{
		$this->display("extend/tags.php");	
	}

	public function del()
	{
		if(IS_POST)
		{
			$id=getint(F('get.id'),0);
			$this->db->del('cms_tags',"id=$id");
			$this->success('删除成功');
		}
	}

	public function clear()
	{
		if(IS_POST)
		{
			$this->db->del('cms_tags','hits<=0');
			$this->success('删除成功');
		}
	}

}