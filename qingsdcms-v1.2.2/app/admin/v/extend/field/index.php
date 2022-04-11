<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>字段管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{U('index')}">字段管理</a></div>
    
    <div class="borders">
        <!---->
        <div class="ui-tabs ui-tabs-white" data-href="1">
        	<div class="ui-tabs-header-nav">
                <ul class="ui-tabs-nav">
                    <li{if $mid==0} class="active"{/if}><a href="{U('index')}">全部字段</a></li>
                    <li{if $mid==1} class="active"{/if}><a href="{U('index','mid=1')}">栏目表</a></li>
                    <li{if $mid==2} class="active"{/if}><a href="{U('index','mid=2')}">内容表</a></li>
                    <li{if $mid==3} class="active"{/if}><a href="{U('index','mid=3')}">广告表</a></li>
                </ul>
                <div class="ui-tabs-header-more"><a href="{U('add',"mid=".$mid."")}" class="ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加字段</a></div>
            </div>
            <div class="ui-tabs-content" style="margin-top:-1px;">
                <div class="ui-tabs-pane active">
                <!--loop-->
                <form method="post" class="ui-form">
                <div class="ui-table-wrap">
                <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mt ui-mb">
                    <thead class="ui-thead-gray">
                        <tr>
                            <th width="100">排序</th>
                            <th width="80">字段ID</th>
                            <th>字段名称</th>
                            <th width="120">Key</th>
                            <th width="120">类型</th>
                            <th width="100">用途</th>
                            <th width="80">状态</th>
                            <th width="150">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    {cms:rs pagesize="20" table="cms_field" where="$where" order="ordnum,id"}
                    {rs:eof}<tr>
                        <td colspan="8">暂无资料</td>
                    </tr>
                    {/rs:eof}
                    <tr>
                        <td><input type="hidden" name="mid[]" value="{$rs[id]}"><input type="text" class="ui-form-ip" name="ordnum[]" id="ordnum_{$rs[id]}" value="{$rs[ordnum]}" data-rule="required;int;"></td>
                        <td>{$rs[id]}</td>
                        <td class="ui-text-left">{$rs[field_title]}</td>
                        <td>{$rs[field_key]}</td>
                        <td>
                        {switch $rs[field_type]}
                        {case 1}普通文本{/case}
                        {case 2}普通文本-日期{/case}
                        {case 3}普通文本-整数{/case}
                        {case 4}普通文本-价格{/case}
                        {case 5}普通文本-上传{/case}
                        {case 6}普通文本-密码{/case}
                        {case 7}普通文本-隐藏域{/case}
                        {case 8}多行文本框{/case}
                        {case 9}单选按钮{/case}
                        {case 10}复选框{/case}
                        {case 11}下拉菜单{/case}
                        {case 12}编辑器{/case}
                        {case 13}图集{/case}
                        {case 14}数据集{/case}
                        {case 15}下载集{/case}
                        {/switch}</td>
                        <td>
                        {switch $rs[mid]}
                        {case 1}栏目{/case}
                        {case 2}内容{/case}
                        {case 3}广告{/case}
                        {/switch}</td>
                        <td><label class="ui-switch ui-switch-info"><input type="checkbox" {if $rs[isshow]==1} checked{/if} data-url="{U('switchs','id='.$rs[id].'')}"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                        <td><a href="{U('edit',"id=".$rs[id]."&mid=$mid")}"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('del','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
                    </tr>
                    {/cms:rs}
                    </tbody>
                </table>
                </div>
                {if $total_rs!=0}
                <div class="ui-page ui-page-right ui-page-info">
                    <div class="ui-page-other"><input type="hidden" name="token" value="{$token}"><button type="submit" class="ui-btn ui-btn-yellow">保存排序</button></div>
                    <div class="ui-page-list"><ul>{$showpage}</ul></div>
                </div>
                {/if}
                </form>
                <!--loop-->
                </div>
            </div>
        </div>
        <!---->
    </div>

<script>
$(function()
{
	$('.ui-switch input[type=checkbox]').on('click',function()
	{
		var url=$(this).data("url");
		var result=($(this).is(':checked'))?1:0;
		$.ajax(
		{
			url:url,
			type:"post",
			dataType:'json',
			data:"token={$token}&state="+result,
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