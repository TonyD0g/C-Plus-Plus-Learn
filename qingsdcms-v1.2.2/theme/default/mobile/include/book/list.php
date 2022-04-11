<?php if(!defined('IN_CMS')) exit;?>{if cms[state_book_show]==1}
    {cms:rs pagesize="10" num="3" table="cms_book" where="isshow=1" order="id desc"}
    <div class="ui-card ui-card-book ui-mb-30">
        <div class="ui-card-header"><div class="ui-card-header-title">{$rs[name]}</div><div class="ui-card-header-more">{date('Y-m-d H:i',$rs[createdate])}</div></div>
        <div class="ui-card-body">
            <div>{$rs[message]}</div>
        </div>
        {if strlen($rs[reply])>0}
        <div class="ui-card-footer">
            <strong>回复：</strong>{$rs[reply]} 
        </div>
        {/if}
    </div>
    {/cms:rs}
    {if $pg->totalpage>1}
    <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
    {/if}
{/if}