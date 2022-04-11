<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>留言管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{THIS_LOCAL}">留言管理</a></div>
    <div class="border">
        <!---->
        <div class="navbar">
            <div class="lefter">
                <a href="javascript:;" class="ui-btn ui-btn-info ui-dropdown-show ui-mr-sm" data-target="#dropdown-1"><i class="ui-icon-Batchfolding"></i>批量操作</a>
                
                <div class="ui-dropdown" id="dropdown-1">
                    <a href="javascript:;" class="ui-dropdown-item btach" type="1">批量启用</a>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="2">批量锁定</a>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="3">批量删除</a>
                </div>
                <span class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                    <a class="ui-btn-group-item{if $type==0} active{/if}" href="{U('index','type=0')}">全部</a>
                    <a class="ui-btn-group-item{if $type==1} active{/if}" href="{U('index','type=1')}">未审</a>
                    <a class="ui-btn-group-item{if $type==2} active{/if}" href="{U('index','type=2')}">已审</a>
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
                    {if cms[state_name]==1}<th>姓名</th>{/if}
                    {if cms[state_mobile]==1}<th width="150">手机</th>{/if}
                    {if cms[state_email]==1}<th width="300">邮箱</th>{/if}
                    {if cms[state_qq]==1}<th width="150">QQ</th>
                    {/if}
                    <th width="120">日期</th>
                    <th width="120">状态</th>
                    <th width="150">操作</th>
                </tr>
            </thead>
            <tbody>
            {cms:rs pagesize="20" table="cms_book" where="$where" order="id desc"}
            {rs:eof}
            <tr>
                <td colspan="{$total}">暂无资料</td>
            </tr>
            {/rs:eof}
            <tr>
            	<td><label class="ui-checkbox"><input type="checkbox" name="id" value="{$rs[id]}"><i></i></label></td>
                <td>{$rs[id]}</td>
                {if cms[state_name]==1}<td class="ui-text-left">{$rs[name]}</td>{/if}
                {if cms[state_mobile]==1}<td>{$rs[mobile]}</td>{/if}
                {if cms[state_email]==1}<td>{$rs[email]}</td>{/if}
                {if cms[state_qq]==1}<td>{$rs[qq]}</td>
                {/if}
                <td>{date('Y-m-d H:i',$rs[createdate])}</td>
                <td><label class="ui-switch ui-switch-info"><input type="checkbox" {if $rs[isshow]==1} checked{/if} data-url="{U('switchs','id='.$rs[id].'')}"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                <td><a href="javascript:;" data-url="{U('edit',"id=".$rs[id]."")}" class="edit-iframe"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{U('del','id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            {/cms:rs}
            </tbody>
        </table>
        </div>
        {if $total_rs!=0}
        <div class="ui-page ui-page-center ui-page-info">
            <ul>{$showpage}</ul>
        </div>
        {/if}
        </form>
        <!---->
    </div>

<script>
$(function()
{
	$(".edit-iframe").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"编辑留言",
			text:url,
			width:'600px',
			height:'445px',
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
                data:'token={$token}&id='+data.join(",")+'&type='+type,
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
