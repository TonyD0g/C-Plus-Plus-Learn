<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color ui-mb-20">
                    <div class="ui-menu-name">{$page_name}</div>
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