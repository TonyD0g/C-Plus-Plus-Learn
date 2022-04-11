<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit; include $this->tp->parse_include_twos("include/head.php");?>
	<?php include $this->tp->parse_include_twos("include/bread.php");?>
    <div class="container width ui-mt-20">
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                	<div class="ui-menu-name"><?php echo $page_name;?></div>
                </div>
                <ul class="ui-media-list ui-mt-30 ui-mb-10">
                	<?php $total_rs=$this->db->count("select count(1) from $table  where $where ");$pagesize=20;$totalpage=ceil($total_rs/$pagesize);if($page>$totalpage){
$page=1;}$offset=($page-1)*$pagesize;$way=0;if($offset>1000 && $total_rs>2000 && $offset>$total_rs/2){	$offset=$total_rs-$offset-$pagesize;	$way=1;}if($offset<0){	$pagesize+=$offset;	$offset=0;}$key_="id";$table_="$table";$join_="";$where_="where $where";$group_="";$order_="order by $order";$field_="*";$type_="0";$keylist=$this->db->getkeylist($key_,$table_,$join_,$where_,$order_,$offset,$pagesize,$way,$type_);$array_rs=$this->db->load("select $field_ from $table_ $join_ $keylist $group_ $order_");$pg=new cms_page($total_rs,$totalpage,$pagesize,$page);$showpage=$pg->showpage(5);if($total_rs==0){ ?>没有找到含有<span class="ui-text-red ui-ml ui-mr"><?php echo $keyword;?></span>的内容<?php } else{  $i=0;} foreach($array_rs as $rs){ $i++;?>
                    <li class="ui-media">
                        <?php if ($rs['ispic']==1) { ?>
                        <div class="ui-media-img ui-mr-20">
                            <a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><img src="<?php echo $rs['pic'];?>" alt="<?php echo $rs['title'];?>" width="150" height="113" /></a>
                        </div>
                        <?php }?>
                        <div class="ui-media-body">
                            <div class="ui-media-header ui-text-hide"><a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank" title="<?php echo $rs['title'];?>"><?php echo redkey($rs['title'],$keyword);?></a></div>
                            <div class="ui-media-text"><?php echo redkey(nohtml($rs['intro']),$keyword);?></div>
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
                    <?php } if($total_rs>0){  }?>
                </ul>
                <?php if ($pg->totalpage>1) { ?>
                <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul><?php echo $showpage;?></ul></div>
                <?php }?>
            </div>
        </div>
        <div class="container-right">
            <?php include $this->tp->parse_include_twos("include/right.php");?>
        </div>
    </div>
	<?php include $this->tp->parse_include_twos("include/foot.php");?>
</body>
</html>