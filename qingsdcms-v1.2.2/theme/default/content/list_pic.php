<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                	<div class="ui-menu-name">{$cate_name}</div>
                </div>
                
                <div class="ui-row boxlist ui-mt-30 ui-mb-10">
                    {cms:rs pagesize="$cate_page" table="$table" where="$where" order="$order"}
                    <div class="ui-col-4">
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

                {if $pg->totalpage>1}
                <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
                {/if}
                
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