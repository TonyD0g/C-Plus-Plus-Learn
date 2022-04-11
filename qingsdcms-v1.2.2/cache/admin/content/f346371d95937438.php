<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>标签选择</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body class="bg_white">
	<div class="border_iframe">
    	<input id="taglist" type="hidden" value="">
        <ul class="tags">
        	<?php $total_rs=$this->db->count("select count(1) from cms_tags  where 1=1  ");$pagesize=30;$totalpage=ceil($total_rs/$pagesize);if($page>$totalpage){
$page=1;}$offset=($page-1)*$pagesize;$way=0;if($offset>1000 && $total_rs>2000 && $offset>$total_rs/2){	$offset=$total_rs-$offset-$pagesize;	$way=1;}if($offset<0){	$pagesize+=$offset;	$offset=0;}$key_="id";$table_="cms_tags";$join_="";$where_="where 1=1 ";$group_="";$order_="order by hits desc,id desc";$field_="*";$type_="0";$keylist=$this->db->getkeylist($key_,$table_,$join_,$where_,$order_,$offset,$pagesize,$way,$type_);$array_rs=$this->db->load("select $field_ from $table_ $join_ $keylist $group_ $order_");$pg=new cms_page($total_rs,$totalpage,$pagesize,$page);$showpage=$pg->showpage(5);if($total_rs==0){ ?>暂无标签可选<?php } else{  $i=0;} foreach($array_rs as $rs){ $i++;?>
        	<li data-tags="<?php echo $rs['title'];?>"><?php echo $rs['title'];?><i class="ui-icon-check"></i></li>
        	<?php } if($total_rs>0){  }?>
        </ul>
        <?php if ($total_rs!=0 && $totalpage>1) { ?>
        <div class="ui-page ui-page-center ui-page-info">
            <div class="page-list"><ul><?php echo $showpage;?></ul></div>
        </div>
        <?php }?>
    </div>
    <script>
	$(function()
	{
		$(".tags li").click(function(){
			if($(this).hasClass("hover"))
			{
				$(this).removeClass("hover");
			}
			else
			{
				$(this).addClass("hover");
			}
			gettag();
		});
	})
	function gettag()
	{
		var i=0;
		var str='';
		$(".tags li").each(function()
		{
			if($(this).hasClass("hover"))
			{
				var tags=$(this).attr("data-tags");
				if(i==0)
				{
					str=tags;
				}
				else
				{
					str=str+','+tags;
				}
				i=i+1;
			}
		})
		$("#taglist").val(str);
	}
	</script>
</body>
</html>