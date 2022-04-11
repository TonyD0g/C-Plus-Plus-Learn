<?php
function get_admin_menu_url($b,$c,$d)
{
	$a=C('ADMIN');
	return U($a."/".$b."/".$c,$d);
}

function geturls($a,$b)
{
	switch ($b)
	{
		case '-1':
			return U('page','classid='.$a);
			break;
		case '-2':
			return 'javascript:;';
			break;
		default:
			return U('lists','classid='.$a);
			break;
	}
}

function is_pic($t0)
{
	if(isempty($t0))
	{
		return 0;
	}
	if(!strpos($t0,"."))
	{
		return 0;
	}
	list($a,$b)=explode('.',$t0);
	switch(strtolower($b))
	{
		case 'jpg':
		case 'jpeg':
		case 'gif':
		case 'png':
		case 'bmp':
			return 1;
			break;
		default:
			return (strpos("11".$t0,"://"))?1:0;
			break;
	}
}

function deal_strip($a)
{
	return stripslashes($a);
}

function encode($a,$b='')
{
	if($b=='')
	{
		$b=date('Ymd');
	}
	return base64_encode(authcode(jsencode($a),'E',C('prefix').$b));
}

function decode($a,$b='')
{
	if($b=='')
	{
		$b=date('Ymd');
	}
	if(isempty($a))
	{
		return '';
	}
	$a=jsdecode(authcode(base64_decode($a),'D',C('prefix').$b));
	$a=$a?$a:[];
	return $a;
}

function check_alias($alias)
{
	$msg='';
	if($alias!='')
	{
		if(!preg_match('/^[a-zA-Z0-9]+$/',$alias))
		{
			$msg='别名只能为字母或字母和数字的组合';
		}
		if(in_array($alias,[C('admin'),'admin','app','type','switch','edit','add','btach','del','public','data','install','cache','theme','list','order','clear','move','tree']))
		{
			$msg='别名为系统禁用关键字，请更换';
		}
	}
	return $msg;
}

function check_add_alias($alias,$data,$db)
{
	if($alias!='')
	{
		$msg=check_alias($alias);
		if($msg!='')
		{
			$data=array_merge($data,[[false,'other',$msg]]);
			return $data;
		}
		$rs=$db->row("select id from cms_alias where alias='".$alias."' limit 1");
		if($rs)
		{
			$data=array_merge($data,[[false,'other','别名已存在，请更换']]);
		}
	}
	return $data;
}

function check_edit_alias($alias,$id,$data,$db)
{
	if($alias!='')
	{
		$msg=check_alias($alias);
		if($msg!='')
		{
			$data=array_merge($data,[[false,'other',$msg]]);
			return $data;
		}
		$rs=$db->row("select id from cms_alias where alias='".$alias."' and sid<>$id limit 1");
		if($rs)
		{
			$data=array_merge($data,[[false,'other','别名已存在，请更换']]);
		}
	}
	return $data;
}

function add_alias($alias,$name,$id,$db)
{
	if($alias!='')
	{
		$db->add('cms_alias',['alias'=>$alias,'app'=>$name,'sid'=>$id,'types'=>1]);
	}
	cache_alias($db);
}

function edit_alias($alias,$name,$id,$db)
{
	if($alias=='')
	{
		$db->del('cms_alias',"sid=$id and app='".$name."'");
	}
	else
	{
		$rs=$db->row("select id from cms_alias where app='".$name."' and sid=$id limit 1");
		if($rs)
		{
			$db->update('cms_alias','id='.$rs['id'].'',['alias'=>$alias]);
		}
		else
		{
			$db->add('cms_alias',['alias'=>$alias,'app'=>$name,'sid'=>$id,'types'=>1]);
		}
	}
	cache_alias($db);
}

function del_alias($id,$name,$db)
{
	$db->del('cms_alias',"sid=$id and app='".$name."'");
	cache_alias($db);
}

function cache_alias($db)
{
	$rs=$db->load("select * from cms_alias order by id");
	$arr=[];
	foreach ($rs as $key=>$val) 
	{
		$arr[$val['alias']]=$rs[$key];
	}
	$data="<?php\nif(!defined('IN_CMS')) exit;\nreturn ".var_export($arr, true).";\n?>";
	file_put_contents('data/config/alias.php', $data);
	unset($data);
	unset($rs);
}

function getword($db)
{
	$rs=$db->row("select words from cms_badword where id=1 limit 1");
	if(!isempty($rs['words']))
	{
		$data=explode('@@',$rs['words']);
		$dt=[];
		foreach($data as $key => $val)
		{
			list($a,$b)=explode('|',$val);
			$dt[$a]=$b;
		}
		return $dt;
	}
	else
	{
		return [];
	}
}

function get_field($db,$mid)
{
	$rs=$db->load("select * from cms_field where isshow=1 and mid=$mid order by ordnum,id");
	return ($rs)?$rs:[];
}

