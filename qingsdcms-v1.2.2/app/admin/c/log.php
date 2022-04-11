<?php
class Log extends AdminsController
{
	public function btach()
	{
		$id=F('id');
		self::btach_del($id);
		$this->success('操作成功');
	}

	public function btach_del($id)
	{
		if(IS_POST)
		{
			$arr=explode(',',$id);
			foreach($arr as $key=>$val)
			{
				$val=getint($val,0);
				$this->db->del('cms_log',"id=$val");
			}
		}
	}

	public function index()
	{
		$where='1=1 ';
		if(get_admin_info('pid')!=0)
		{
			$where=" title='".get_admin_info('adminname')."'";
		}
		$this->assign("where",$where);
		$this->display("system/log/log.php");
	}

	public function del()
	{
		$id=getint(F('get.id'),0);
		self::btach_del($id);
		$this->success('删除成功');
	}

}