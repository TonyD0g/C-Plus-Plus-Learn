<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
<meta name="renderer" content="webkit">
<title>{$seo_title}</title>
<meta name="keywords" content="{$seo_key}">
<meta name="description" content="{$seo_desc}">
<link href="{WEB_ROOT}public/css/ui.css" rel="stylesheet" type="text/css" />
<link href="{WEB_THEME}mobile/css/cms.css" rel="stylesheet" type="text/css" />
{if cms[other_favicon]}
<link rel="shortcut icon" href="{cms[other_favicon]}"/>
<link rel="bookmark" href="{cms[other_favicon]}"/>
{/if}
</head>

<body>
	<!--头部如果需要白底的，在ui-fixed前添加：bg-white样式-->
    <div class="bg-color">
    	<div class="header mwidth bg-color ui-fixed">
            <div class="logo"><a href="{WEB_ROOT}"><img src="{cms[web_logo]}" alt="{cms[web_name]}"></a></div>
        	<div class="nav">
            	<a href="javascript:;" class="ui-offside-show" data-target="#offside-nav"><i class="ui-icon-lists"></i></a>
            </div>
        </div>
    </div>
    
    <div class="ui-offside ui-offside-left ui-p-15" id="offside-nav">

        <div class="ui-collapse-menu-title"><a href="{WEB_ROOT}" title="网站首页">网站首页</a></div>
        {cms:rp top="0" table="cms_class" where="followid=0" order="cate_order,cateid"}
		{php $sub_sonid=$rp[cateid]}
		{php $sub_num=get_sonid_num($rp[cateid])}
		<div class="ui-collapse-menu-title {is_active($rp[cateid],$parentid,'active',1)}">
			<a href="{cateurl($rp[cateid])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a>{if $sub_num>0}<i class="ui-icon-right"></i>{/if}
		</div>
		{if $sub_num>0}
		<div class="ui-collapse-menu-body {is_active($rp[cateid],$parentid,'show',1)}">
			<ul>
				{cms:rs top="0" table="cms_class" where="followid=$sub_sonid" order="cate_order,cateid"}
				<li{is_active($rs[cateid],$parentid)}><a href="{cateurl($rs[cateid])}" title="{$rs[cate_name]}"{if $rs[isnew]==1} target="_blank"{/if}><i class="ui-icon-square ui-text-gray ui-font-16 ui-mr"></i>{$rs[cate_name]}</a></li>
				{/cms:rs}
			</ul>
		</div>
		{/if}
		{/cms:rp}
    </div>