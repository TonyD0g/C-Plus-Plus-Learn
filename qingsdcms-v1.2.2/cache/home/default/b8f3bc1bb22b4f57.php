<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit; include $this->tp->parse_include_twos("include/head.php");?>
    <div class="banner-wrap width">
        <div class="ui-carousel banner">
            <div class="ui-carousel-inner">
                <?php $array_rs=$this->db->load("select * from cms_ad  where cid=1 and isshow=1  order by ordnum,id limit 10",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
                    <div class="ui-carousel-item active"><a href="#"><img src="/upfile/p/1.jpg" alt="1" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/p/2.jpg" alt="2" /></a></div>
                    <div class="ui-carousel-item"><a href="#"><img src="/upfile/p/3.jpg" alt="3" /></a></div>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
                    <div class="ui-carousel-item<?php if ($i==1) { ?> active<?php }?>"><a href="<?php echo $rs['url'];?>"><img src="<?php echo $rs['pic'];?>" alt="<?php echo $rs['name'];?>" /></a></div>
                <?php } if($total_rs>0){ ?>
<?php }?>
            </div>
        </div>
    </div>
    <div class="width ui-mb-20">
        <div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">推荐内容</div>
        </div>
        <div class="ui-scroll ui-mt-20" data-ul=".ui-row" data-li=".ui-col-3" data-line="1" data-max="4" data-time="5" data-align="left">
            <div class="ui-row nicebox">
            	<?php $array_rs=$this->db->load("select * from cms_show  where isnice=1 and ispic=1 and isshow=1  order by ordnum desc,id desc limit 8",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
                <div class="ui-col-3">
                    <div class="ui-card">
                        <div class="ui-card-image">
                            <a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><img src="<?php echo $rs['pic'];?>" alt="<?php echo $rs['title'];?>" /></a>
                        </div>
                        <div class="ui-card-body">
                            <div class="ui-card-title ui-text-hide-2"><a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><?php echo $rs['title'];?></a></div>
                            <p class="ui-card-text"><?php echo nohtml($rs['intro']);?></p>
                        </div>
                    </div>
                </div>
                <?php } if($total_rs>0){ ?>
<?php }?>
            </div>
        </div>
    </div>
    <div class="container width">
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                	<div class="ui-menu-name">最新内容</div>
                </div>
                <ul class="ui-media-list ui-mt-30 ui-mb-10">
                	<?php $array_rs=$this->db->load("select * from cms_show  where isshow=1  order by ordnum desc,id desc limit 10",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
                    <li class="ui-media">
                    	<?php if ($rs['ispic']==1) { ?>
                        <div class="ui-media-img ui-mr-20">
                            <a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><img src="<?php echo $rs['pic'];?>" alt="<?php echo $rs['title'];?>" width="150" height="113" /></a>
                        </div>
                        <?php }?>
                        <div class="ui-media-body">
                            <div class="ui-media-header ui-text-hide"><a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><?php echo $rs['title'];?></a></div>
                            <div class="ui-media-text"><?php echo nohtml($rs['intro']);?></div>
                            <div class="ui-media-other ui-row">
                                <div class="ui-col-8">
                                    <?php $tags=jsdecode($rs['tagslist']);?>
                                    <?php if (count($tags)>0) { ?>
                                    <?php foreach($tags as $key=>$rt) { ?>
                                        <a href="<?php echo U('other/tags','id='.$rt['id'].'');?>" target="_blank" class="ui-btn ui-btn-red ui-btn-outline-red ui-btn-sm ui-mr-sm ui-tips" data-title="<?php echo $rt['name'];?>" data-align="top-left"><?php echo $rt['name'];?></a>
                                    <?php }?>
                                    <?php }?>
                                </div>
                                <div class="ui-col-4 ui-text-right"><i class="ui-icon-time-circle"></i> <?php echo date('Y-m-d',$rs['createdate']);?></div>
                            </div>
                        </div>
                    </li>
                    <?php } if($total_rs>0){ ?>
<?php }?>
                </ul>
            </div>
        </div>
        <div class="container-right">
            <?php include $this->tp->parse_include_twos("include/right.php");?>
        </div>
    </div>
    <div class="width ui-mt-30">
    	<div class="ui-menu ui-menu-color">
            <div class="ui-menu-name">友情链接</div>
        </div>
        <div class="link">
        	<?php $array_rs=$this->db->load("select * from cms_link  where isshow=1  order by ordnum,id ",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
            <a href="<?php echo $rs['url'];?>" class="ui-tips" data-title="<?php echo $rs['name'];?>" target="_blank"><?php echo $rs['name'];?></a>
            <?php } if($total_rs>0){ ?>
<?php }?>
        </div>
    </div>
	<?php include $this->tp->parse_include_twos("include/foot.php");?>
</body>
</html>