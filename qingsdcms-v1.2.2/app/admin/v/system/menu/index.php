<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>后台菜单</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：系统管理 > <a href="{U('index')}">后台菜单</a></div>
    <div class="border">
        <!---->

        <a href="javascript:;" data-url="{U('add','fid='.$fid.'')}" class="{if $fid==0}add-iframe{else}add-iframe-son{/if} ui-btn ui-btn-info ui-mr-sm"><i class="ui-icon-plus"></i>添加菜单</a>
        {if $fid>0}
        <a href="{U('index')}" class="ui-btn ui-btn-yellow"><i class="ui-icon-rollback"></i>返回上级</a>
        {/if}
        <form method="post" class="ui-form">
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="100">排序</th>
                    <th width="80">菜单ID</th>
                    <th>菜单名称</th>
                    <th width="100">状态</th>
                    <th width="{if $fid==0}24{else}16{/if}0">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rp top="0" table="cms_menu" where="followid=$fid" order="ordnum,id"}
            {php $classid=$rp[id]}
            <tr>
                <td><input type="hidden" name="mid[]" value="{$rp[id]}"><input type="text" class="ui-form-ip" name="ordnum[]" id="ordnum_{$rp[id]}" value="{$rp[ordnum]}" data-rule="required;int;"></td>
                <td>{$rp[id]}</td>
                <td class="ui-text-left">{$rp[title]}</td>
                <td><label class="ui-switch ui-switch-info"><input type="checkbox" {if $rp[isshow]==1} checked{/if} data-url="{U('switchs','id='.$rp[id].'')}"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                <td>{if $fid==0}<a href="{U('index',"fid=".$rp[id]."")}"><span class="ui-icon-plus"></span> 子菜单管理</a>　{/if}<a href="javascript:;" data-url="{U('edit',"id=".$rp[id]."")}" class="edit-iframe{if $fid>0}s{/if}"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('del','id='.$rp[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/cms:rp}
            </tbody>
        </table>
        </div>
        <input type="hidden" name="token" value="{$token}">
        <button type="submit" class="ui-btn ui-btn-yellow">保存排序</button>
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
			title:"添加菜单",
			text:url,
			width:'600px',
			height:'260px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
	$(".add-iframe-son").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"添加子菜单",
			text:url,
			width:'600px',
			height:'495px',
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
			title:"编辑菜单",
			text:url,
			width:'600px',
			height:'260px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
	$(".edit-iframes").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"编辑子菜单",
			text:url,
			width:'600px',
			height:'495px',
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