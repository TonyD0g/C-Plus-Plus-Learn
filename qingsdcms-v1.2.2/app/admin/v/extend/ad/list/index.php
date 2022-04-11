<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>广告管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{U('index')}">广告管理</a> > <a href="{U('lists','cid='.$cid.'')}">{$gname}</a></div>
    <div class="border">
        <!---->
        <a href="{U('addad','cid='.$cid.'')}" class="ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加广告</a><a href="{U('index')}" class="ui-btn ui-btn-yellow ui-ml"><i class="ui-icon-rollback"></i>返回广告组</a>
        <form method="post" class="ui-form">
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="100">排序</th>
                    <th width="80">ID</th>
                    <th>广告名称</th>
                    <th width="280">链接</th>
                    <th width="180">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rs top="0" table="cms_ad" where="cid=$cid" order="ordnum,id"}
            {rs:eof}
            <tr>
                <td colspan="5">暂无资料</td>
            </tr>
            {/rs:eof}
            <tr>
                <td><input type="hidden" name="mid[]" value="{$rs[id]}"><input type="text" class="ui-form-ip" name="ordnum[]" id="ordnum_{$rs[id]}" value="{$rs[ordnum]}" data-rule="required;int;"></td>
                <td>{$rs[id]}</td>
                <td class="ui-text-left"><a href="javascript:;" class="ui-tips" data-align="bottom-left" data-pic="{$rs[pic]}">{$rs[name]}</a></td>
                <td><a href="{$rs[url]}" target="_blank">{$rs[url]}</a></td>
                <td><a href="{U('editad',"id=".$rs[id]."&cid=".$cid."")}"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('delad','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/cms:rs}
            </tbody>
        </table>
        </div>
        {if $total_rs!=0}
        <input type="hidden" name="token" value="{$token}">
        <button type="submit" class="ui-btn ui-btn-yellow">保存排序</button>
        {/if}
        </form>
        <!---->
    </div>

<script>
$(function()
{
	$(".ui-form").form(
	{
		type:2,
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
    $(".del").click(function()
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
})
</script>
</body>
</html>
