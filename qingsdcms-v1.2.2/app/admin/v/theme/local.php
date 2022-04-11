<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>模板管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：模板插件 > <a href="{U('index')}">模板管理</a></div>
	<div class="borders">
        <!---->
        <div class="ui-tabs ui-tabs-white" data-href="1">
            <ul class="ui-tabs-nav">
			  <li class="active"><a href="{U('index','type=0')}">本地模板</a></li>
			  <li><a href="{U('index','type=1')}">模板市场</a></li>
            </ul>
            <div class="ui-tabs-content ui-pb-0">
                <div class="ui-tabs-pane active">
                <!--loop-->
                <div class="ui-piclist ui-piclist-col-right ui-piclist-1-1 ui-piclist-100">
					{foreach $folder as $key=>$val}
					{php $name=$val['app'];}
					{php $key=$val['key'];}
					<div class="ui-piclist-item">
						<div class="ui-piclist-image"><a href="{U('lists','root='.$key.'')}"><img src="{WEB_ROOT}theme/{$name}/{$val['image']}" alt="{$val['title']}"{if $type==0} class="ui-tips" data-align="top" data-title="点击管理模板文件"{/if}></a>{if $val['isstall']==1}<em class="bg-yellow">使用中</em>{/if}</div>
						<div class="ui-piclist-body">
								<div class="ui-piclist-flex">
									<div class="ui-piclist-price"><div>{$val['title']}</div><div>作者：<a href="{$val['url']}" target="_blank">{$val['author']}</a></div></div>
									<div class="action">
										<a href="javascript:;" config="{$name}" class="apply ui-btn ui-btn-blue">应用模板</a>
									</div>
								</div>
						</div>
					</div>
					{/foreach}
				</div>
                <!--loop-->
                </div>
            </div>
        </div>
        <!---->
    </div>
    
<script>
$(function()
{
	$(".apply").click(function()
	{
		var e=$(this);
		var config=e.attr("config");
		$.dialog(
		{
			title:"模板应用",
			text:'确定要使用此模板？',
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				$.ajax(
				{
					type:'post',
					url:'{U("config")}',
					data:'token={$token}&config='+encodeURIComponent(config),
					dataType:'json',
					success:function(d)
					{
						e.close();
						if(d.state=='success')
						{
							sdcms.success(d.msg);
							setTimeout(function(){location.href='{THIS_LOCAL}';},3000);
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