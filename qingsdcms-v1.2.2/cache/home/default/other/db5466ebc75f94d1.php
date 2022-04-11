<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit; include $this->tp->parse_include_twos("include/head.php");?>
	<?php include $this->tp->parse_include_twos("include/bread.php");?>
    <div class="container width ui-mt-20">
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color ui-mb-20">
                    <div class="ui-menu-name"><?php echo $page_name;?></div>
                </div>
				<div class="ui-show-body">
                <?php $total_rs=$this->db->count("select count(1) from cms_tags  where hits>0 ");$pagesize=100;$totalpage=ceil($total_rs/$pagesize);if($page>$totalpage){
$page=1;}$offset=($page-1)*$pagesize;$way=0;if($offset>1000 && $total_rs>2000 && $offset>$total_rs/2){	$offset=$total_rs-$offset-$pagesize;	$way=1;}if($offset<0){	$pagesize+=$offset;	$offset=0;}$key_="id";$table_="cms_tags";$join_="";$where_="where hits>0";$group_="";$order_="order by id desc";$field_="*";$type_="0";$keylist=$this->db->getkeylist($key_,$table_,$join_,$where_,$order_,$offset,$pagesize,$way,$type_);$array_rs=$this->db->load("select $field_ from $table_ $join_ $keylist $group_ $order_");$pg=new cms_page($total_rs,$totalpage,$pagesize,$page);$showpage=$pg->showpage(5);if($total_rs==0){  } else{  $i=0;} foreach($array_rs as $rs){ $i++;?>
				<a href="<?php echo U('other/tags','id='.$rs['id'].'');?>" data-title="<?php echo $rs['title'];?>" data-align="top-left" target="_blank" class="ui-mb ui-mr ui-btn ui-tips"><?php echo $rs['title'];?></a>
				<?php } if($total_rs>0){  }?>
				<?php if ($pg->totalpage>1) { ?>
                <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul><?php echo $showpage;?></ul></div>
                <?php }?>
                </div>
            </div>
        </div>
        <div class="container-right">
            <?php include $this->tp->parse_include_twos("include/right.php");?>
        </div>
    </div>
	<?php include $this->tp->parse_include_twos("include/foot.php");?>
</body>
</html>