<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>标签选择</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body class="bg_white">

	<div class="border_iframe">
    	<input id="taglist" type="hidden" value="">
        <ul class="tags">
        	{cms:rs pagesize="30" table="cms_tags" order="hits desc,id desc"}
        	{rs:eof}暂无标签可选{/rs:eof}
        	<li data-tags="{$rs[title]}">{$rs[title]}<i class="ui-icon-check"></i></li>
        	{/cms:rs}
        </ul>
        {if $total_rs!=0 && $totalpage>1}
        <div class="ui-page ui-page-center ui-page-info">
            <div class="page-list"><ul>{$showpage}</ul></div>
        </div>
        {/if}
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