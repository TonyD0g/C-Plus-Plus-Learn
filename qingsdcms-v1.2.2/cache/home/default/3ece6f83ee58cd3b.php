<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><div class="copyright">
	<div class="ui-text-center">
    <div class="footnav"><a href="<?php echo WEB_ROOT;?>">网站首页</a>　|　<a href="<?php echo N('sitemap');?>">网站地图</a>　|　<a href="<?php echo N('label');?>">Tags标签</a><?php if (C(strtoupper('state_book'))==1) { ?>　|　<a href="<?php echo N('book');?>">在线留言</a><?php }?></div>
    版权所有：<?php echo C(strtoupper('ct_company'));?>　<a href="<?php echo C(strtoupper('other_beian'));?>" target="_blank"><?php echo C(strtoupper('web_icp'));?></a>　<a href="<?php echo C(strtoupper('beian_url'));?>" target="_blank"><?php echo C(strtoupper('beian_num'));?></a> <?php echo C(strtoupper('count_code'));?>
    <div class="ui-text-gray"><?php echo runtime();?></div></div>
</div>
<div class="ui-sidebar ui-sidebar-color">
    <ul>
    	<?php foreach($plug_service as $key=>$val) { ?>
        <li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $val['qq'];?>&site=qq&menu=yes" target="_blank"><i class="ui-icon-qq"></i></a><div><?php echo $val['title'];?></div></li>
        <?php }?>
        <?php if (C(strtoupper('ct_weixin'))) { ?><li><a href="<?php echo C(strtoupper('ct_weixin'));?>" class="ui-lightbox" data-title="扫码加微信"><i class="ui-icon-weixin"></i></a><div>点击查看</div></li><?php }?>
        <?php if (C(strtoupper('state_book'))==1) { ?><li><a href="<?php echo N('book');?>"><i class="ui-icon-edit"></i></a><div>在线留言</div></li><?php }?>
        <?php if (C(strtoupper('mobile_open'))==1 && !isempty(C(strtoupper('mobile_domain')))) { ?>
        <li><a href="<?php echo C(strtoupper('mobile_http')); echo C(strtoupper('mobile_domain'));?>" target="_blank"><i class="ui-icon-mobile"></i></a><div>手机网站</div></li>
        <?php }?>
        <li class="ui-backtop" id="backtop"><a href="javascript:;"><i class="ui-icon-top"></i></a><div>返回顶部</div></li>
    </ul>
</div>
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
<script src="<?php echo WEB_THEME;?>js/cms.js"></script>