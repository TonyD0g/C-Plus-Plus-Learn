<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>附件选择</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/admin/js/base.js"></script>
</head>

<body class="ui-p-10">

<div class="ui-tabs ui-tabs-white" data-href="1">
	<ul class="ui-tabs-nav">
	  <li class="active"><a href="{U('imagelist','type=3&multiple='.$multiple.'&gid=0&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">附件选择</a></li>
	  <li><a href="{U('imageupload','type=3&multiple='.$multiple.'&gid='.$gid.'&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">本地上传</a></li>
	</ul>
	<div class="ui-tabs-content">
		<div class="ui-tabs-pane active">
			<!--loop-->
			<div class="ui-tabs" data-href="1" style="margin-top:-10px;">
				<div class="ui-tabs-header-nav">
					<ul class="ui-tabs-nav">
						{if $iseditor==0}
						<li class="active"><a href="{THIS_LOCAL}">附件选择</a></li>
						{else}
						<li{if $type==0} class="active"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type=0&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">全部文件</a></li>
						<li{if $type==1} class="active"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type=1&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">图片文件</a></li>
						<li{if $type==2} class="active"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type=2&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">视频文件</a></li>
						<li{if $type==3} class="active"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type=3&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">其他文件</a></li>
						{/if}
					</ul>
                    <div class="ui-tabs-header-more">
                    	<form action="{THIS_LOCAL}">
                    	<div class="ui-form-group">
                            <div class="ui-input-group">
                            	{if cms[url_mode]==1}
                                    {if !isempty(cms[pathinfo]) && cms[url_mode]>1}<input type="hidden" name="s" value="{PATH_URL}" />{/if}
                                    {if cms[url_mode]==1}
                                        <input type="hidden" name="m" value="{MODULE_NAME}" />
                                        <input type="hidden" name="c" value="{CONTROLLER_NAME}" />
                                        <input type="hidden" name="a" value="{ACTION_NAME}" />
                                        <input type="hidden" name="multiple" value="{$multiple}" />
                                        <input type="hidden" name="type" value="{$type}" />
                                        <input type="hidden" name="iseditor" value="{$iseditor}" />
                                        <input type="hidden" name="islocal" value="{$islocal}" />
                                        <input type="hidden" name="thumb" value="{$thumb}" />
                                        <input type="hidden" name="water" value="{$water}" />
                                        <input type="hidden" name="gid" value="{$gid}" />
                                    {/if}
                                {/if}
                                <input type="text" name="keyword" value="{$keyword}" class="ui-form-ip radius-right-none" placeholder="请输入关键字" style="min-width:200px;">
                                <button type="submit" class="after"><div class="ui-icon-search"></div></button>
                            </div>
                        </div>
                        </form>
                    </div>
				</div>
				
			</div>
			
			<div class="ui-row ui-mt-15 ui-mb">
				<div class="filelist-left">
					<ul>
						<li{if $gid==-1} class="actice"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type='.$type.'&iseditor='.$iseditor.'&islocal='.$islocal.'&gid=-1&thumb='.$thumb.'&water='.$water.'')}"><span>{$total}</span>未分组</a></li>
						{cms:rs top="0" field="aid,gname,(select count(1) from cms_file where gid=a.aid $where_query) as num" table="cms_file_group a" where="isshow=1" order="ordnum,aid"}
						<li{if $gid==$rs[aid]} class="actice"{/if}><a href="{U('imagelist','multiple='.$multiple.'&type='.$type.'&iseditor='.$iseditor.'&islocal='.$islocal.'&gid='.$rs[aid].'&thumb='.$thumb.'&water='.$water.'')}"><span>{$rs[num]}</span>{$rs[gname]}</a></li>
						{/cms:rs}
					</ul>
				</div>
				<div class="filelist-right">
					<!---->
					 <div class="ui-piclist ui-piclist-16-9 ui-piclist-col-right" id="list">
						<div id="list_pre"></div>
						{cms:rs pagesize="20" table="cms_file" where="$where" order="$order"}
						{rs:eof}
							<div class="ui-pt ui-pl ui-font-14 nothing">暂无文件</div>
						{/rs:eof}
						<div class="ui-piclist-item" data-url="{$rs[file_url]}" title="{$rs[file_name]}">
							<div class="ui-piclist-image{if $rs[file_type]>1} file-preview file-type-{trim($rs[file_ext],".")}{/if}">
							{if $rs[file_type]==1}
								<a><img src="{$rs[file_url]}" /></a>
							{else}
								<a></a>
							{/if}
							</div>
							<div class="ui-piclist-body">
								<div class="ui-piclist-title ui-text-hide">{$rs[file_name]}</div>
							</div>
						</div>
						{/cms:rs}
					</div>
					<!---->
				</div>
			</div>
	
			{if $total_rs!=0}
			<div class="ui-page ui-page-center ui-page-info ui-mt">
				<ul>{$showpage}</ul>
			</div>
			{/if}
	
			<input type="hidden" id="piclist">
			<!--loop-->
		</div>
	</div>
</div>
<script>
$(function()
{
	$(document).on("click","#list .ui-piclist-item",function()
	{
		var val=$(this).data("url");
		{if $multiple==0}
		$("#list .ui-piclist-item").each(function()
		{
			$(this).removeClass("hover");
		})
		{/if}
		$(this).toggleClass("hover");
		choose();
	});
});
function choose()
{
	var str='';
	$("#list .ui-piclist-item").each(function(){
		var val=$(this).data("url");
		if($(this).hasClass("hover"))
		{
			if(str!='')
			{
				str=str+'|';
			}
			str=str+val;
		}
	})
	$('#piclist').val(str);
}
</script>
</body>
</html>