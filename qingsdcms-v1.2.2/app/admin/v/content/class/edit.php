<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑栏目</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script>var ue_url="{U('upload/imagelist','type=0&multiple=1&iseditor=1')}",web_root="{WEB_ROOT}";</script>
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/js/sortable.min.js"></script>
<script src="{WEB_ROOT}public/admin/js/base.js"></script>
<script src="{WEB_ROOT}public/ueditor/ueditor.config.js"></script>
<script src="{WEB_ROOT}public/ueditor/ueditor.all.min.js"></script>
<script>
$(function()
{
	$("#t1").change(function()
	{
		switch ($(this).val())
		{
			case "-1":
				$("#skins,#seo").removeClass("dis");
				$("#listskin,#pagenum").addClass("dis");
				$("#cateurl").html("别名：");
				$("#alias .input-tips").html("可以为空，只能为英文字母，不支持汉字及特殊字符");
				break;
			case "-2":
				$("#skins,#seo,#pagenum").addClass("dis");
				$("#cateurl").html("链接网址：");
				$("#alias .input-tips").html("")
				break;
			default:
				$("#skins,#seo,#pagenum,#listskin").removeClass("dis");
				$("#cateurl").html("别名：");
				$("#alias .input-tips").html("可以为空，只能为英文字母，不支持汉字及特殊字符");
			break;
		}
	});
	{if $cate_type==-1}
		$("#skins,#seo").removeClass("dis");
		$("#listskin,#pagenum").addClass("dis");
		$("#cateurl").html("别名：");
		$("#alias .input-tips").html("可以为空，只能为英文字母，不支持汉字及特殊字符");
	{elseif $cate_type==-2}
		$("#skins,#seo,#pagenum").addClass("dis");
		$("#cateurl").html("链接网址：");
		$("#alias .input-tips").html("");
	{else}
		$("#skins,#seo,#pagenum,#listskin").removeClass("dis");
		$("#cateurl").html("别名：");
		$("#alias .input-tips").html("可以为空，只能为英文字母，不支持汉字及特殊字符");
	{/if}
})
</script>
</head>

