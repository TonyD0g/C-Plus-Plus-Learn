<?php
final class cms_verify
{
	private $data=[];
	public $msg='';

	public function __construct($array)
	{
		$this->data=$array;
		self::verify();
	}

	public function result()
	{
		return (!($this->msg))?true:false;
	}

	public function verify()
	{
		if(!is_array($this->data))
		{
			$this->msg='验证参数类型错误';
			return;
		}
		foreach($this->data as $key=>$val)
		{
			$result=self::check($val[0],$val[1],$val[2]);
			if(!($result===true))
			{
				$this->msg=$result;
				return;
			}
		}
	}

	public static function check($data,$type,$val='')
	{
		switch($type)
		{
			case "null":
				if(is_array($data))
				{
					return (count($data)!=0)?true:$val;
				}
				else
				{
					return (strlen($data)!=0)?true:$val;
				}
				break;
			case "array":
				return (is_array($data))?true:$val;
			case "int":
				return (preg_match('/^[0-9]+$/',$data))?true:$val;  
				break;
			case "dot":
				return (preg_match('/^[0-9]+(.[0-9]{1,2})?$/',$data))?true:$val;  
				break;
			case "en":
				return (preg_match('/^[a-zA-Z]+$/',$data))?true:$val;  
				break;
			case "cn":
				return (preg_match('/^([\x80-\xff])+$/',$data))?true:$val;  
				break;
			case "date":
				return (preg_match('/^[0-9]{4}(\-|\/)[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(|:[0-9]{1,2}(|:[0-9]{1,2})))$/',$data))?true:$val;  
				break;
			case "email":
				return (preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/',$data))?true:$val;
				break;
			case "mobile":
				return (preg_match('/^1[3-9]\d{9}$/',$data))?true:$val;
				break;
			case "tel":
				return (preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/',$data))?true:$val;
				break;
			case "zipcode":
				return (preg_match('/^[1-9]\d{5}$/',$data))?true:$val;
				break;
			case "qq":
				return (preg_match('/^[1-9][0-9]{4,15}$/',$data))?true:$val;
				break;
			case "idcard":#身份证
				return (preg_match('/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/',$data))?true:$val;
				break;
			case "url":
				return (preg_match("/^(http|https):\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/",$data))?true:$val;
				break;
			case "username":
				return (preg_match('/^[\x80-\xff\w\d]{3,12}$/i',$data))?true:$val;
				break;
			case "password":
				return (preg_match('/^[\S]{5,16}$/i',$data))?true:$val;
				break;
			case "field":
				return (preg_match('/^\w{3,50}$/i',$data))?true:$val;
				break;
			case "other":
				return $data?true:$val;
				break;
			default:
				return $val;
		}
	}
}