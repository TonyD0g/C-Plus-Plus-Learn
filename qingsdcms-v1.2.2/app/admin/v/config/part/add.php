<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>添加部门</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body class="bg_white">

<div class="border_iframe">
    <form class="ui-form" method="post">
        <div class="ui-form-group ui-row">
            <label class="ui-col-3 ui-col-form-label">名称：</label>
            <div class="ui-col-9">
                <input type="text" name="t0" class="ui-form-ip" maxlength="20" placeholder="请输入部门名称" data-rule="部门名称:required;">
            </div>
        </div>
        <div class="ui-form-group ui-row">
            <label class="ui-col-3 ui-col-form-label">排序：</label>
            <div class="ui-col-9">
                <input type="text" name="t1" class="ui-form-ip">
                <span class="input-tips">数字越小越靠前</span>
            </div>
        </div>
        <div class="ui-form-group ui-hide">
        	<input type="hidden" name="token" value="{$token}">
            <button type="submit" class="ui-btn ui-btn-blue" id="sdcms-submit">保存</button>
            <button type="button" class="ui-btn ui-back">返回</button>
        </div>
    </form>
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