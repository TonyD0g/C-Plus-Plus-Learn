<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                	<div class="ui-menu-name">{$cate_name}</div>
                </div>
                
                <ul class="ui-media-list ui-mt-30 ui-mb-10">
                	{cms:rs pagesize="$cate_page" table="$table" where="$where" order="$order"}
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