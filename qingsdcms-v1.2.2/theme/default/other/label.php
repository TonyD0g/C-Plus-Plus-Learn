<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color ui-mb-20">
                    <div class="ui-menu-name">{$page_name}</div>
                </div>
				<div class="ui-show-body">
                {cms:rs pagesize="100" table="cms_tags" where="hits>0" order="id desc"}
				<a href="{U('other/tags','id='.$rs[id].'')}" data-title="{$rs[title]}" data-align="top-left" target="_blank" class="ui-mb ui-mr ui-btn ui-tips">{$rs[title]}</a>
				{/cms:rs}
				
				{if $pg->totalpage>1}
                <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
                {/if}
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
</body>
</html>