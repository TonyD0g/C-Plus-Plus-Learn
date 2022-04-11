<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>标签管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{THIS_LOCAL}">标签管理</a></div>
    <div class="border">
        <!---->

        <a href="javascript:;" class="clear ui-btn ui-btn-info ui-mr-sm">删除无效标签</a>
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="80">ID</th>
                    <th>标签名称</th>
                    <th width="120">使用次数</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rs pagesize="20" table="cms_tags" where="1=1" order="hits desc,id desc"}
            {rs:eof}
            <tr>
                <td colspan="4">暂无资料</td>
            </tr>
            {/rs:eof}
            <tr>
                <td>{$rs[id]}</td>
                <td class="ui-text-left">{$rs[title]}</td>
                <td>{$rs[hits]}</td>
                <td><a href="javascript:;" class="del" data-url="{U('del','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/cms:rs}
            </tbody>
        </table>
        </div>
        {if $total_rs!=0}
        <div class="ui-page ui-page-center ui-page-info">
            <div class="ui-page-list"><ul>{$showpage}</ul></div>
        </div>
        {/if}
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
			text:"确定要删除？不可恢复！",
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