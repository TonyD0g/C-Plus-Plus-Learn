<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑广告</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script>var ue_url="{U('upload/imagelist','type=0&multiple=1&iseditor=1')}",web_root="{WEB_ROOT}";</script>
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/js/sortable.min.js"></script>
<script src="{WEB_ROOT}public/admin/js/base.js"></script>
<script src="{WEB_ROOT}public/ueditor/ueditor.config.js"></script>
<script src="{WEB_ROOT}public/ueditor/ueditor.all.min.js"></script>
</head>

<body>

    <div class="position">当前位置：扩展管理 > <a href="{U('index')}">广告管理</a> > <a href="{U('lists','cid='.$cid.'')}">{$gname}</a> > <a href="{THIS_LOCAL}">编辑广告</a></div>
    <div class="borders">
        <!---->
        <form class="ui-form" method="post">
        <div class="ui-tabs ui-tabs-white">
            <ul class="ui-tabs-nav">
              <li class="active"><a href="{THIS_LOCAL}">编辑广告</a></li>
              {if count($field)>0}<li><a href="javascript:;">自定义设置</a></li>{/if}
            </ul>
            <div class="ui-tabs-content">
                <div class="ui-tabs-pane active">
                <!--loop-->
                
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">广告名称：</label>
                        <div class="col-right">
                            <input type="text" name="t0" class="ui-form-ip" value="{$name}" placeholder="请输入广告名称" data-rule="广告名称:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">图片：</label>
                        <div class="col-right">
                            <div class="ui-input-group">
                                <input type="text" name="t1" id="t1" value="{$pic}" class="ui-form-ip radius-right-none" data-rule="图片:required;">
                                <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="t1" data-url="{U('upload/imageupload','type=1&multiple=0')}" data-type="1" data-multiple="0" title="上传">上传</a>
                                <a class="after fm-choose ui-icon-select radius-none" data-name="t1" data-url="{U('upload/imagelist','type=1&multiple=0')}" data-type="1" data-multiple="0" title="选择">选择</a>
                                <a class="after ui-lightbox ui-icon-zoomin" data-hide="true" data-id="t1" data-name="ui-lightbox-pic" title="图片">预览</a>
                            </div>
                            <span class="input-tips"></span>
                         </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">链接：</label>
                        <div class="col-right">
                            <input type="text" name="t2" value="{$url}" class="ui-form-ip" placeholder="请输入链接" data-rule="链接:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">排序：</label>
                        <div class="col-right">
                            <input type="text" name="t3" class="ui-form-ip" value="{$ordnum}">
                            <span class="input-tips">数字越小越靠前</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">状态：</label>
                        <div class="col-right col-right-top">
                            <label class="ui-radio"><input type="radio" name="t4" value="1" {if $isshow==1} checked{/if}><i></i>启用</label>
                            <label class="ui-radio"><input type="radio" name="t4" value="0" {if $isshow==0} checked{/if}><i></i>锁定</label>
                        </div>
                    </div>
                    
                <!--loop-->
                </div>
                
                {if count($field)>0}
                <div class="ui-tabs-pane">
                    <!--222-->
                    {include file="extend/field/file/edit.php"}
                    <!--222-->
                </div>
                {/if}
                <div class="ui-form-group ui-row ui-mt ui-bg-white">
                    <label class="col-left ui-col-form-label"></label>
                    <div class="col-right col-right-top">
                    	<input type="hidden" name="token" value="{$token}">
                        <button type="submit" class="ui-btn ui-btn-info ui-mr-sm">保存</button>
                        <button type="button" class="ui-btn ui-back">返回</button>
                    </div>
                </div>
            </div>
        </div>
        
        </form>
        <!---->
    </div>
<script src="{WEB_ROOT}public/datepick/laydate.js"></script>  
<script>
$(function()
{
	lay('.datepick').each(function()
	{
		laydate.render(
		{
			elem:this,
			trigger:'click'
		});
	});
	{foreach $draglist as $key=>$val}
	Sortable.create($("#list_{$val}")[0],{animation:400});
	{/foreach}
	$(".ui-form").form(
	{
		type:2,
		result:function(form)
		{
			{foreach $editor as $key=>$val}
			UE.getEditor('{$val}').sync();
			$("#{$val}").val(UE.getEditor('{$val}').getContent());
			{/foreach}
			$.ajax(
			{
                type:'post',
                cache:false,
                dataType:'json',
                url:'{THIS_LOCAL}',
                data:$(form).serialize(),
                error:function(e){alert(e.responseText);},
                success:function(d)
                {
                    if(d.state=='success')
                    {
                        sdcms.success(d.msg);
                        setTimeout(function(){location.href='{U("lists","cid=".$cid."")}';},1500);
                    }
                    else
                    {
                        sdcms.error(d.msg);
                    }
                }
            });
		}
	});
});
</script>
</body>
</html>