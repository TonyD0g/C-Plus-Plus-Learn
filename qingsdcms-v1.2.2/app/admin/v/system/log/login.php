<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>登录日志</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：<a href="{THIS_LOCAL}">登录日志</a></div>
    <div class="border">
        <!---->
        <div class="navbar">
            <div class="lefter">
                <a href="javascript:;" class="btach ui-btn ui-btn-info ui-mr-sm"><i class="ui-icon-delete"></i>批量删除</a>
                
                <span class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                    <a class="ui-btn-group-item{if $type==0} active{/if}" href="{U('index','type=0')}">全部</a>
                    <a class="ui-btn-group-item{if $type==1} active{/if}" href="{U('index','type=1')}">成功</a>
                    <a class="ui-btn-group-item{if $type==2} active{/if}" href="{U('index','type=2')}">失败</a>
                </span>
            </div>            
        </div>

        <form method="post" class="ui-form">
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                	<th width="30" height="30"><label class="ui-checkbox ui-tips" data-align="right-top" data-title="全选/取消"><input type="checkbox" class="checkall" value=""><i></i></label></th>
                    <th width="80">ID</th>
                    <th width="150">用户名</th>
                    <th width="130">IP</th>
                    <th>消息</th>
                    <th width="180">日期</th>
                    <th width="100">状态</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rs pagesize="20" table="cms_log_login" where="$where" order="id desc"}
            {rs:eof}
            <tr>
                <td colspan="8">暂无资料</td>
            </tr>
            {/rs:eof}
            <tr>
            	<td><label class="ui-checkbox"><input type="checkbox" name="id" value="{$rs[id]}"><i></i></label></td>
                <td>{$rs[id]}</td>
                <td>{$rs[loginname]}</td>
                <td>{$rs[loginip]}</td>
                <td class="ui-text-left">{$rs[loginmsg]}</td>
                <td>{date('Y-m-d H:i',$rs[logindate])}</td>
                <td>{iif($rs[loginstate]==1,'成功','<em>失败</em>')}</td>
                <td><a href="javascript:;" class="del" data-url="{U('del','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/cms:rs}
            </tbody>
        </table>
        </div>
        {if $total_rs!=0}
        <div class="ui-page ui-page-center ui-page-info ui-mt">
            <ul>{$showpage}</ul>
        </div>
        {/if}
        </form>
        <!---->
    </div>

<script>
$(function()
{
    $(".btach").click(function()
	{
		var type=$(this).attr("type");
		var data=[];
		$(".ui-form").find("input[type=checkbox]:checked").each(function()
		{
			if($(this).attr("class")!='checkall' && !$(this).closest("label").hasClass("ui-switch"))
			{
				data.push($(this).val());
			}
		});
        if(data.length==0)
        {
            sdcms.error('至少选择一条内容');
        }
        else
        {
            $.ajax(
			{
                type:'post',
                cache:false,
                dataType:'json',
                url:'{U("btach")}',
                data:'token={$token}&id='+data.join(","),
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
			text:"确定要删除此日志？",
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