<body>
    <div class="position">当前位置：内容管理 > <a href="{U('index')}">栏目管理</a>{$position} > <a href="{THIS_LOCAL}">编辑栏目</a></div>
    <div class="borders">
    	<!---->
        <form class="ui-form" method="post">
        <div class="ui-tabs ui-tabs-white">
            <ul class="ui-tabs-nav">
                <li class="active"><a href="javascript:;">基本设置</a></li>
                <li id="seo"><a href="javascript:;">Seo设置</a></li>
                <li id="skins"><a href="javascript:;">模板设置</a></li>
                {if count($field)>0}<li><a href="javascript:;">自定义设置</a></li>{/if}
            </ul>
            <div class="ui-tabs-content">
                <div class="ui-tabs-pane active">
                    <!--1111-->
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">栏目名称：</label>
                        <div class="col-right" id="catename">
                            <input type="text" name="t0" class="ui-form-ip" value="{$cate_name}" data-rule="栏目名称:required;">
                        </div>
                    </div>
					{if cms[state_class_en]==1}
					<div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">栏目英文名称：</label>
                        <div class="col-right">
                            <input type="text" name="t13" value="{$cate_en}" class="ui-form-ip" >
                        </div>
                    </div>
					{/if}
					{if cms[state_class_pic]==1}
					<div class="ui-form-group ui-row">
						<label class="col-left ui-col-form-label">栏目图片：</label>
						<div class="col-right">
							<div class="ui-input-group">
								<input type="text" name="t14" id="t14" value="{$cate_pic}" class="ui-form-ip radius-right-none">
								<a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="t14" data-url="{U('upload/imageupload','type=1&multiple=0')}" data-type="1" data-multiple="0" title="上传">上传</a>
								<a class="after fm-choose ui-icon-select radius-none" data-name="t14" data-url="{U('upload/imagelist','type=1&multiple=0')}" data-type="1" data-multiple="0" title="选择">选择</a>
								<a class="after ui-lightbox ui-icon-zoomin" data-hide="true" data-id="t14" data-name="ui-lightbox-pic" title="栏目图片">预览</a>
							</div>
							<span class="input-tips"></span>
						 </div>
					</div>
					{/if}
					<div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">栏目类型：</label>
                        <div class="col-right">
                            <select class="ui-form-ip"{if $total<=0} name="t1"{/if} id="t1" data-rule="栏目类型:required;"{if $total!=0} disabled{/if}>
                                <option value="">请选择栏目类型</option>
                                <option value="-1"{if $cate_type==-1} selected{/if}>单页</option>
                                <option value="-2"{if $cate_type==-2} selected{/if}>链接</option>
                                <option value="0"{if $cate_type==0} selected{/if}>内容</option>
                            </select>
                            {if $total!=0}<input type="hidden" name="t1" value="{$cate_type}">{/if}
                            <span class="input-tips">{if $total!=0}请先移动栏目下内容再修改{/if}</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row" id="alias">
                        <label class="col-left ui-col-form-label" id="cateurl">别名：</label>
                        <div class="col-right">
                            <input type="text" name="t2" class="ui-form-ip" value="{$cate_url}">
                            <span class="input-tips">可以为空，只能为英文字母，不支持汉字及特殊字符</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row" id="pagenum">
                        <label class="col-left ui-col-form-label">分页数量：</label>
                        <div class="col-right">
                            <input type="text" name="t3" class="ui-form-ip" value="{$cate_page}">
                            <span class="input-tips">每页显示的数量</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">排序：</label>
                        <div class="col-right">
                            <input type="text" name="t4" class="ui-form-ip" value="{$cate_order}">
                            <span class="input-tips">数字越小越靠前</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">属性：</label>
                        <div class="col-right col-right-top">
							<label class="ui-checkbox"><input type="checkbox" name="t10" value="1"{if $ismenu==1} checked{/if}><i></i>导航显示</label>
                            <label class="ui-checkbox"><input type="checkbox" name="t11" value="1"{if $isnew==1} checked{/if}><i></i>新窗口打开</label>
							{if cms[state_content]==1}<label class="ui-checkbox"><input type="checkbox" name="t12" value="1"{if $isgroup==1} checked{/if}><i></i>内容组图功能</label>{/if}
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">应用到子栏目：</label>
                        <div class="col-right col-right-top">
                            <label class="ui-checkbox"><input type="checkbox" name="apply[]" value="1"><i></i>模板设置</label>
                            <label class="ui-checkbox"><input type="checkbox" name="apply[]" value="2"><i></i>分页数量</label>
							<label class="ui-checkbox"><input type="checkbox" name="apply[]" value="3"><i></i>导航显示</label>
							<label class="ui-checkbox"><input type="checkbox" name="apply[]" value="4"><i></i>新窗口打开</label>
							{if cms[state_content]==1}<label class="ui-checkbox"><input type="checkbox" name="apply[]" value="5"><i></i>内容组图功能</label>{/if}
                        </div>
                    </div>
                    <!--1111-->
                </div>
                
                <div class="ui-tabs-pane">
                    <!--2222-->
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">优化标题：</label>
                        <div class="col-right">
                            <input type="text" name="t5" class="ui-form-ip" value="{$cate_title}">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">关键字：</label>
                        <div class="col-right">
                            <input type="text" name="t6" class="ui-form-ip" value="{$cate_key}">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label-top">描述：</label>
                        <div class="col-right">
                            <textarea name="t7" rows="4" class="ui-form-ip ui-form-limit" data-max="255">{$cate_desc}</textarea>
                            <div class="ui-form-limit-text"><span>{mb_strlen($cate_desc)}</span>/255</div>
                        </div>
                    </div>
                    <!--2222-->
                </div>
                
                <div class="ui-tabs-pane">
                    <!--3333-->
                    <div class="ui-form-group ui-row" id="listskin">
                        <label class="col-left ui-col-form-label">列表模板：</label>
                        <div class="col-right">
                        	<div class="ui-input-group">
                            	<input type="text" name="t8" id="t8" class="ui-form-ip radius-right-none" value="{$cate_list}">
                                <a class="after template ui-icon-select" data-name="t8" data-url="{U('theme/template')}" title="选择">选择</a>
                            </div>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">内容模板：</label>
                        <div class="col-right">
                        	<div class="ui-input-group">
                            	<input type="text" name="t9" id="t9" class="ui-form-ip radius-right-none" value="{$cate_show}">
                                <a class="after template ui-icon-select" data-name="t9" data-url="{U('theme/template')}" title="选择">选择</a>
                            </div>
                        </div>
                    </div>
                    <!--3333-->
                </div>
                
                {if count($field)>0}
                <div class="ui-tabs-pane">
                    <!--4444-->
                    {include file="extend/field/file/edit.php"}
                    <!--4444-->
                </div>
                {/if}

            </div>
        </div>
        
        <div class="ui-form-group ui-mt">
        	<input type="hidden" name="token" value="{$token}">
            <button type="submit" class="ui-btn ui-btn-info ui-mr-sm">保存</button>
            <button type="button" class="ui-btn ui-back">返回</button>
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
                         setTimeout(function(){location.href='{U("index","fid=".$fid."")}';},1500);
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