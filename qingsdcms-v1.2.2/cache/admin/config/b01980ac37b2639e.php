<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>账号绑定</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body class="bg_white">
	<div class="border_iframe">
        <form class="ui-form" method="post">
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">用户名：</label>
                <div class="ui-col-9">
                	<input type="text" name="uname" class="ui-form-ip" value="<?php echo C(strtoupper('sys_uname'));?>" maxlength="16" data-rule="用户名:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">密码：</label>
                <div class="ui-col-9">
                	<input type="password" name="upass" autocomplete="off" class="ui-form-ip" data-rule="密码:required;">
                </div>
            </div>
			<div class="ui-text-red ui-row"><label class="ui-col-3"></label>绑定后，可以升级，下载模板和插件。</div>
            <div class="ui-form-group ui-hide">
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
                       	setTimeout(function(){parent.$.dialogclose();parent.location.href=backurl;},3500);
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