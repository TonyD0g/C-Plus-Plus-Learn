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
			  <li><a href="{U('index','type=0')}">本地模板</a></li>
			  <li class="active"><a href="{U('index','type=1')}">模板市场</a></li>
            </ul>
            <div class="ui-tabs-content ui-pb-0">
                <div class="ui-tabs-pane active">
                <!--loop-->
                <div class="ui-piclist ui-piclist-col-right ui-piclist-1-1 ui-piclist-100">
					{foreach $folder as $key=>$val}
					{php $name=$val['app'];}
					{php $key=$val['key'];}
					<div class="ui-piclist-item">
						<div class="ui-piclist-image"><a href="{$val['showurl']}" target="_blank"><img src="{$val['image']}" alt="{$val['title']}"></a>{if $val['price']>0 || $val['point']>0}<em class="bg-yellow">收费模板</em>{/if}
                        <div class="intro">{$val['intro']}</div></div>
						<div class="ui-piclist-body">
								<div class="ui-piclist-flex">
									<div class="ui-piclist-price"><div>{$val['title']}</div><div>作者：<a href="{$val['url']}" target="_blank">{$val['author']}</a></div></div>
									<div class="action">
                                        {if $val['isdown']==0}
                                            <a href="javascript:;" config="{$name}" class="down ui-btn ui-btn-blue" data-price="{$val['price']}" data-point="{$val['point']}" data-url="{U('down','id='.$val['id'].'')}">下载模板</a>
                                        {else}
                                            <a class="ui-btn">已下载</a>
                                        {/if}
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
	$(".down").click(function()
	{
		var url=$(this).data("url");
		var price=$(this).data("price") || 0;
		var point=$(this).data("point") || 0;
		var html='';
		if(price>0 || point>0)
		{
			html+='<div class="ui-height-40">此模板需要支付';
			if(price>0)
			{
				html+='<span class="ui-text-red ui-ml-sm ui-mr-sm">'+price+'</span>元';
			}
			if(price>0 && point>0)
			{
				html+='或';
			}
			if(point>0)
			{
				html+='<span class="ui-text-red ui-ml-sm ui-mr-sm">'+point+'</span>积分';
			}
			html+='才能下载，<div class="ui-text-red ui-ml-sm ui-mr-sm">优先使用积分扣费，积分不足时使用余额，不重复扣费。</div></div>';
		}
		$.dialog(
		{
			title:"操作提示",
			text:"确定要下载此模板？"+html,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				sdcms.loading('正在下载，请稍等');
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