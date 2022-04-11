<?php if(!defined('IN_CMS')) exit;?><div class="ui-bread width ui-mt-20">
    <ul>
        <li><a href="{WEB_ROOT}">首页</a></li>
        {foreach $position as $key=>$val}
        <li><a href="{$val['url']}" title="{$val['name']}">{$val['name']}</a></li>
        {/foreach}
    </ul>
</div>