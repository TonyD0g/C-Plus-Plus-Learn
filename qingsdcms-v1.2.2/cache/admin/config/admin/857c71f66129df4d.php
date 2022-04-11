<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>修改密码</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body class="bg_white">
	<div class="border_iframe">
        <form class="ui-form" method="post">
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">原密码：</label>
                <div class="ui-col-9">
                <input type="password" name="t0" class="ui-form-ip" maxlength="16" data-rule="原密码:required;password;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">新密码：</label>
                <div class="ui-col-9">
                <input type="password" name="t1" id="t1" class="ui-form-ip" maxlength="16" data-rule="新密码:required;password;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">确认新密码：</label>
                <div class="ui-col-9">
                <input type="password" name="t2" class="ui-form-ip" maxlength="16" data-rule="确认新密码:required;password;match(t1)">
                </div>
            </div>
            <div class="ui-form-group ui-hide">
            	<input type="hidden" name="token" value="<?php echo $token;?>">
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
                url:'<?php echo THIS_LOCAL;?>',
                data:$(form).serialize(),
                error:function(e){alert(e.responseText);},
                success:function(d)
                {
                    if(d.state=='success')
                    {
                        sdcms.success(d.msg);
                       	setTimeout(function(){parent.$.dialogclose();},1500);
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