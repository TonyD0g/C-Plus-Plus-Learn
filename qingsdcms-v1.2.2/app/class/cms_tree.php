<?php
final class cms_tree
{
	public static function get_tree_child($id,$data)
	{
		$subs=[$id];
	    do{
	        $len=count($subs);
	        foreach($data as $item)
	        {
	            if(in_array($item['followid'],$subs))
	            {
	                $subs[]=$item['cateid'];
	                unset($data[$item['cateid']]);
	            }
	        }
	    }
	    while(count($subs)>$len);
		return implode(',', $subs);
	}

	public static function get_tree_parent($id,$data)
	{
		$tree=[];
		do
		{
			$tree[]=$data[$id]['cateid'];
			$id=$data[$id]['followid'];
		}
		while($id!=0);
		return array_reverse($tree);
	}

	public static function get_tree($data)
	{
		$tree=[];
		foreach($data as $key=>$val)
		{
			$val['parent']=implode(',',self::get_tree_parent($val['cateid'],$data));
			$val['sonid']=self::get_tree_child($val['cateid'],$data);
			$val['child']=count(explode(',', $val['sonid']))-1;
		 	$tree[$key]=$val;
		}
		return $tree;
	}

	public static function get_trees($data,$fid)
	{
		$stack=array($fid);
		$child=array();
		$added=array();
		$options=array();
		$obj=array();
		$loop=0;
		$depth=-1;
		$sonid='';
		foreach($data as $node)
		{
			$pid=$node['followid'];
			if(!isset($child[$pid]))
			{
				$child[$pid]=[];
			}
			array_push($child[$pid],$node['cateid']);
			$obj[$node['cateid']]=$node;
		}
		while(count($stack)>0)
		{    
			$id=$stack[0];
			$flag=false;
			$node=isset($obj[$id])?$obj[$id]:null;
			if(isset($child[$id]))
			{
				for($i=count($child[$id])-1;$i>=0;$i--)
				{
					array_unshift($stack,$child[$id][$i]);
				}
				$flag=true;
			}
			if($id!=$fid&&$node&&!isset($added[$id]))
			{
				$node['depth']=$depth;
				$options[]=$node;
				$added[$id]=true;
			}
			if($flag==true)
			{
				$depth++;
			} 
			else 
			{
				if($node)
				{
					for($i=count($child[$node['followid']])-1;$i>=0;$i--)
					{
						if($child[$node['followid']][$i]==$id)
						{
							array_splice($child[$node['followid']],$i,1);
							break;
						}
					} 
					if(count($child[$node['followid']])==0)
					{
						$child[$node['followid']]=null;
						$depth--;
					}
				}
				array_shift($stack);
			}
			$loop++;
			if($loop>5000) return $options;
		}
		unset($child);
		unset($obj);
		return $options;
	}

}