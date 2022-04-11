<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑留言</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/admin/js/base.js"></script>
</head>

<body class="bg_white">
	
    <div class="border_iframe">
        <!---->
        <form class="ui-form" method="post">
            {if cms[state_name]==1}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">姓名：</label>
                <div class="ui-col-9">
                    <input type="text" name="name" maxlength="10" value="{$name}" class="ui-form-ip" placeholder="请输入姓名" data-rule="姓名:required;">
                </div>
            </div>
            {/if}
			{if cms[state_mobile]==1}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">手机：</label>
                <div class="ui-col-9">
                    <input type="text" name="mobile" maxlength="11" value="{$mobile}" class="ui-form-ip" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;">
                </div>
            </div>
            {/if}
			{if cms[state_email]==1}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">邮箱：</label>
                <div class="ui-col-9">
                    <input type="text" name="email" maxlength="50" value="{$email}" class="ui-form-ip" placeholder="请输入邮箱" data-rule="邮箱:required;email;">
                </div>
            </div>
            {/if}
			{if cms[state_qq]==1}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">QQ：</label>
                <div class="ui-col-9">
                    <input type="text" name="qq" maxlength="20" value="{$qq}" class="ui-form-ip" placeholder="请输入QQ号码" data-rule="QQ:required;qq;">
                </div>
            </div>
            {/if}
			{if cms[state_message]==1}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label-top">留言：</label>
                <div class="ui-col-9">
                    <textarea name="message" class="ui-form-ip ui-form-limit" data-max="255" rows="4" placeholder="请输入留言内容" data-rule="留言内容:required;">{$message}</textarea>
					<div class="ui-form-limit-text"><span>0</span>/255</div>
                </div>
            </div>
            {/if}
			<div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label-top">回复：</label>
                <div class="ui-col-9">
                    <textarea name="reply" class="ui-form-ip ui-form-limit" data-max="255" rows="4" placeholder="请输入回复内容" data-rule="回复内容:required;">{$reply}</textarea>
					<div class="ui-form-limit-text"><span>0</span>/255</div>
                </div>
            </div>
            <div class="ui-form-group ui-row ui-mb-0">
                <label class="ui-col-3 ui-col-form-label">状态：</label>
                <div class="ui-col-9 col-right-top">
                	<label class="ui-radio"><input type="radio" name="isshow" value="1" {if $isshow==1} checked{/if}><i></i>启用</label>
                    <label class="ui-radio"><input type="radio" name="isshow" value="0" {if $isshow==0} checked{/if}><i></i>锁定</label>
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