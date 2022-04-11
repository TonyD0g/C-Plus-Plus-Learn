<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}
    
    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color ui-mb-20">
            <div class="ui-menu-name">{$page_name}</div>
        </div>
        <div class="ui-show-body">
        <!--开始-->
        {cms:rs pagesize="100" num="3" table="cms_tags" where="hits>0" order="id desc"}
        <a href="{U('other/tags','id='.$rs[id].'')}" data-title="{$rs[title]}" target="_blank" class="ui-mb ui-btn-sm ui-mr-sm ui-btn ui-tips">{$rs[title]}</a>
        {/cms:rs}
        
        {if $pg->totalpage>1}
        <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
        {/if}
        <!--结束-->
        </div>
    </div>
    
	{include file="mobile/include/foot.php"}
</body>
</html>