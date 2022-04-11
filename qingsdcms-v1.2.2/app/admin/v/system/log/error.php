<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>错误日志</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：系统管理 > <a href="{THIS_LOCAL}">错误日志</a></div>
    <div class="border">
        <!---->

        <a href="javascript:;" class="clear ui-btn ui-btn-info"><i class="ui-icon-delete"></i>一键清理</a>
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th>日志名称</th>
                    <th width="150">大小</th>
                    <th width="200">创建时间</th>
                    <th width="150">操作</th>
                </tr>
            </thead>
            <tbody>
            {foreach $db as $rs}
            <tr>
                <td class="ui-text-left">{$rs[0]}</td>
                <td>{$rs[2]}</td>
                <td>{date('Y-m-d H:i:s',$rs[1])}</td>
                <td><a href="javascript:;" class="view" data-name="{$rs[3]}"><span class="ui-icon-file-text"></span> 查看</a>　<a href="javascript:;" class="del" data-url="{U('del','key='.$rs[3].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/foreach}
            </tbody>
        </table>
        </div>
        <!---->
    </div>

<script>
$(function()
{
	$(".view").click(function()
	{
		var name=$(this).data("name");
		$.ajax(
		{
			type:'post',
			cache:false,
			url:'{U("view")}',
			data:'token={$token}&key='+name,
			error:function(e){alert(e.responseText);},
			success:function(data)
			{
				$.dialog(
				{
					title:"查看日志",
					text:data,
					oktheme:'ui-btn-info',
					ok:function(e)
					{
						e.close();
					}
				});
			}
		})
	});
	$(".clear").click(function()
	{
		$.dialog(
		{
			title:"操作提示",
			text:"确定要清理？不可恢复！",
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				$.ajax(
				{
                    url:'{U("clear")}',
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