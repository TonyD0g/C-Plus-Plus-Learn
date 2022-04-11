<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}
    
    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">{$page_name}</div>
        </div>
        
        <ul class="ui-media-list ui-mt-15 ui-mb-10">
            {cms:rs pagesize="20" num="3" table="$table" where="$where" order="$order"}
            <li class="ui-media">
                {if $rs[ispic]==1}
                <div class="ui-media-img ui-mr-20">
                    <a href="{$rs[link]}" target="_blank" title="{$rs[title]}"><img src="{$rs[pic]}" alt="{$rs[title]}" width="100" height="75" /></a>
                </div>
                {/if}
                <div class="ui-media-body">
                    <div class="ui-media-header ui-text-hide-2"><a href="{$rs[link]}" target="_blank" title="{$rs[title]}">{redkey($rs[title],$keyword)}</a></div>
                    <div class="ui-media-text ui-text-hide">{redkey(nohtml($rs[intro]),$keyword)}</div>
                </div>
            </li>
            {/cms:rs}
        </ul>
        
        {if $pg->totalpage>1}
        <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
        {/if}
        
    </div>

	{include file="mobile/include/foot.php"}
</body>
</html>