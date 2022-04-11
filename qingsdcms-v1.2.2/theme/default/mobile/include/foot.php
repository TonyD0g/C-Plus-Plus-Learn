<?php if(!defined('IN_CMS')) exit;?><div class="ui-mwidth copyright">
	<div class="ui-text-center">
    <div class="footnav"><a href="{WEB_ROOT}">网站首页</a>　|　<a href="{N('sitemap')}">网站地图</a>　|　<a href="{N('label')}">Tags标签</a>{if cms[state_book]==1}　|　<a href="{N('book')}">在线留言</a>{/if}</div>
    版权所有：{cms[ct_company]}　<a href="{cms[other_beian]}" target="_blank">{cms[web_icp]}</a> {cms[count_code]}
    <div class="ui-text-gray">{runtime()}</div></div>
</div>
<div class="ui-hide">{cms[count_code]}</div>
<div class="ui-offside ui-offside-bottom ui-p-15 ui-pt-20" id="offside-search">
	<form action="{N('search')}" method="post" onSubmit="return checksearch(this)">
        <div class="ui-form-group">
            <div class="ui-input-group">
                {if !isempty(cms[pathinfo]) && cms[url_mode]>1}
                <input type="hidden" name="s" value="search{cms[url_ext]}" />
                {/if}
                {if cms[url_mode]==1}
                <input type="hidden" name="c" value="other" />
                <input type="hidden" name="a" value="search" />
                {/if}
                <input type="hidden" name="token" value="{$token}">
                <input type="text" name="keyword" class="ui-form-ip radius-right-none" placeholder="请输入关键字">
                <button type="submit" class="after"><div class="ui-icon-search"></div></button>
            </div>
        </div>
    </form>
</div>

<div class="ui-sidebar ui-sidebar-color">
    <ul>
    	{foreach $plug_service as $key=>$val}
        <li><a href="http://wpa.qq.com/msgrd?v=3&uin={$val['qq']}&site=qq&menu=yes" target="_blank"><i class="ui-icon-qq"></i></a><div>{$val['title']}</div></li>
        {/foreach}
        {if cms[ct_weixin]}<li><a href="{cms[ct_weixin]}" class="ui-lightbox" data-title="扫码加微信"><i class="ui-icon-weixin"></i></a><div>点击查看</div></li>{/if}
        {if cms[state_book]==1}<li><a href="{N('book')}"><i class="ui-icon-edit"></i></a><div>在线留言</div></li>{/if}
        <li><a href="javascript:;" class="ui-offside-show" data-target="#offside-search"><i class="ui-icon-search"></i></a><div>站内搜索</div></li>
        <li class="ui-backtop" id="backtop"><a href="javascript:;"><i class="ui-icon-top"></i></a><div>返回顶部</div></li>
    </ul>
</div>
<script src="/public/js/jquery.js"></script>
<script src="/public/js/ui.js"></script>
<script src="{WEB_THEME}js/cms.js"></script>