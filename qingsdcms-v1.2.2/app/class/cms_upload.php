<?php
final class cms_upload
{
	private $file;
	private $config=[
		'ext'   => [".gif",".jpg",".jpeg",".png"],
		'size'  => 1,
	];
	public $msg;
	public $state;
	public $oldname;
	private $newname;
	private $filesize;
	private $fileext;
	private $filepath;
	private $file_thumb;
	private $file_water;
	private $filetype;
	public $fileinfo;

	public function __construct($file,$type=1,$file_thumb=0,$file_water=0)
	{
		$this->file=$file;
		$this->fileinfo=[];
		$this->filetype=3;
		switch ($type)
		{
			case "1":#图片
				$this->config=[
					'ext'   => [".gif",".jpg",".jpeg",".png"],
					'size'  => C('upload_image_max'),
				];
				break;
			case "2":#视频
				$this->config=[
					'ext'   => [".swf",".mp4",".flv"],
					'size'  => C('upload_video_max')
				];
				break;
			case "3":#附件
				$this->config=[
					'ext'   => [".gif",".jpg",".jpeg",".png",
					".swf",".mp4",".flv",
					".doc",".docx",".xls",".xlsx",".ppt",".pptx",
					".rar",".zip",".7z",".gz",".tar",
					".apk",".iso",".pdf",".txt",".pem",".ico"],
					'size'  => C('upload_file_max'),
				];
				break;
		}
		$this->file_thumb=$file_thumb;
		$this->file_water=$file_water;
		switch(C('upload_file_folder'))
		{
			case '1':
				$this->filepath='upfile/'.date("Y").'/';
				break;
			case '2':
				$this->filepath='upfile/'.date("Y").'/'.date("m").'/';
				break;
			case '3':
				$this->filepath='upfile/'.date("Y").'/'.date("m").'/'.date("d").'/';
				break;
			default:
				$this->filepath='upfile/'.date("Ym").'/';
				break;
		}
		$this->state='error';
		$this->upfile();
	}

	public function upfile()
	{
		$isdemo=false;
		if(MODULE_NAME==C('admin'))
		{
			$isdemo=APP_DEMO;
		}
		if($isdemo)
		{
			$this->msg='/upfile/pic.jpg';
			$this->state='success';
			return;
		}
		if(!isset($_FILES[$this->file]))
		{
			$this->msg='来源错误(可能是空间禁止了上传)';
			return;
		}
		$file=$_FILES[$this->file];
		if(!$file)
		{
			$this->msg='没有文件上传';
			return;
		}
		if($file['error'])
		{
			$this->msg=$this->getError($file['error']);
			return;
		}
		if(!file_exists($file['tmp_name']))
		{
			$this->msg='找不到临时文件';
			return;
		}
		if(!is_uploaded_file($file['tmp_name']))
		{
			$this->msg='非法上传';
			return;
		}
		#本地文件名
		$this->oldname=$file['name'];
		#文件大小
		$this->filesize=$file['size'];
		#文件后缀
		$this->fileext=strtolower(strrchr($this->oldname,'.'));
		#新文件名
		$this->newname=time().mt_rand(100,999).$this->fileext;
		#检查文件大小
		if($this->filesize>$this->config['size']*1024*1024)
		{
			$this->msg='文件超出大小限制';
			return;
		}
		#检查文件类型
		if(!in_array($this->fileext,$this->config['ext']))
		{
			$this->msg='文件类型错误';
			return;
		}
		if(in_array($this->fileext,array('.jpg','.gif','.jpeg','.png','.bmp')))
		{
			$imginfo=getimagesize($file['tmp_name']);
			if(empty($imginfo)||($this->fileext=='.gif'&&empty($imginfo['bits'])))
			{
				$this->msg='非法图像文件';
				return;
			}
			if(check_bad(file_get_contents($file['tmp_name']))>0)
			{
				$this->msg='非法图像文件';
				return;
			}
		}
		
		#文件夹不存在时
		if(!is_dir(SYS_PATH.$this->filepath))
		{
		  #创建文件夹
		  if(!mkfolder(SYS_PATH.$this->filepath))
		  {
			  $this->msg='文件夹创建失败';
			  return;
		  }
		}
		
		
		#如果是图像文件
		if(preg_match('/^image\//i',$file['type']))
		{
			$this->filetype=1;
			$image=new cms_image();
			#压缩
			if(C('thumb_open')=='1' && $this->file_thumb==1)
	        {
	            $image->create_thumb($file['tmp_name'],C('thumb_min'));
	        }
	        #水印
	        if(C('water_open')=='1' && $this->file_water==1)
	        {
	            $image->watermark($file['tmp_name']);
	        }
		}
		$filename=$this->filepath.$this->newname;

		$result=move_uploaded_file($file['tmp_name'],SYS_PATH.$filename);
		if($result)
		{
			$this->msg=WEB_ROOT.$filename;
			if($this->filetype>1)
			{
				if(in_array($this->fileext,[".swf",".mp4",".flv"]))
				{
					$this->filetype=2;
				}
			}
			$this->fileinfo=['file_url'=>$this->msg,'file_name'=>enhtml($this->oldname),'file_ext'=>strtolower($this->fileext),'file_size'=>$this->filesize,'file_type'=>$this->filetype,'file_update'=>time(),'file_ip'=>getip()];
			$this->state='success';
		}
		else
		{
			$this->msg='上传失败';
		}
	}

	public function showmsg()
	{
		return jsencode(['state'=>$this->state,'msg'=>$this->msg]);
	}

	private function getError($errorNo)
	{
        switch ($errorNo)
        {
            case 1:
                return '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值！';
                break;
            case 2:
                return '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值！';
                break;
            case 3:
                return '文件只有部分被上传！';
                break;
            case 4:
                return '没有文件被上传！';
                break;
            case 6:
                return '找不到临时文件夹！';
                break;
            case 7:
                return '文件写入失败！';
                break;
            default:
                return '未知上传错误！';
        }
    }
}