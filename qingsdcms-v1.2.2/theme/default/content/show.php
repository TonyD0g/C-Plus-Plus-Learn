<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	{if $isnice==1}<span class="ui-flag"><i>推荐</i></span>{/if}
            	<div class="ui-show-title">
            		<h1>{$title}</h1>
                    <div>{date('Y-m-d H:i',$createdate)}　<code>{$hits}</code> 浏览</div>
                </div>
                <div class="ui-show-image">
                	<!--组图开始-->
                    {if is_array($piclist)}
                    <div class="ui-row">
                        {foreach $piclist as $key=>$rs}
                        <div class="ui-col-3">
                            <div class="ui-card">
                                <div class="ui-card-image">
                                    <a href="{$rs['image']}" class="ui-lightbox" data-title="{$rs['desc']}"><img src="{$rs['image']}" alt="{$rs['desc']}" /></a>
                                </div>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                    {/if}
                    <!--组图结束-->
                </div>
				<div class="ui-show-body">
                	{$content}
                	{if $pagenum>1}<div class="ui-page ui-page-center ui-page-mid"><ul>{pagelist($page,$pagenum)}</ul></div>{/if}
                </div>
                <div class="ui-row">
                	<div class="ui-col-6 ui-show-tags">
                    	{foreach $tagslist as $rs}
                        <a href="{$rs['url']}" title="{$rs['name']}" target="_blank" class="ui-btn ui-btn-blue ui-btn-outline-blue ui-mr-sm">{$rs['name']}</a>
                        {/foreach}
                    </div>
                    <div class="ui-col-6 ui-show-share">
                    	分享：<a href="javascript:;" data-share="qq" data-title="分享到QQ空间" class="ui-tips"><i class="ui-icon-qq"></i></a><a href="javascript:;" data-share="weibo" data-title="分享到微博" class="ui-tips"><i class="ui-icon-weibo"></i></a><a href="javascript:;" data-share="weixin" data-title="分享到微信" class="ui-tips"><i class="ui-icon-weixin"></i></a>
                    </div>
                </div>
                
            </div>
            
            <div class="box ui-mt-20 ui-row">
            	<span class="ui-pre"><i>上一篇</i></span>
                <span class="ui-next"><i>下一篇</i></span>
            	<div class="ui-col-6 ui-text-hide ui-height-30 ui-pl-30">
                    {cms:rs top="1" table="cms_show" where="isshow=1 and id>$id and classid=$classid"}
                    {rs:eof}暂无资料{/rs:eof}
                    <a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a>
                    {/cms:rs}
                </div>
                <div class="ui-col-6 ui-text-right ui-text-hide ui-height-30 ui-pr-30">
                    {cms:rs top="1" table="cms_show" where="isshow=1 and id< $id and classid=$classid" order="id desc"}
                    {rs:eof}暂无资料{/rs:eof}
                    <a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a>
                    {/cms:rs}
                </div>
            </div>
            
            <div class="box ui-mt-20 ui-row">
            	<div class="ui-col-6 ui-pr-15">
                    <div class="ui-menu ui-menu-color">
                        <div class="ui-menu-name">相关内容</div>
                    </div>
                    <ul class="ui-media-list ui-media-list-min ui-mt-20">
                        {cms:rs top="5" table="cms_show" where="isshow=1 and classid=$classid and id<>$id" order="ordnum desc,id desc"}
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
                <div class="ui-col-6 ui-pl-15">
                    <div class="ui-menu ui-menu-color">
                        <div class="ui-menu-name">相关推荐</div>
                    </div>
                    <ul class="ui-media-list ui-media-list-min ui-mt-20">
                        {cms:rs top="5" table="cms_show" where="isshow=1 and classid=$classid and isnice=1 and id<>$id" order="ordnum desc,id desc"}
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
            </div>
            
        </div>
        <!--左侧结束-->
        
        <!--右侧开始-->
        <div class="container-right">
            {include file="include/right.php"}
        </div>
        <!--右侧结束-->
    </div>

	{include file="include/foot.php"}
    <script src="{WEB_ROOT}public/js/qrcode.js"></script>
</body>
</html>