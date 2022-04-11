<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}
	
    <!--Banner部分开始-->
    <div class="banner-wrap">
        <div class="ui-carousel banner">
            <div class="ui-carousel-inner">
                {cms:rs table="cms_ad" where="cid=2 and isshow=1" order="ordnum,id"}
                	{rs:eof}
                    <div class="ui-carousel-item active"><a href="#"><img src="/upfile/m/1.jpg" alt="1" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/m/2.jpg" alt="2" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/m/3.jpg" alt="3" /></a></div>
                    {/rs:eof}
                    <div class="ui-carousel-item{if $i==1} active{/if}"><a href="{$rs[url]}"><img src="{$rs[pic]}" alt="{$rs[name]}" /></a></div>
                {/cms:rs}
            </div>
        </div>
    </div>
    <!--Banner部分结束-->
    
    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">推荐内容</div>
        </div>
        
        <!--推荐内容开始-->
        <div class="ui-row nicebox">
            {cms:rs top="8" table="cms_show" where="isnice=1 and ispic=1 and isshow=1" order="ordnum desc,id desc"}
            <div class="ui-col-6">
                <div class="ui-card">
                    <div class="ui-card-image">
                        <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{$rs[pic]}" alt="{$rs[title]}" /></a>
                    </div>
                    <div class="ui-card-body">
                        <div class="ui-card-title ui-text-hide-2"><a href="{$rs[link]}" target="_blank" title="{$rs[title]}">{$rs[title]}</a></div>
                    </div>
                </div>
            </div>
            {/cms:rs}
        </div>
        <!--推荐内容结束-->
        
    </div>
    
    <div class="ui-mwidth box ui-mt-10">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">最新内容</div>
        </div>
        
        <ul class="ui-media-list ui-mt-15">
            {cms:rs top="10" table="cms_show" where="isshow=1" order="ordnum desc,id desc"}
            <li class="ui-media">
                {if $rs[ispic]==1}
                <div class="ui-media-img ui-mr-20">
                    <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{$rs[pic]}" alt="{$rs[title]}" width="100" height="75"/></a>
                </div>
                {/if}
                <div class="ui-media-body">
                    <div class="ui-media-header ui-text-hide-2"><a href="{$rs[link]}" target="_blank" title="{$rs[title]}">{$rs[title]}</a></div>
                    <div class="ui-media-text ui-text-hide">{nohtml($rs[intro])}</div>
                </div>
            </li>
            {/cms:rs}
        </ul>
        
    </div>
    
    <div class="ui-mwidth box ui-mt-10">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">热门内容</div>
        </div>
        
        <ul class="ui-media-list ui-mt-15">
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

    <div class="ui-mwidth box ui-mt-10">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">Tags标签</div>
            <div class="ui-menu-more"><a href="{N('label')}">更多</a></div>
        </div>
        
        <div class="label ui-mt-20">
            {cms:rs top="10" table="cms_tags" where="hits>0" order="id desc"}
            <a href="{U('other/tags','id='.$rs[id].'')}" data-title="{$rs[title]}" target="_blank" class="ui-mb ui-btn-sm ui-mr-sm ui-btn ui-tips">{$rs[title]}</a>
            {/cms:rs}
        </div>
    </div>
    
    <div class="ui-mwidth box ui-mt-10">
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
    
    <div class="ui-mwidth box ui-mt-10 ui-mb-10">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">友情链接</div>
        </div>
        
        <div class="link">
        	{cms:rs top="0" table="cms_link" where="isshow=1" order="ordnum,id"}
            <a href="{$rs[url]}" class="ui-tips" data-title="{$rs[name]}" target="_blank">{$rs[name]}</a>
            {/cms:rs}
        </div>
    </div>

    
	{include file="mobile/include/foot.php"}
</body>
</html>