function deal_rule($a,$b,$c=0)
{
	$d='';
	switch ($a) 
	{
		case '1':
			$d='null';
			break;
		case "2":
			$d='date';
			break;
		case "3":
			$d='int';
			break;
		case "4":
			$d='dot';
			break;
		case "5":
			$d='tel';
			break;
		case "6":
			$d='mobile';
			break;
		case "7":
			$d='email';
			break;
		case "8":
			$d='zipcode';
			break;
		case "9":
			$d='qq';
			break;
		case "10":
			$d='url';
			break;
		case "11":
			$d='username';
			break;
		case "12":
			$d='password';
			break;
		case "13":
			$d='idcard';
			break;
	}
	if($d=='')
	{
		return '';
	}
	else
	{
		$d=str_replace('null','',$d);
		if($c==0)
		{
			return 'data-rule="'.$b.':required;'.$d.'"';
		}
		else
		{
			return 'data-rule="'.$b.':checked;'.$d.'"';
		}
	}
}

function field_rule($db)
{
	$data=[];
	foreach ($db as $key=>$rs)
	{
		switch ($rs['field_rule'])
		{
			case '1':
				$data[$rs['field_key']]=[F($rs['field_key']),'null',''.$rs['field_title'].'不能为空'];
				break;
			case '2':
				$data[$rs['field_key']]=[F($rs['field_key']),'date',''.$rs['field_title'].'格式错误'];
				break;
			case '3':
				$data[$rs['field_key']]=[F($rs['field_key']),'int',''.$rs['field_title'].'格式错误'];
				break;
			case '4':
				$data[$rs['field_key']]=[F($rs['field_key']),'dot',''.$rs['field_title'].'格式错误'];
				break;
			case '5':
				$data[$rs['field_key']]=[F($rs['field_key']),'tel',''.$rs['field_title'].'格式错误'];
				break;
			case '6':
				$data[$rs['field_key']]=[F($rs['field_key']),'mobile',''.$rs['field_title'].'格式错误'];
				break;
			case '7':
				$data[$rs['field_key']]=[F($rs['field_key']),'email',''.$rs['field_title'].'格式错误'];
				break;
			case '8':
				$data[$rs['field_key']]=[F($rs['field_key']),'zipcode',''.$rs['field_title'].'格式错误'];
				break;
			case '9':
				$data[$rs['field_key']]=[F($rs['field_key']),'qq',''.$rs['field_title'].'格式错误'];
				break;
			case '10':
				$data[$rs['field_key']]=[F($rs['field_key']),'url',''.$rs['field_title'].'格式错误'];
				break;
			case '11':
				$data[$rs['field_key']]=[F($rs['field_key']),'username',''.$rs['field_title'].'格式错误'];
				break;
			case '12':
				$data[$rs['field_key']]=[F($rs['field_key']),'password',''.$rs['field_title'].'格式错误'];
				break;
			case '13':
				$data[$rs['field_key']]=[F($rs['field_key']),'idcard',''.$rs['field_title'].'格式错误'];
				break;
		}
	}
	return $data;
}

function field_form($db)
{
	$data=[];
	foreach($db as $key=>$rs)
	{
		switch ($rs['field_type'])
		{
			case '2':
				$data[$rs['field_key']]=strtotime(F($rs['field_key']));
				break;
			case '10':
				$array=F($rs['field_key']);
				if(is_array($array))
				{
					$data[$rs['field_key']]=implode(',',$array);
				}
				unset($array);
				break;
			case '12':
				if(isset($_POST[$rs['field_key']]))
				{
					$data[$rs['field_key']]=$_POST[$rs['field_key']];
				}
				else
				{
					$data[$rs['field_key']]='';
				}
				break;
			case '13':
				if(is_array(F($rs['field_key'])))
				{						
					$data[$rs['field_key']]=jsencode(F($rs['field_key']));
				}
				else
				{
					$data[$rs['field_key']]=F($rs['field_key']);
				}
				break;
			case '15':
				if(is_array(F($rs['field_key'])))
				{						
					$data[$rs['field_key']]=jsencode(F($rs['field_key']));
				}
				else
				{
					$data[$rs['field_key']]=F($rs['field_key']);
				}
				break;
			default:
				$data[$rs['field_key']]=F($rs['field_key']);
				break;
		}

		if((strpos('||'.$rs['field_sql'],'int')||strpos('||'.$rs['field_sql'],'decimal'))&&$rs['field_type']!=2)
		{
			$data[$rs['field_key']]=getint(F($rs['field_key']),0);
		}
	}
	return $data;
}

function deal_default($a)
{
	$num=preg_match_all("/\{php:(.*?)}/",$a,$match);
	if($num)
	{
		for($i=0;$i<$num;$i++)
		{
			switch ($match[1][$i])
			{
				case 'now':
					return date('Y-m-d H:i:s');
					break;
				default:
					if(strpos($match[1][$i],"."))
					{
						list($type,$val)=explode(".",$match[1][$i]);
						if($type=='get')
						{
							return F('get.'.$val.'');
						}
						elseif($type=='post')
						{
							return F($val);
						}
					}
					else
					{
						return $a;
					}
					break;
			}
		}
	}
	else
	{
		return $a;
	}
}