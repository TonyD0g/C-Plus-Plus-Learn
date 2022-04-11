<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>内容管理</title>
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
    <div class="position">当前位置：<a href="{U('lists')}">内容管理</a>{$position}</div>
    <div class="border">
        <!---->
        <form class="ui-form" method="post">
			{if cms[state_page]==1}
            <div class="ui-form-group ui-row">
                <label class="col-left ui-col-form-label ui-col-form-label text-right">组图：</label>
                <div class="col-right col-right-full">
                	<!---->
                    <div class="ui-btn-group ui-mt-sm">
                    <a class="ui-btn-group-item fm-choose ui-icon-cloud-upload" data-name="t1" data-url="{U('upload/imageupload','type=3&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="0" data-multiple="1" title="上传">上传</a>
                    <a class="ui-btn-group-item fm-choose ui-icon-select" data-name="t1" data-url="{U('upload/imagelist','type=1&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="0" data-multiple="1" title="选择">选择</a>
                    </div>
                    <div class="imagelist">
                    <ul id="list_t1">
                        {php $picdata=jsdecode($piclist,1)}
                        {if is_array($picdata)}
                            {foreach $picdata as $num=>$val}
                            <li num="{$num}">
                                <div class="preview">
                                    <input type="hidden" name="t1[{$num}][image]" value="{$val['image']}">
                                    <u href="{$val['image']}" class="ui-lightbox" data-title="{deal_strip($val['desc'])}"><img src="{$val['image']}" /></u>
                                    <a href="javascript:;" class="fm-choose" data-name="preview" data-url="{U('upload/imageupload','type=1&multiple=0')}" data-type="0" data-multiple="0" title="选择"><i class="ui-icon-image ui-mr-sm"></i>换图</a>
                                </div>
                                <div class="intro">
                                    <textarea name="t1[{$num}][desc]" class="ui-form-ip" placeholder="图片描述...">{deal_strip($val['desc'])}</textarea>
                                </div>
                                <div class="action"><a href="javascript:;" class="img-left"><i class="ui-icon-left"></i>左移</a><a href="javascript:;" class="img-right"><i class="ui-icon-right"></i>右移</a><a href="javascript:;" class="img-del"><i class="ui-icon-delete"></i>删除</a></div>
                            </li>
                            {/foreach}
                        {/if}
                    </ul>
                    </div>
                    <!---->
                </div>
            </div>
			{/if}
            <div class="ui-form-group ui-row">
                <label class="col-left ui-col-form-label ui-col-form-label text-right">内容：</label>
                <div class="col-right-full">
                    <script id="t0" name="t0" type="text/plain" style="height:260px;">{$content}</script>
                    <script>UE.getEditor('t0',{serverUrl:"{U('upload/index')}"});</script>
					<input type="button" class="ui-btn ui-btn-info editor_savepic ui-mt" data-url="{U('upload/outimage')}" data-token="{$token}" data-name="t0" value="保存编辑器中外部图片">
                </div>
            </div>
			
			<div class="ui-form-group ui-row">
                <label class="col-left ui-col-form-label"></label>
                <div class="col-right">
                	<input type="hidden" name="token" value="{$token}">
                    <button type="submit" class="ui-btn ui-btn-info ui-mr-sm">保存</button>
                    {if $isdel==1}
                    <button type="button" class="ui-btn isdel" data-url="{U('delpage','classid='.$classid.'')}">删除内容</button>
                    {else}
                    <button type="button" class="ui-btn ui-back">返回</button>
                    {/if}
                </div>
            </div>

        </form>
        <!---->
    </div>

<script>
$(function()
{
	{if cms[state_page]==1}Sortable.create($("#list_t1")[0],{animation:400});{/if}
	$(".ui-form").form(
	{
		type:2,
		result:function(form)
		{
			UE.getEditor('t0').sync();
			$("#t0").val(UE.getEditor('t0').getContent());
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
                        setTimeout(function(){location.href='{THIS_LOCAL}';},1500);
                    }
                    else
                    {
                        sdcms.error(d.msg);
                    }
                }
            });
		}
	});
	$(".isdel").click(function()
	{
		var url=$(this).data("url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除？不可恢复！",
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				$.ajax(
				{
                    url:url,
					type:'post',
					dataType:'json',
					data:'token={$token}',
					error:function(e){alert(e.responseText);},
                    success:function(d)
                    {
                        e.close();
                        if(d.state=='success')
                        {
                            sdcms.success(d.msg);
                            setTimeout(function(){location.href='{THIS_LOCAL}';},1000);
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
});
</script>
</body>
</html>