<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><div class="ui-bread width ui-mt-20">
    <ul>
        <li><a href="<?php echo WEB_ROOT;?>">首页</a></li>
        <?php foreach($position as $key=>$val) { ?>
        <li><a href="<?php echo $val['url'];?>" title="<?php echo $val['name'];?>"><?php echo $val['name'];?></a></li>
        <?php }?>
    </ul>
</div>