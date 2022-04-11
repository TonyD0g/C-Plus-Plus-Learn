<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>区块管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：模板插件 > <a href="{U('index')}">区块管理</a></div>
    <div class="border">
        <!---->
        <a href="{U('add')}" class="ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加区块</a>
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th>区块说明</th>
                    <th width="300">关键字</th>
                    <th width="180">修改时间</th>
                    <th width="300">调用标签</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            {if count($file)==0}
            <tr>
                <td colspan="5">暂无区块</td>
            </tr>
            {/if}
            {foreach $file as $key=>$val}
            {php $n=$dir.'/'.$val[0]}
            <tr>
                <td class="ui-text-left">{if isset($name[$n])}{$name[$n]}{/if}</td>
                <td>{str_replace('.php','',$val[0])}</td>
                <td>{date('Y-m-d H:i:s',$val[1])}</td>
                <td><input type="text" class="block ui-form-ip" config="{str_replace('.php','',$val[0])}" value="" onFocus="this.select()"></td>
                <td><a href="{U('edit','root='.$val[2].'')}"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('del','key='.$val[2].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
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
	$(".block").each(function(e)
	{
		var key=$(this).attr("config");
		var html='{';
		html+='block("';
		html+=key;
		html+='")}';
		$(this).attr("value",html);
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