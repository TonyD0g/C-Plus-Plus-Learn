<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>内链管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{THIS_LOCAL}">内链管理</a></div>
    <div class="border">
        <!---->
        <a href="javascript:;" data-url="{U('add')}" class="add-iframe ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加内链</a>
        <form method="post" class="ui-form">
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="100">排序</th>
                    <th width="80">ID</th>
                    <th>关键字</th>
                    <th width="300">内链网址</th>
                    <th width="100">替换次数</th>
                    <th width="100">状态</th>
                    <th width="150">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rs top="0" table="cms_sitelink" order="ordnum,id"}
            {rs:eof}
            <tr>
                <td colspan="7">暂无资料</td>
            </tr>
            {/rs:eof}
            <tr>
                <td><input type="hidden" name="mid[]" value="{$rs[id]}"><input type="text" class="ui-form-ip" name="ordnum[]" id="ordnum_{$rs[id]}" value="{$rs[ordnum]}" data-rule="required;int;"></td>
                <td>{$rs[id]}</td>
                <td class="ui-text-left">{$rs[title]}</td>
                <td><a href="{$rs[url]}" target="_blank">{$rs[url]}</a></td>
                <td>{if $rs[num]==0}全部{else}{$rs[num]}{/if}</td>
                <td><label class="ui-switch ui-switch-info"><input type="checkbox" {if $rs[isshow]==1} checked{/if} data-url="{U('switchs','id='.$rs[id].'')}"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                <td><a href="javascript:;" data-url="{U('edit',"id=".$rs[id]."")}" class="edit-iframe"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('del','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
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
	$(".add-iframe").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"添加内链",
			text:url,
			width:'550px',
			height:'405px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
    $(".edit-iframe").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"编辑内链",
			text:url,
			width:'550px',
			height:'405px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
	$('.ui-switch input[type=checkbox]').on('click',function()
	{
		var url=$(this).data("url");
		var result=($(this).is(':checked'))?1:0;
		$.ajax(
		{
			url:url,
			type:"post",
			dataType:'json',
			data:"token={$token}&isshow="+result,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					sdcms.success(d.msg);
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
	});
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
