<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title><?php echo $seo_title;?></title>
<meta name="keywords" content="<?php echo $seo_key;?>">
<meta name="description" content="<?php echo $seo_desc;?>">
<link href="<?php echo WEB_ROOT;?>public/css/ui.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_THEME;?>css/cms.css" rel="stylesheet" type="text/css" />
<?php if (C(strtoupper('other_favicon'))) { ?>
<link rel="shortcut icon" href="<?php echo C(strtoupper('other_favicon'));?>"/>
<link rel="bookmark" href="<?php echo C(strtoupper('other_favicon'));?>"/>
<?php }?>
</head>
<body>
    <div class="bg-color ui-fixed">
        <div class="header width">
            <div class="header-left">
                <div class="logo"><a href="<?php echo WEB_ROOT;?>"><img src="<?php echo C(strtoupper('web_logo'));?>" alt="<?php echo C(strtoupper('web_name'));?>"></a></div>
                <div class="ui-nav">
                    <ul>
                        <li<?php if (IS_HOME) { ?> class="active"<?php }?>><a href="<?php echo WEB_ROOT;?>">首页</a></li>
                        <?php $array_rp=$this->db->load("select * from cms_class  where followid=0 and ismenu=1  order by cate_order,cateid limit 10",0,false,0);$total_rp=count($array_rp);if($total_rp==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rp as $rp){ $i++;?>
                        <?php $head_id=$rp['cateid'];?>
                        <li<?php echo is_active($rp['cateid'],$parentid);?>><a href="<?php echo cateurl($rp['cateid']);?>"<?php if ($rp['isnew']==1) { ?> target="_blank"<?php }?>><?php echo $rp['cate_name'];?></a>
                            <?php $array_rs=$this->db->load("select * from cms_class  where followid=$head_id and ismenu=1  order by cate_order,cateid limit 10",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?><ul>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
                                <li><a href="<?php echo cateurl($rs['cateid']);?>"<?php if ($rs['isnew']==1) { ?> target="_blank"<?php }?>><?php echo $rs['cate_name'];?></a></li> 
                            <?php } if($total_rs>0){ ?></ul>
<?php }?>
                        </li>
                        <?php } if($total_rp>0){ ?>
<?php }?>
                    </ul>
                </div>
            </div>
            <div class="header-right">
                <form action="<?php echo N('search');?>" method="post" onSubmit="return checksearch(this)">
                    <div class="search">
                        <?php if (!isempty(C(strtoupper('pathinfo'))) && C(strtoupper('url_mode'))>1) { ?>
                        <input type="hidden" name="s" value="search<?php echo C(strtoupper('url_ext'));?>" />
                        <?php }?>
                        <?php if (C(strtoupper('url_mode'))==1) { ?>
                        <input type="hidden" name="c" value="other" />
                        <input type="hidden" name="a" value="search" />
                        <?php }?>
                        <input type="hidden" name="token" value="<?php echo $token;?>">
                        <input type="text" name="keyword" placeholder="请输入关键字"><button type="submit"><div class="ui-icon-search"></div></button>
                    </div>
                </form>
            </div>
        </div>
    </div>