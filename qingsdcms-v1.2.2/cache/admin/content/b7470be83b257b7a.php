<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>添加内容</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script>var ue_url="<?php echo U('upload/imagelist','type=0&multiple=1&iseditor=1');?>",web_root="<?php echo WEB_ROOT;?>";</script>
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/sortable.min.js"></script>
<script src="<?php echo WEB_ROOT;?>public/admin/js/base.js"></script>
<script src="<?php echo WEB_ROOT;?>public/ueditor/ueditor.config.js"></script>
<script src="<?php echo WEB_ROOT;?>public/ueditor/ueditor.all.min.js"></script>
</head>
<body>
<div class="position">当前位置：内容管理 > <a href="<?php echo U('lists');?>">内容列表</a> > <a href="<?php echo THIS_LOCAL;?>">添加内容</a></div>
<div class="borders">
    <form class="ui-form" method="post">
    <div class="ui-tabs ui-tabs-white">
        <ul class="ui-tabs-nav">
            <li class="active"><a href="javascript:;">基本设置</a></li>
            <li><a href="javascript:;">Seo设置</a></li>
            <li><a href="javascript:;">可选设置</a></li>
            <?php if (count($field)>0) { ?><li><a href="javascript:;">自定义设置</a></li><?php }?>
        </ul>
        <div class="ui-tabs-content">
            <div class="ui-tabs-pane active">
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">标题：</label>
                    <div class="col-right">
                        <input type="text" name="title" class="ui-form-ip" data-rule="标题:required;">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">栏目：</label>
                    <div class="col-right">
                        <select name="classid" data-rule="栏目:required;" class="ui-form-ip">
                            <option value="" data-group="0">请选择栏目</option>
                            <?php foreach($classdata as $rs) { ?>
                            <option value="<?php echo $rs['cateid'];?>" data-group="<?php echo $rs['isgroup'];?>" <?php if ($classid==$rs['cateid']) { ?> selected<?php } if ($rs['child']>0 || $rs['cate_type']<0) { ?> disabled<?php }?>><?php echo str_repeat("　",$rs['depth']); echo $rs['cate_name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
				<div class="ui-form-group ui-row group_pic<?php if ($isgroup==0) { ?> ui-hide<?php }?>">
					<label class="col-left ui-col-form-label">组图：</label>
					<div class="col-right col-right-full">
						<div class="ui-btn-group ui-mt-sm">
							<a class="ui-btn-group-item fm-choose ui-icon-cloud-upload" data-name="piclist" data-url="<?php echo U('upload/imageupload','type=3&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'');?>" data-type="0" data-multiple="1" title="上传">上传</a>
							<a class="ui-btn-group-item fm-choose ui-icon-select" data-name="piclist" data-url="<?php echo U('upload/imagelist','type=1&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'');?>" data-type="0" data-multiple="1" title="选择">选择</a>
						</div>
						<div class="imagelist">
							<ul id="list_piclist"></ul>
						</div>
						<span class="input-tips">尺寸建议：500*500</span>
					</div>
				</div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">内容：</label>
                    <div class="col-right col-right-full" id="catename">
                        <script id="content" name="content" type="text/plain" style="height:300px;"></script>
                        <script>UE.getEditor("content",{serverUrl:"<?php echo U('upload/index');?>"});</script>
                        <input type="button" class="ui-btn ui-btn-info editor_savepic ui-mt ui-mr-sm" data-url="<?php echo U('upload/outimage');?>" data-token="<?php echo $token;?>" data-name="content" value="保存编辑器中外部图片">
                        <label class="ui-checkbox"><input type="checkbox" name="savepic" id="savepic" value="1"><i></i>提取正文中第<span class="ui-text-red">1</span>张图片为缩略图</label>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label-top">摘要：</label>
                    <div class="col-right">
                        <textarea name="intro" rows="4" class="ui-form-ip ui-form-limit" data-max="255"></textarea>
                        <div class="ui-form-limit-text"><span>0</span>/255</div>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">缩略图：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="pic" id="pic" class="ui-form-ip radius-right-none">
                            <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="pic" data-url="<?php echo U('upload/imageupload','type=1&multiple=0&islocal=1');?>" data-type="1" data-multiple="0" title="上传">上传</a>
                            <a class="after fm-choose ui-icon-select radius-none" data-name="pic" data-url="<?php echo U('upload/imagelist','type=1&multiple=0&islocal=1');?>" data-type="1" data-multiple="0" title="选择">选择</a>
                            <a class="after ui-lightbox ui-icon-zoomin" data-hide="true" data-id="pic" data-name="ui-lightbox-pic" title="缩略图">预览</a>
                        </div>
                        <span class="input-tips"></span>
                     </div>
                </div>
                <?php if (C(strtoupper('state_tags'))==1) { ?>
                <div class="ui-form-group ui-row">
					<label class="col-left ui-col-form-label">标签：</label>
					<div class="col-right">
						<div class="ui-input-group">
							<input type="text" name="tags" id="tags" class="ui-form-ip radius-right-none" maxlength="50">
							<a class="after ui-icon-select fm-tags" data-name="tags" data-url="<?php echo U('taglist');?>" title="选择">选择</a>
						</div>
						<div class="input-tips">多个标签请使用,分隔</div>
					</div>
				</div>
                <?php }?>
				<div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">排序：</label>
                    <div class="col-right">
                        <input type="text" name="ordnum" maxlength="8" class="ui-form-ip">
						<span class="input-tips">数字越大，越靠前</span>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">状态：</label>
                    <div class="col-right col-right-top">
                        <label class="ui-radio"><input type="radio" name="isshow" value="1" checked><i></i>启用</label>
                        <label class="ui-radio"><input type="radio" name="isshow" value="0"><i></i>锁定</label>
                    </div>
                </div>
            </div>
            <div class="ui-tabs-pane">
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">优化标题：</label>
                    <div class="col-right">
                        <input type="text" name="show_title" class="ui-form-ip">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">关键字：</label>
                    <div class="col-right">
                        <input type="text" name="show_key" class="ui-form-ip">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label-top">描述：</label>
                    <div class="col-right">
                        <textarea name="show_desc" rows="4" class="ui-form-ip ui-form-limit" data-max="255"></textarea>
                        <div class="ui-form-limit-text"><span>0</span>/255</div>
                    </div>
                </div>
				<div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">网址别名：</label>
                    <div class="col-right">
                        <input type="text" name="alias" maxlength="20" class="ui-form-ip">
                    </div>
                </div>
            </div>
            <div class="ui-tabs-pane">
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">外链：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="url" id="url" class="ui-form-ip radius-right-none">
                            <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="url" data-url="<?php echo U('upload/imageupload','type=3&multiple=0&iseditor=1');?>" data-type="1" data-multiple="0" title="上传">上传</a>
                            <a class="after fm-choose ui-icon-select" data-name="url" data-url="<?php echo U('upload/imagelist','type=3&multiple=0&iseditor=1');?>" data-type="1" data-multiple="0" title="选择">选择</a>
                        </div>
                        <span class="input-tips">添加外链时，将不显示正文内容</span>
                     </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">人气：</label>
                    <div class="col-right">
                        <input type="text" name="hits" class="ui-form-ip" value="0">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">是否推荐：</label>
                    <div class="col-right col-right-top">
                        <label class="ui-radio"><input type="radio" name="isnice" value="1"><i></i>是</label>
                        <label class="ui-radio"><input type="radio" name="isnice" value="0" checked><i></i>否</label>
                    </div>
                </div>
				<div class="ui-form-group ui-row">
					<label class="col-left ui-col-form-label">定时发布：</label>
					<div class="col-right col-right-top">
						<label class="ui-radio"><input type="radio" name="isauto" value="0" checked><i></i>否</label>
						<label class="ui-radio"><input type="radio" name="isauto" value="1"><i></i>是</label>                                                        							
					</div>
				</div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">发布日期：</label>
                    <div class="col-right">
                        <input type="text" name="createdate" class="ui-form-ip datepick-time" value="<?php echo date('Y-m-d H:i:s');?>" >
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">内容模板：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="show_theme" id="show_theme" class="ui-form-ip radius-right-none">
                            <a class="after template ui-icon-select" data-name="show_theme" data-url="<?php echo U('theme/template');?>" title="选择">选择</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (count($field)>0) { ?>
            <div class="ui-tabs-pane">
                <?php include $this->tp->parse_include_twos("extend/field/file/add.php");?>
            </div>
            <?php }?>
        </div>
   </div>
    <div class="ui-form-group ui-mt">
    	<input type="hidden" name="token" value="<?php echo $token;?>">
        <button type="submit" class="ui-btn ui-btn-info ui-mr-sm">保存</button>
        <button type="button" class="ui-btn ui-back">返回</button>
    </div>
    </form>
</div>
<script src="<?php echo WEB_ROOT;?>public/datepick/laydate.js"></script>
<script>
$(function()
{
	<?php if (C(strtoupper('state_content'))==1) { ?>
	$("select[name=classid]").change(function()
	{
		var group=$(this).find("option:selected").attr("data-group");
		if(group==1)
		{
			$(".group_pic").removeClass("ui-hide");
		}
		else
		{
			$(".group_pic").addClass("ui-hide");
		}
	});
	Sortable.create($("#list_piclist")[0],{animation:400});
	<?php }?>
	lay('.datepick-time').each(function()
	{
		laydate.render(
		{
			elem:this,
			type:'datetime',
			trigger:'click'
		});
	});
	lay('.datepick').each(function()
	{
		laydate.render(
		{
			elem:this,
			trigger:'click'
		});
	});
	<?php foreach($draglist as $key=>$val) { ?>
	Sortable.create($("#list_<?php echo $val;?>")[0],{animation:400});
	<?php }?>
	$(".ui-form").form(
	{
		type:2,
		result:function(form)
		{
			UE.getEditor('content').sync();
			$("#content").val(UE.getEditor('content').getContent());
			<?php foreach($editor as $key=>$val) { ?>
			UE.getEditor('<?php echo $val;?>').sync();
			$("#<?php echo $val;?>").val(UE.getEditor('<?php echo $val;?>').getContent());
			<?php }?>
			$.ajax(
			{
                type:'post',
                cache:false,
                dataType:'json',
                url:'<?php echo THIS_LOCAL;?>',
                data:$(form).serialize(),
                error:function(e){alert(e.responseText);},
                success:function(d)
                {
                    if(d.state=='success')
                    {
                        sdcms.success(d.msg);
                       setTimeout(function(){location.href='<?php echo U("lists","classid=".$classid."");?>';},1500);
                    }
                    else
                    {
                        sdcms.error(d.msg);
                    }
                }
            });
		}
	});
})
</script>
</body>
</html>