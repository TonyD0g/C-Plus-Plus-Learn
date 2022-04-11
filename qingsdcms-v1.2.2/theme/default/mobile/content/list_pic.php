<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}

    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">{$cate_name}</div>
            <div class="ui-menu-more"><a href="javascript:;" class="subnav"><i class="ui-icon-folder"></i></a></div>
        </div>
        
        <!--类别部分开始-->
        <div class="ui-mt-15 ui-collapse-menu ui-subnav" style="display:none;">
            {cms:rp top="0" table="cms_class" where="followid=$topid" order="cate_order,cateid"}
            {php $sub_sonid=$rp[cateid]}
            {php $sub_num=get_sonid_num($rp[cateid])}
            {rp:eof}
            <div class="ui-collapse-menu-title active">
                <a href="{cateurl($topid)}">{get_catename($topid)}</a>
            </div>
            {/rp:eof}
            <div class="ui-collapse-menu-title {is_active($rp[cateid],$parentid,'active',1)}">
                <a href="{cateurl($rp[cateid])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a>{if $sub_num>0}<i class="ui-icon-right"></i>{/if}
            </div>
            {if $sub_num>0}
            <div class="ui-collapse-menu-body {is_active($rp[cateid],$parentid,'show',1)}">
                <ul>
                    {cms:rs top="0" table="cms_class" where="followid=$sub_sonid" order="cate_order,cateid"}
                    <li{is_active($rs[cateid],$parentid)}><a href="{cateurl($rs[cateid])}" title="{$rs[cate_name]}"{if $rs[isnew]==1} target="_blank"{/if}><i class="ui-icon-square ui-text-gray ui-font-16 ui-mr"></i>{$rs[cate_name]}</a></li>
                    {/cms:rs}
                </ul>
            </div>
            {/if}
            {/cms:rp}
        </div>
        <!--类别部分结束-->
        
        <div class="ui-row nicebox">
            {cms:rs pagesize="$cate_page" num="3" table="$table" where="$where" order="$order"}
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
       
        {if $pg->totalpage>1}
        <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
        {/if}
        
    </div>

	{include file="mobile/include/foot.php"}
</body>
</html>