<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}

   <div class="ui-mwidth box">
        <div class="ui-show-title">
            <h1>{$title}</h1>
            <div>{date('Y-m-d H:i',$createdate)}　<code>{$hits}</code> 浏览</div>
        </div>
        <div class="ui-show-image">
            <!--组图开始-->
            {if is_array($piclist)}
            <div class="ui-row">
                {foreach $piclist as $key=>$rs}
                <div class="ui-col-6">
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
        <div class="ui-show-tags">
            {foreach $tagslist as $rs}
            <a href="{$rs['url']}" title="{$rs['name']}" target="_blank" class="ui-btn ui-btn-blue ui-btn-outline-blue ui-mr-sm">{$rs['name']}</a>
            {/foreach}
        </div>
        
    </div>

    {cms:rs top="5" table="cms_show" where="isshow=1 and classid=$classid and id<>$id" order="ordnum desc,id desc"}
    {rs:head}
    <div class="ui-mwidth box ui-mt-10">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">相关内容</div>
        </div>
        <ul class="ui-media-list ui-media-list-min ui-mt-20">
            {/rs:head}
            <li class="ui-media">
                <div class="ui-media-img ui-mr-20">
                    <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{if $rs[ispic]==1}{$rs[pic]}{else}{cms[other_nopic]}{/if}" alt="{$rs[title]}" width="100" height="75" /></a>
                </div>
                <div class="ui-media-body">
                    <div class="ui-media-header ui-text-hide-2"><a href="{$rs[link]}" target="_blank" data-title="{$rs[title]}" class="ui-tips">{$rs[title]}</a></div>
                    <div class="ui-media-text ui-text-hide">{nohtml($rs[intro])}</div>
                </div>
            </li>
            {rs:foot}
        </ul>
       
    </div>{/rs:foot}
	{/cms:rs}
    
    {cms:rs top="5" table="cms_show" where="isshow=1 and classid=$classid and isnice=1 and id<>$id" order="ordnum desc,id desc"}
    {rs:head}
    <div class="ui-mwidth box ui-mt-10">

        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">相关推荐</div>
        </div>
        <ul class="ui-media-list ui-media-list-min ui-mt-20">
            {/rs:head}
            <li class="ui-media">
                <div class="ui-media-img ui-mr-20">
                    <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{if $rs[ispic]==1}{$rs[pic]}{else}{cms[other_nopic]}{/if}" alt="{$rs[title]}" width="100" height="75" /></a>
                </div>
                <div class="ui-media-body">
                    <div class="ui-media-header ui-text-hide-2"><a href="{$rs[link]}" target="_blank" data-title="{$rs[title]}" class="ui-tips">{$rs[title]}</a></div>
                    <div class="ui-media-text ui-text-hide">{nohtml($rs[intro])}</div>
                </div>
            </li>
            {rs:foot}
        </ul>
    </div>{/rs:foot}
	{/cms:rs}
	{include file="mobile/include/foot.php"}
    <script src="{WEB_ROOT}public/js/qrcode.js"></script>
</body>
</html>