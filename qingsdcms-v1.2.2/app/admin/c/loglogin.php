<?php
class LogLogin extends AdminsController
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
				$this->db->del('cms_log_login',"id=$val");
			}
		}
	}

	public function index()
	{
		$type=getint(F('get.type'),0);
		$where='1=1 ';
		if(get_admin_info('pid')!=0)
		{
			$where=" loginname='".get_admin_info('adminname')."'";
		}
		switch ($type)
		{
			case '1':
				$where.=' and loginstate=1';
				break;
			case "2":
				$where.=' and loginstate=0';
				break;
		}
		$this->assign("where",$where);
		$this->assign("type",$type);
		$this->display("system/log/login.php");
	}

	public function del()
	{
		$id=getint(F('get.id'),0);
		self::btach_del($id);
		$this->success('删除成功');
	}

}