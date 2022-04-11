<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑管理员</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body class="bg_white">
    <div class="border_iframe">
        <form class="ui-form" method="post">
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">用户：</label>
                <div class="ui-col-9">
                	<input type="text" name="t0" class="ui-form-ip" value="{$adminname}" disabled>
               	</div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">密码：</label>
                <div class="ui-col-9">
                	<input type="text" name="t1" class="ui-form-ip" maxlength="16" ><span class="input-tips">不修改请留空</span>
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">昵称：</label>
                <div class="ui-col-9">
                	<input type="text" name="t2" class="ui-form-ip" value="{$penname}">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">部门：</label>
                <div class="ui-col-9">
                    <select name="t3" class="ui-form-ip">
                        <option value="0">超级管理员</option>
                        {cms:rs top="0" table="cms_part" order="ordnum,id"}
                        <option value="{$rs[id]}"{if $pid==$rs[id]} selected{/if}>{$rs[title]}</option>
                        {/cms:rs}
                    </select>
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">状态：</label>
                <div class="ui-col-9 col-right-top">
                    <label class="ui-radio">
                        <input type="radio" name="t4" value="1"{if $isshow==1} checked{/if}><i></i>启用
                    </label>
                    <label class="ui-radio">
                        <input type="radio" name="t4" value="0"{if $isshow==0} checked{/if}><i></i>锁定
                    </label>
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <label class="ui-col-3 ui-col-form-label">只读：</label>
                <div class="ui-col-9 col-right-top">
                    <label class="ui-radio"><input type="radio" name="t5" value="1"{if $readonly==1} checked{/if}><i></i>开启</label>
                    <label class="ui-radio"><input type="radio" name="t5" value="0"{if $readonly==0} checked{/if}><i></i>关闭</label>
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