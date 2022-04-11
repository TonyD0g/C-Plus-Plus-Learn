<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>缓存管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：系统管理 > <a href="{THIS_LOCAL}">缓存管理</a></div>
    <div class="border">
        <!---->

        <a href="javascript:;" class="clear ui-btn ui-btn-info ui-mr-sm"><i class="ui-icon-delete"></i>一键清理</a>
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th>项目</th>
                    <th width="250">路径</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
            {if count($data)==0}
            <tr>
                <td colspan="3">暂无缓存</td>
            </tr>
            {/if}
            {foreach $data as $rs}
            <tr>
                <td class="ui-text-left">{$rs['title']}</td>
                <td class="ui-text-left">{$rs['path']}</td>
                <td><a href="javascript:;" class="del" data-url="{U('del','id='.$rs['id'].'')}"><span class="ui-icon-delete"></span> 清理</a></td>
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
	$(".clear").click(function()
	{
		$.dialog(
		{
			title:"操作提示",
			text:"确定要清理？",
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				$.ajax(
				{
                    url:"{U('clear')}",
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
			text:"确定要清理？",
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