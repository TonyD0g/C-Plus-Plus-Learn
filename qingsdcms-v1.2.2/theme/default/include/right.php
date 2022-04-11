<?php if(!defined('IN_CMS')) exit;?>{if !IS_HOME}
{if !isset($topid)}{php $topid=1}{/if}
{if cateurl($topid)!=''}
<div class="box ui-mb-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">{get_catename($topid)}</div>
    </div>
    <!--类别部分开始-->
    <div class="ui-mt-15 ui-collapse-menu">
		{cms:rp top="0" table="cms_class" where="followid=$topid" order="cate_order,cateid"}
		{php $sub_sonid=$rp[cateid]}
		{php $sub_num=get_sonid_num($rp[cateid])}
		{rp:eof}
		<div class="ui-collapse-menu-title active">
			<a href="{cateurl($topid)}">{get_catename($topid)}</a>
		</div>
		{/rp:eof}
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
    <!--类别部分结束-->
</div>
{/if}
{/if}

<div class="box">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">热门内容</div>
    </div>
    
    <ul class="ui-media-list ui-media-list-min ui-mt-20">
        {cms:rs top="5" table="cms_show" where="isshow=1" order="hits desc,id desc"}
        <li class="ui-media">
            <div class="ui-media-img ui-mr-20">
                <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{if $rs[ispic]==1}{$rs[pic]}{else}{cms[other_nopic]}{/if}" alt="{$rs[title]}" width="100" height="75" /></a>
            </div>
            <div class="ui-media-body">
                <div class="ui-media-header ui-text-hide-2"><a href="{$rs[link]}" target="_blank" data-title="{$rs[title]}" class="ui-tips">{$rs[title]}</a></div>
                <div class="ui-media-text ui-text-hide">{nohtml($rs[intro])}</div>
            </div>
        </li>
        {/cms:rs}
    </ul>
</div>

<div class="box ui-mt-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">Tags标签</div>
        <div class="ui-menu-more"><a href="{N('label')}">更多</a></div>
    </div>
    
    <div class="label ui-mt-20">
        {cms:rs top="10" table="cms_tags" where="hits>0" order="id desc"}
        <a href="{U('other/tags','id='.$rs[id].'')}" data-title="{$rs[title]}" data-align="top-left" target="_blank" class="ui-mb ui-mr ui-btn ui-tips">{$rs[title]}</a>
        {/cms:rs}
    </div>
</div>

<div class="box ui-mt-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">联系方式</div>
        <!--<div class="ui-menu-more"><a href="#">更多</a></div>-->
    </div>
    
    <ul class="ui-list ui-mt">
        <li><div><i class="ui-icon-tel ui-text-gray ui-mr"></i>{cms[ct_tel]}</div></li>
        <li><div><i class="ui-icon-mobile ui-text-gray ui-mr"></i>{cms[ct_mobile]}</div></li>
        <li><div><i class="ui-icon-mail ui-text-gray ui-mr"></i>{cms[ct_email]}</div></li>
    </ul>
</div>