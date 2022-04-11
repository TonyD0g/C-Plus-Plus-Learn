<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

    <!--Banner部分开始-->
    <div class="banner-wrap width">
        <div class="ui-carousel banner">
            <div class="ui-carousel-inner">
                {cms:rs table="cms_ad" where="cid=1 and isshow=1" order="ordnum,id"}
                	{rs:eof}
                    <div class="ui-carousel-item active"><a href="#"><img src="/upfile/p/1.jpg" alt="1" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/p/2.jpg" alt="2" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/p/3.jpg" alt="3" /></a></div>
                    {/rs:eof}
                    <div class="ui-carousel-item{if $i==1} active{/if}"><a href="{$rs[url]}"><img src="{$rs[pic]}" alt="{$rs[name]}" /></a></div>
                {/cms:rs}
            </div>
        </div>
    </div>
    <!--Banner部分结束-->
    
    <div class="width ui-mb-20">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">推荐内容</div>
        </div>
    	<!--推荐内容开始-->
        <div class="ui-scroll ui-mt-20" data-ul=".ui-row" data-li=".ui-col-3" data-line="1" data-max="4" data-time="5" data-align="left">
            <div class="ui-row nicebox">
            	{cms:rs top="8" table="cms_show" where="isnice=1 and ispic=1 and isshow=1" order="ordnum desc,id desc"}
                <div class="ui-col-3">
                    <div class="ui-card">
                        <div class="ui-card-image">
                            <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{$rs[pic]}" alt="{$rs[title]}" /></a>
                        </div>
                        <div class="ui-card-body">
                            <div class="ui-card-title ui-text-hide-2"><a href="{$rs[link]}" target="_blank" title="{$rs[title]}">{$rs[title]}</a></div>
                            <p class="ui-card-text">{nohtml($rs[intro])}</p>
                        </div>
                    </div>
                </div>
                {/cms:rs}
            </div>
        </div>
        <!--推荐内容结束-->
    </div>
    
    <div class="container width">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                	<div class="ui-menu-name">最新内容</div>
                </div>
                
                <ul class="ui-media-list ui-mt-30 ui-mb-10">
                	{cms:rs top="10" table="cms_show" where="isshow=1" order="ordnum desc,id desc"}
                    <li class="ui-media">
                    	{if $rs[ispic]==1}
                        <div class="ui-media-img ui-mr-20">
                            <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{$rs[pic]}" alt="{$rs[title]}" width="150" height="113" /></a>
                        </div>
                        {/if}
                        <div class="ui-media-body">
                            <div class="ui-media-header ui-text-hide"><a href="{$rs[link]}" target="_blank" title="{$rs[title]}">{$rs[title]}</a></div>
                            <div class="ui-media-text">{nohtml($rs[intro])}</div>
                            <div class="ui-media-other ui-row">
                                <div class="ui-col-8">
                                    {php $tags=jsdecode($rs[tagslist])}
                                    {if count($tags)>0}
                                    {foreach $tags as $key=>$rt}
                                        <a href="{U('other/tags','id='.$rt['id'].'')}" target="_blank" class="ui-btn ui-btn-red ui-btn-outline-red ui-btn-sm ui-mr-sm ui-tips" data-title="{$rt['name']}" data-align="top-left">{$rt['name']}</a>
                                    {/foreach}
                                    {/if}
                                </div>
                                <div class="ui-col-4 ui-text-right"><i class="ui-icon-time-circle"></i> {date('Y-m-d',$rs[createdate])}</div>
                            </div>
                        </div>
                    </li>
                    {/cms:rs}
                </ul>
                
            </div>
        </div>
        <!--左侧结束-->
        
        <!--右侧开始-->
        <div class="container-right">
            {include file="include/right.php"}
        </div>
        <!--右侧结束-->
    </div>
    
    <div class="width ui-mt-30">
    	<div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">友情链接</div>
        </div>
        <div class="link">
        	{cms:rs top="0" table="cms_link" where="isshow=1" order="ordnum,id"}
            <a href="{$rs[url]}" class="ui-tips" data-title="{$rs[name]}" target="_blank">{$rs[name]}</a>
            {/cms:rs}
        </div>
    </div>
    
	{include file="include/foot.php"}
</body>
</html>