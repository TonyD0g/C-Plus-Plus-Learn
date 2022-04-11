<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>{$seo_title}</title>
<meta name="keywords" content="{$seo_key}">
<meta name="description" content="{$seo_desc}">
<link href="{WEB_ROOT}public/css/ui.css" rel="stylesheet" type="text/css" />
<link href="{WEB_THEME}css/cms.css" rel="stylesheet" type="text/css" />
{if cms[other_favicon]}
<link rel="shortcut icon" href="{cms[other_favicon]}"/>
<link rel="bookmark" href="{cms[other_favicon]}"/>
{/if}
</head>

<body>
    <!--头部如果需要白底的，在ui-fixed前添加：bg-white样式-->
    <div class="bg-color ui-fixed">
        <div class="header width">
            <div class="header-left">
                <div class="logo"><a href="{WEB_ROOT}"><img src="{cms[web_logo]}" alt="{cms[web_name]}"></a></div>
                <div class="ui-nav">
                    <!--导航菜单部分开始-->
                    <ul>
                        <li{if IS_HOME} class="active"{/if}><a href="{WEB_ROOT}">首页</a></li>
                        {cms:rp table="cms_class" where="followid=0 and ismenu=1" order="cate_order,cateid"}
                        {php $head_id=$rp[cateid]}
                        <li{is_active($rp[cateid],$parentid)}><a href="{cateurl($rp[cateid])}"{if $rp[isnew]==1} target="_blank"{/if}>{$rp[cate_name]}</a>
                            {cms:rs table="cms_class" where="followid=$head_id and ismenu=1" order="cate_order,cateid"}
                            {rs:head}<ul>{/rs:head}
                                <li><a href="{cateurl($rs[cateid])}"{if $rs[isnew]==1} target="_blank"{/if}>{$rs[cate_name]}</a></li> 
                            {rs:foot}</ul>{/rs:foot}
                            {/cms:rs}
                        </li>
                        {/cms:rp}
                    </ul>
                    <!--导航菜单部分结束-->
                </div>
            </div>
            <div class="header-right">
                <!--搜索部分开始-->
                <form action="{N('search')}" method="post" onSubmit="return checksearch(this)">
                    <div class="search">
                        {if !isempty(cms[pathinfo]) && cms[url_mode]>1}
                        <input type="hidden" name="s" value="search{cms[url_ext]}" />
                        {/if}
                        {if cms[url_mode]==1}
                        <input type="hidden" name="c" value="other" />
                        <input type="hidden" name="a" value="search" />
                        {/if}
                        <input type="hidden" name="token" value="{$token}">
                        <input type="text" name="keyword" placeholder="请输入关键字"><button type="submit"><div class="ui-icon-search"></div></button>
                    </div>
                </form>
                <!--搜索部分结束-->
            </div>
        </div>
    </div>