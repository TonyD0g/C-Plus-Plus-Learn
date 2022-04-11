<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}
    
    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color ui-mb-20">
            <div class="ui-menu-name">{$page_name}</div>
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
    </div>

	{include file="mobile/include/foot.php"}
</body>
</html>