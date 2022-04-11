<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>添加菜单</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body class="bg_white">
    <div class="border_iframe">
        <!---->
        <form class="ui-form" method="post">
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">菜单名称：</label>
                <div class="ui-col-9">
                    <input type="text" name="t0" class="ui-form-ip" placeholder="请输入菜单名称" data-rule="菜单名称:required;">
                </div>
            </div>
            {if $fid!=0}
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">控制器名称：</label>
                <div class="ui-col-9">
                    <input type="text" name="t1" class="ui-form-ip" placeholder="请输入控制器名称" data-rule="控制器名称:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">动作名称：</label>
                <div class="ui-col-9">
                    <input type="text" name="t2" class="ui-form-ip" placeholder="请输入动作名称" data-rule="动作名称:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">附加参数：</label>
                <div class="ui-col-9">
                    <input type="text" name="t3" class="ui-form-ip">
                    <span class="input-tips">格式：a=1&b=2</span>
                </div>
            </div>
            {/if}
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">菜单排序：</label>
                <div class="ui-col-9">
                    <input type="text" name="t4" class="ui-form-ip" value="0">
                    <span class="input-tips">数字越小越靠前</span>
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">状态：</label>
                <div class="ui-col-9 col-right-top">
                    <label class="ui-radio"><input type="radio" name="t5" value="1" checked><i></i>启用</label>
                    <label class="ui-radio"><input type="radio" name="t5" value="0"><i></i>锁定</label>
                </div>
            </div>
            <div class="ui-form-group ui-hide">
            	<input type="hidden" name="token" value="{$token}">
                <button type="submit" class="ui-btn ui-btn-blue" id="sdcms-submit">保存</button>
                <button type="button" class="ui-btn ui-back">返回</button>
            </div>
        </form>
        <!---->
    </div>
<script>
$(function()
{
	var backurl=window.parent.location;
	$(".ui-form").form(
	{
		type:2,
		align:'bottom-center',
		result:function(form)
		{
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
						setTimeout(function(){parent.location.href=backurl;},1000);
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