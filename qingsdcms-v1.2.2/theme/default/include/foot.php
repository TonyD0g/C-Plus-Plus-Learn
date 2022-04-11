<?php if(!defined('IN_CMS')) exit;?><div class="copyright">
	<div class="ui-text-center">
    <div class="footnav"><a href="{WEB_ROOT}">网站首页</a>　|　<a href="{N('sitemap')}">网站地图</a>　|　<a href="{N('label')}">Tags标签</a>{if cms[state_book]==1}　|　<a href="{N('book')}">在线留言</a>{/if}</div>
    版权所有：{cms[ct_company]}　<a href="{cms[other_beian]}" target="_blank">{cms[web_icp]}</a>　<a href="{cms[beian_url]}" target="_blank">{cms[beian_num]}</a> {cms[count_code]}
    <div class="ui-text-gray">{runtime()}</div></div>
</div>


<div class="ui-sidebar ui-sidebar-color">
    <ul>
    	{foreach $plug_service as $key=>$val}
        <li><a href="http://wpa.qq.com/msgrd?v=3&uin={$val['qq']}&site=qq&menu=yes" target="_blank"><i class="ui-icon-qq"></i></a><div>{$val['title']}</div></li>
        {/foreach}
        {if cms[ct_weixin]}<li><a href="{cms[ct_weixin]}" class="ui-lightbox" data-title="扫码加微信"><i class="ui-icon-weixin"></i></a><div>点击查看</div></li>{/if}
        {if cms[state_book]==1}<li><a href="{N('book')}"><i class="ui-icon-edit"></i></a><div>在线留言</div></li>{/if}
        {if cms[mobile_open]==1 && !isempty(cms[mobile_domain])}
        <li><a href="{cms[mobile_http]}{cms[mobile_domain]}" target="_blank"><i class="ui-icon-mobile"></i></a><div>手机网站</div></li>
        {/if}
        <li class="ui-backtop" id="backtop"><a href="javascript:;"><i class="ui-icon-top"></i></a><div>返回顶部</div></li>
    </ul>
</div>
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_THEME}js/cms.js"></script>