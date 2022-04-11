<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>登录页面</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body class="bg-login">
    <div class="ui-login ui-am-slide-bottom">
        <div class="header">
        	<div class="logo"><a href="<?php echo WEB_ROOT;?>"><span class="ui-icon-home"></span>返回首页</a><img src="<?php echo C(strtoupper('admin_logo'));?>" height="40"></div>
        </div>
        <form class="ui-form" method="post">
            <div class="ui-form-group">
        		<i class="ui-form-icon ui-icon-user"></i>
                <input type="text" name="t0" tabindex="1" class="ui-form-ip" data-rule="用户名:required;username;" placeholder="请输入用户名" >
            </div>
            <div class="ui-form-group">
        		<i class="ui-form-icon ui-icon-lock"></i>
                <input type="password" name="t1" tabindex="2" class="ui-form-ip" placeholder="请输入密码" data-rule="密码:required;password;">
            </div>
            <?php if (C('admin_code')==1) { ?>
            <div class="ui-form-group">
                <div class="ui-input-group">
                	<i class="ui-form-icon ui-icon-eye"></i>
                    <input type="text" name="t2" tabindex="3" id="t2" class="ui-form-ip radius-right-none" placeholder="请输入验证码" data-rule="验证码:required;">
                    <span class="code"><img src="<?php echo U('code');?>" id="verify" data-title="点击更换验证码" class="ui-tips"></span>
                </div>
            </div>
            <?php }?>
            <div class="ui-form-group">
            	<input type="hidden" name="token" value="<?php echo $token;?>">
                <input type="submit" value="登录" class="ui-btn ui-btn-block">
            </div>
        </form>
    </div>
<script>
$(function()
{
	$("#verify").click(function()
	{
		var src=$(this).attr("src");
		src+=((src.indexOf("?")>0)?'&':'?')+'&rnd='+Math.round();
		$(this).attr("src",src);
		$("#t2").val("");
	});
	$("html,body").css({"display":"flex","align-items":"center","justify-content":"center","height":"100%"});
	$(".ui-form").form(
	{
		type:2,
		align:'top-right',
		result:function(form)
		{
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'<?php echo U("check");?>',
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){location.href='<?php echo N(MODULE_NAME);?>';},1500);
					}
					else
					{
						<?php if (C('admin_code')==1) { ?>$("#verify").click();<?php }?>
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
})
if(self!=top){top.location=self.location;}
</script>
</body>
</html>