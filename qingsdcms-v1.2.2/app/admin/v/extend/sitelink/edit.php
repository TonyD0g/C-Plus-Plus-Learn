<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑内链</title>
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
                <label class="ui-col-3 ui-col-form-label">关键字：</label>
                <div class="ui-col-9">
                    <input type="text" name="t0" class="ui-form-ip" value="{$title}" placeholder="请输入关键字" data-rule="关键字:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">链接网址：</label>
                <div class="ui-col-9">
                    <input type="text" name="t1" class="ui-form-ip" value="{$url}" placeholder="请输入链接网址" data-rule="链接网址:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">替换次数：</label>
                <div class="ui-col-9">
                    <input type="text" name="t2" class="ui-form-ip" maxlength="10" value="{$num}">
                    <span class="input-tips">为0时替换全部</span>
                </div>
            </div> 
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">排序：</label>
                <div class="ui-col-9">
                    <input type="text" name="t3" class="ui-form-ip" value="{$ordnum}">
                    <span class="input-tips">数字越小越靠前</span>
                </div>
            </div>
            <div class="ui-form-group ui-row ui-mb-0">
                <label class="ui-col-3 ui-col-form-label">状态：</label>
                <div class="ui-col-9 col-right-top">
                    <label class="ui-radio"><input type="radio" name="t4" id="t4_1" value="1"{if $isshow==1} checked{/if}><i></i>启用</label>
                    <label class="ui-radio"><input type="radio" name="t4" id="t4_2" value="0"{if $isshow==0} checked{/if}><i></i>锁定</label>
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