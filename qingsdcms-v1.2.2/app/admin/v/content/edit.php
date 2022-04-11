<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑内容</title>
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

<div class="position">当前位置：内容管理 > <a href="{U('lists')}">内容列表</a> > <a href="{THIS_LOCAL}">编辑内容</a></div>
<div class="borders">
    <!---->
    <form class="ui-form" method="post">
    <div class="ui-tabs ui-tabs-white">
        <ul class="ui-tabs-nav">
            <li class="active"><a href="javascript:;">基本设置</a></li>
            <li><a href="javascript:;">Seo设置</a></li>
            <li><a href="javascript:;">可选设置</a></li>
            {if count($field)>0}<li><a href="javascript:;">自定义设置</a></li>{/if}
        </ul>
        <div class="ui-tabs-content">
            <div class="ui-tabs-pane active">
                <!--1111-->
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">标题：</label>
                    <div class="col-right">
                        <input type="text" name="title" class="ui-form-ip" data-rule="标题:required;" value="{$title}">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">栏目：</label>
                    <div class="col-right">
                        <select name="classid" data-rule="栏目:required;" class="ui-form-ip">
                            <option value="" data-group="0">请选择栏目</option>
                            {foreach $classdata as $rs}
                            <option value="{$rs['cateid']}" data-group="{$rs['isgroup']}"{if $classid==$rs['cateid']} selected{/if}{if $rs['child']>0 || $rs['cate_type']<0} disabled{/if}>{str_repeat("　",$rs['depth'])}{$rs['cate_name']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
				<div class="ui-form-group ui-row group_pic {if $isgroup==0 || cms[state_content]==0} ui-hide{/if}">
					<label class="col-left ui-col-form-label">组图：</label>
					<div class="col-right col-right-full">
						<!---->
						<div class="ui-btn-group ui-mt-sm">
							<a class="ui-btn-group-item fm-choose ui-icon-cloud-upload" data-name="piclist" data-url="{U('upload/imageupload','type=3&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="0" data-multiple="1" title="上传">上传</a>
							<a class="ui-btn-group-item fm-choose ui-icon-select" data-name="piclist" data-url="{U('upload/imagelist','type=1&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="0" data-multiple="1" title="选择">选择</a>
						</div>
						<div class="imagelist">
							<ul id="list_piclist">
								{php $picdata=jsdecode($piclist)}
								{if is_array($picdata)}
									{foreach $picdata as $num=>$val}
									<li num="{$num}">
										<div class="preview">
											<input type="hidden" name="piclist[{$num}][image]" value="{$val['image']}">
											<u href="{$val['image']}" class="ui-lightbox"><img src="{$val['image']}" /></u>
                                            <a href="javascript:;" class="fm-choose" data-name="preview" data-url="{U('upload/imageupload','type=1&multiple=0')}" data-type="0" data-multiple="0" title="选择"><i class="ui-icon-image ui-mr-sm"></i>换图</a>
										</div>
										<div class="intro">
											<textarea name="piclist[{$num}][desc]" class="ui-form-ip" placeholder="图片描述...">{deal_strip($val['desc'])}</textarea>
										</div>
										<div class="action"><a href="javascript:;" class="img-left"><i class="ui-icon-left"></i>左移</a><a href="javascript:;" class="img-right"><i class="ui-icon-right"></i>右移</a><a href="javascript:;" class="img-del"><i class="ui-icon-delete"></i>删除</a></div>
									</li>
									{/foreach}
								{/if}
							</ul>
						</div>
						<!---->
						<span class="input-tips">尺寸建议：500*500</span>
					</div>
				</div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">内容：</label>
                    <div class="col-right col-right-full" id="catename">
                        <script id="content" name="content" type="text/plain" style="height:300px;">{$content}</script>
                        <script>UE.getEditor("content",{serverUrl:"{U('upload/index')}"});</script>
                        <input type="button" class="ui-btn ui-btn-info editor_savepic ui-mt ui-mr-sm" data-url="{U('upload/outimage')}" data-token="{$token}" data-name="content" value="保存编辑器中外部图片">
                        <label class="ui-checkbox"><input type="checkbox" name="savepic" id="savepic" value="1"><i></i>提取正文中第<span class="ui-text-red">1</span>张图片为缩略图</label>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label-top">摘要：</label>
                    <div class="col-right">
                        <textarea name="intro" rows="4" class="ui-form-ip ui-form-limit" data-max="255">{$intro}</textarea>
                        <div class="ui-form-limit-text"><span>{mb_strlen($intro)}</span>/255</div>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">缩略图：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="pic" id="pic" class="ui-form-ip radius-right-none" value="{$pic}">
                            <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="pic" data-url="{U('upload/imageupload','type=1&multiple=0&islocal=1')}" data-type="1" data-multiple="0" title="上传">上传</a>
                            <a class="after fm-choose ui-icon-select radius-none" data-name="pic" data-url="{U('upload/imagelist','type=1&multiple=0&islocal=1')}" data-type="1" data-multiple="0" title="选择">选择</a>
                            <a class="after ui-lightbox ui-icon-zoomin" data-hide="true" data-id="pic" data-name="ui-lightbox-pic" title="缩略图">预览</a>
                        </div>
                        <span class="input-tips"></span>
                     </div>
                </div>
                {if cms[state_tags]==1}
				<div class="ui-form-group ui-row">
					<label class="col-left ui-col-form-label">标签：</label>
					<div class="col-right">
						<div class="ui-input-group">
							<input type="text" name="tags" id="tags" class="ui-form-ip radius-right-none" maxlength="50" value="{$tags}">
							<a class="after ui-icon-select fm-tags" data-name="tags" data-url="{U('taglist')}" title="选择">选择</a>
						</div>
						<div class="input-tips">多个标签请使用,分隔</div>
					</div>
				</div>
                {/if}
				<div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">排序：</label>
                    <div class="col-right">
                        <input type="text" name="ordnum" maxlength="8" class="ui-form-ip" value="{$ordnum}">
						<span class="input-tips">数字越大，越靠前</span>
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">状态：</label>
                    <div class="col-right col-right-top">
                        <label class="ui-radio"><input type="radio" name="isshow" value="1" {if $isshow==1} checked{/if}><i></i>启用</label>

                        <label class="ui-radio"><input type="radio" name="isshow" value="0" {if $isshow==0} checked{/if}><i></i>锁定</label>
                    </div>
                </div>
                <!--1111-->
            </div>
            
            <div class="ui-tabs-pane">
                <!--2222-->
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">优化标题：</label>
                    <div class="col-right">
                        <input type="text" name="show_title" class="ui-form-ip" value="{$show_title}">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">关键字：</label>
                    <div class="col-right">
                        <input type="text" name="show_key" class="ui-form-ip" value="{$show_key}">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label-top">描述：</label>
                    <div class="col-right">
                        <textarea name="show_desc" rows="4" class="ui-form-ip ui-form-limit" data-max="255">{$show_desc}</textarea>
                        <div class="ui-form-limit-text"><span>{mb_strlen($show_desc)}</span>/255</div>
                    </div>
                </div>
				<div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">网址别名：</label>
                    <div class="col-right">
                        <input type="text" name="alias" maxlength="30" class="ui-form-ip" value="{$alias}">
                    </div>
                </div>
                <!--2222-->
            </div>
            
            <div class="ui-tabs-pane">
                <!--3333-->
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">外链：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="url" id="url" class="ui-form-ip radius-right-none" value="{$url}">
                            <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="url" data-url="{U('upload/imageupload','type=3&multiple=0&iseditor=1')}" data-type="1" data-multiple="0" title="上传">上传</a>
                            <a class="after fm-choose ui-icon-select" data-name="url" data-url="{U('upload/imagelist','type=3&multiple=0')}" data-type="1" data-multiple="0" title="选择">选择</a>
                        </div>
                        <span class="input-tips">添加外链时，将不显示正文内容</span>
                     </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">人气：</label>
                    <div class="col-right">
                        <input type="text" name="hits" class="ui-form-ip" value="{$hits}">
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">是否推荐：</label>
                    <div class="col-right col-right-top">
                        <label class="ui-radio"><input type="radio" name="isnice" value="1" {if $isnice==1} checked{/if}><i></i>是</label>
                        <label class="ui-radio"><input type="radio" name="isnice" value="0" {if $isnice==0} checked{/if}><i></i>否</label>
                    </div>
                </div>
				<div class="ui-form-group ui-row">
					<label class="col-left ui-col-form-label">定时发布：</label>
					<div class="col-right col-right-top">
						<label class="ui-radio"><input type="radio" name="isauto" value="0"{if $isauto==0} checked{/if}><i></i>否</label>
						<label class="ui-radio"><input type="radio" name="isauto" value="1"{if $isauto==1} checked{/if}><i></i>是</label>                                                        							
					</div>
				</div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">发布日期：</label>
                    <div class="col-right">
                        <input type="text" name="createdate" class="ui-form-ip datepick-time" value="{date('Y-m-d H:i:s',$createdate)}" >
                    </div>
                </div>
                <div class="ui-form-group ui-row">
                    <label class="col-left ui-col-form-label">内容模板：</label>
                    <div class="col-right">
                        <div class="ui-input-group">
                            <input type="text" name="show_theme" id="show_theme" class="ui-form-ip radius-right-none" value="{$show_theme}">
                            <a class="after template ui-icon-select" data-name="show_theme" data-url="{U('theme/template')}" title="选择">选择</a>
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
	{if cms[state_content]==1}
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
	{/if}
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
	{foreach $draglist as $key=>$val}
	Sortable.create($("#list_{$val}")[0],{animation:400});
	{/foreach}
	$(".ui-form").form(
	{
		type:2,
		result:function(form)
		{
			UE.getEditor('content').sync();
			$("#content").val(UE.getEditor('content').getContent());
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
                       setTimeout(function(){location.href='{U("lists","classid=".$classid."")}';},1500);
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