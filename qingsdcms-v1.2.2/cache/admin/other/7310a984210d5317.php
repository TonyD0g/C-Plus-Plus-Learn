<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>附件选择</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
<script src="<?php echo WEB_ROOT;?>public/admin/js/base.js"></script>
</head>
<body class="ui-p-10">
<div class="ui-tabs ui-tabs-white" data-href="1">
	<ul class="ui-tabs-nav">
	  <li class="active"><a href="<?php echo U('imagelist','type=3&multiple='.$multiple.'&gid=0&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">附件选择</a></li>
	  <li><a href="<?php echo U('imageupload','type=3&multiple='.$multiple.'&gid='.$gid.'&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">本地上传</a></li>
	</ul>
	<div class="ui-tabs-content">
		<div class="ui-tabs-pane active">
			<div class="ui-tabs" data-href="1" style="margin-top:-10px;">
				<div class="ui-tabs-header-nav">
					<ul class="ui-tabs-nav">
						<?php if ($iseditor==0) { ?>
						<li class="active"><a href="<?php echo THIS_LOCAL;?>">附件选择</a></li>
						<?php } else { ?>
						<li<?php if ($type==0) { ?> class="active"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type=0&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">全部文件</a></li>
						<li<?php if ($type==1) { ?> class="active"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type=1&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">图片文件</a></li>
						<li<?php if ($type==2) { ?> class="active"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type=2&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">视频文件</a></li>
						<li<?php if ($type==3) { ?> class="active"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type=3&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'');?>">其他文件</a></li>
						<?php }?>
					</ul>
                    <div class="ui-tabs-header-more">
                    	<form action="<?php echo THIS_LOCAL;?>">
                    	<div class="ui-form-group">
                            <div class="ui-input-group">
                            	<?php if (C(strtoupper('url_mode'))==1) { ?>
                                    <?php if (!isempty(C(strtoupper('pathinfo'))) && C(strtoupper('url_mode'))>1) { ?><input type="hidden" name="s" value="<?php echo PATH_URL;?>" /><?php }?>
                                    <?php if (C(strtoupper('url_mode'))==1) { ?>
                                        <input type="hidden" name="m" value="<?php echo MODULE_NAME;?>" />
                                        <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>" />
                                        <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>" />
                                        <input type="hidden" name="multiple" value="<?php echo $multiple;?>" />
                                        <input type="hidden" name="type" value="<?php echo $type;?>" />
                                        <input type="hidden" name="iseditor" value="<?php echo $iseditor;?>" />
                                        <input type="hidden" name="islocal" value="<?php echo $islocal;?>" />
                                        <input type="hidden" name="thumb" value="<?php echo $thumb;?>" />
                                        <input type="hidden" name="water" value="<?php echo $water;?>" />
                                        <input type="hidden" name="gid" value="<?php echo $gid;?>" />
                                    <?php }?>
                                <?php }?>
                                <input type="text" name="keyword" value="<?php echo $keyword;?>" class="ui-form-ip radius-right-none" placeholder="请输入关键字" style="min-width:200px;">
                                <button type="submit" class="after"><div class="ui-icon-search"></div></button>
                            </div>
                        </div>
                        </form>
                    </div>
				</div>
			</div>
			<div class="ui-row ui-mt-15 ui-mb">
				<div class="filelist-left">
					<ul>
						<li<?php if ($gid==-1) { ?> class="actice"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type='.$type.'&iseditor='.$iseditor.'&islocal='.$islocal.'&gid=-1&thumb='.$thumb.'&water='.$water.'');?>"><span><?php echo $total;?></span>未分组</a></li>
						<?php $array_rs=$this->db->load("select aid,gname,(select count(1) from cms_file where gid=a.aid $where_query) as num from cms_file_group a  where isshow=1  order by ordnum,aid ",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
						<li<?php if ($gid==$rs['aid']) { ?> class="actice"<?php }?>><a href="<?php echo U('imagelist','multiple='.$multiple.'&type='.$type.'&iseditor='.$iseditor.'&islocal='.$islocal.'&gid='.$rs['aid'].'&thumb='.$thumb.'&water='.$water.'');?>"><span><?php echo $rs['num'];?></span><?php echo $rs['gname'];?></a></li>
						<?php } if($total_rs>0){ ?>
<?php }?>
					</ul>
				</div>
				<div class="filelist-right">
					 <div class="ui-piclist ui-piclist-16-9 ui-piclist-col-right" id="list">
						<div id="list_pre"></div>
						<?php $total_rs=$this->db->count("select count(1) from cms_file  where $where ");$pagesize=20;$totalpage=ceil($total_rs/$pagesize);if($page>$totalpage){
$page=1;}$offset=($page-1)*$pagesize;$way=0;if($offset>1000 && $total_rs>2000 && $offset>$total_rs/2){	$offset=$total_rs-$offset-$pagesize;	$way=1;}if($offset<0){	$pagesize+=$offset;	$offset=0;}$key_="id";$table_="cms_file";$join_="";$where_="where $where";$group_="";$order_="order by $order";$field_="*";$type_="0";$keylist=$this->db->getkeylist($key_,$table_,$join_,$where_,$order_,$offset,$pagesize,$way,$type_);$array_rs=$this->db->load("select $field_ from $table_ $join_ $keylist $group_ $order_");$pg=new cms_page($total_rs,$totalpage,$pagesize,$page);$showpage=$pg->showpage(5);if($total_rs==0){ ?>
							<div class="ui-pt ui-pl ui-font-14 nothing">暂无文件</div>
						<?php } else{  $i=0;} foreach($array_rs as $rs){ $i++;?>
						<div class="ui-piclist-item" data-url="<?php echo $rs['file_url'];?>" title="<?php echo $rs['file_name'];?>">
							<div class="ui-piclist-image<?php if ($rs['file_type']>1) { ?> file-preview file-type-<?php echo trim($rs['file_ext'],"."); }?>">
							<?php if ($rs['file_type']==1) { ?>
								<a><img src="<?php echo $rs['file_url'];?>" /></a>
							<?php } else { ?>
								<a></a>
							<?php }?>
							</div>
							<div class="ui-piclist-body">
								<div class="ui-piclist-title ui-text-hide"><?php echo $rs['file_name'];?></div>
							</div>
						</div>
						<?php } if($total_rs>0){  }?>
					</div>
				</div>
			</div>
			<?php if ($total_rs!=0) { ?>
			<div class="ui-page ui-page-center ui-page-info ui-mt">
				<ul><?php echo $showpage;?></ul>
			</div>
			<?php }?>
			<input type="hidden" id="piclist">
		</div>
	</div>
</div>
<script>
$(function()
{
	$(document).on("click","#list .ui-piclist-item",function()
	{
		var val=$(this).data("url");
		<?php if ($multiple==0) { ?>
		$("#list .ui-piclist-item").each(function()
		{
			$(this).removeClass("hover");
		})
		<?php }?>
		$(this).toggleClass("hover");
		choose();
	});
});
function choose()
{
	var str='';
	$("#list .ui-piclist-item").each(function(){
		var val=$(this).data("url");
		if($(this).hasClass("hover"))
		{
			if(str!='')
			{
				str=str+'|';
			}
			str=str+val;
		}
	})
	$('#piclist').val(str);
}
</script>
</body>
</html>