<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit; if (!IS_HOME) { ?>
<?php if (!isset($topid)) {  $topid=1; }?>
<?php if (cateurl($topid)!='') { ?>
<div class="box ui-mb-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name"><?php echo get_catename($topid);?></div>
    </div>
    <div class="ui-mt-15 ui-collapse-menu">
		<?php $array_rp=$this->db->load("select * from cms_class  where followid=$topid  order by cate_order,cateid ",0,false,0);$total_rp=count($array_rp);if($total_rp==0){ ?>
		<div class="ui-collapse-menu-title active">
			<a href="<?php echo cateurl($topid);?>"><?php echo get_catename($topid);?></a>
		</div>
<?php } else{ ?>
<?php $i=0;} foreach($array_rp as $rp){ $i++;?>
		<?php $sub_sonid=$rp['cateid'];?>
		<?php $sub_num=get_sonid_num($rp['cateid']);?>
		<div class="ui-collapse-menu-title <?php echo is_active($rp['cateid'],$parentid,'active',1);?>">
			<a href="<?php echo cateurl($rp['cateid']);?>" title="<?php echo $rp['cate_name'];?>"><?php echo $rp['cate_name'];?></a><?php if ($sub_num>0) { ?><i class="ui-icon-right"></i><?php }?>
		</div>
		<?php if ($sub_num>0) { ?>
		<div class="ui-collapse-menu-body <?php echo is_active($rp['cateid'],$parentid,'show',1);?>">
			<ul>
				<?php $array_rs=$this->db->load("select * from cms_class  where followid=$sub_sonid  order by cate_order,cateid ",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
				<li<?php echo is_active($rs['cateid'],$parentid);?>><a href="<?php echo cateurl($rs['cateid']);?>" title="<?php echo $rs['cate_name'];?>"<?php if ($rs['isnew']==1) { ?> target="_blank"<?php }?>><i class="ui-icon-square ui-text-gray ui-font-16 ui-mr"></i><?php echo $rs['cate_name'];?></a></li>
				<?php } if($total_rs>0){ ?>
<?php }?>
			</ul>
		</div>
		<?php }?>
		<?php } if($total_rp>0){ ?>
<?php }?>
	</div>
</div>
<?php }?>
<?php }?>
<div class="box">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">热门内容</div>
    </div>
    <ul class="ui-media-list ui-media-list-min ui-mt-20">
        <?php $array_rs=$this->db->load("select * from cms_show  where isshow=1  order by hits desc,id desc limit 5",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
        <li class="ui-media">
            <div class="ui-media-img ui-mr-20">
                <a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><img src="<?php if ($rs['ispic']==1) {  echo $rs['pic']; } else {  echo C(strtoupper('other_nopic')); }?>" alt="<?php echo $rs['title'];?>" width="100" height="75" /></a>
            </div>
            <div class="ui-media-body">
                <div class="ui-media-header ui-text-hide-2"><a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" data-title="<?php echo $rs['title'];?>" class="ui-tips"><?php echo $rs['title'];?></a></div>
                <div class="ui-media-text ui-text-hide"><?php echo nohtml($rs['intro']);?></div>
            </div>
        </li>
        <?php } if($total_rs>0){ ?>
<?php }?>
    </ul>
</div>
<div class="box ui-mt-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">Tags标签</div>
        <div class="ui-menu-more"><a href="<?php echo N('label');?>">更多</a></div>
    </div>
    <div class="label ui-mt-20">
        <?php $array_rs=$this->db->load("select * from cms_tags  where hits>0  order by id desc limit 10",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
        <a href="<?php echo U('other/tags','id='.$rs['id'].'');?>" data-title="<?php echo $rs['title'];?>" data-align="top-left" target="_blank" class="ui-mb ui-mr ui-btn ui-tips"><?php echo $rs['title'];?></a>
        <?php } if($total_rs>0){ ?>
<?php }?>
    </div>
</div>
<div class="box ui-mt-20">
    <div class="ui-menu ui-menu-color">
        <div class="ui-menu-name">联系方式</div>
    </div>
    <ul class="ui-list ui-mt">
        <li><div><i class="ui-icon-tel ui-text-gray ui-mr"></i><?php echo C(strtoupper('ct_tel'));?></div></li>
        <li><div><i class="ui-icon-mobile ui-text-gray ui-mr"></i><?php echo C(strtoupper('ct_mobile'));?></div></li>
        <li><div><i class="ui-icon-mail ui-text-gray ui-mr"></i><?php echo C(strtoupper('ct_email'));?></div></li>
    </ul>
</div>