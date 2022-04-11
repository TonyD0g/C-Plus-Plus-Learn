<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>管理首页</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/js/slimscroll.js"></script>
</head>

<body>
    <div class="position">当前位置：<a href="{THIS_LOCAL}">管理首页</a></div>
    
    <div class="home">
        <div class="count">
            <a class="box" href="{U('content/index')}">
                <h3>内容</h3>
                <div class="num">{$count['content']['total']}</div>
                <div class="total">草稿：<span class="red">{$count['content']['num']}</span></span></div>
                <div class="icon icon-1"><span class="ui-icon-file-word"></span></div>
            </a>

            <a class="box" href="{U('book/index')}">
                <h3>留言</h3>
                <div class="num">{$count['book']['total']}</div>
                <div class="total">待处理：<span class="red">{$count['book']['num']}</span></div>
                <div class="icon icon-3"><span class="ui-icon-solution"></span></div>
            </a>
			
			<a class="box" href="{U('link/index')}">
                <h3>友链</h3>
                <div class="num">{$count['link']['total']}</div>
                <div class="total">草稿：<span class="red">{$count['link']['num']}</span></div>
                <div class="icon icon-2"><span class="ui-icon-link"></span></div>
            </a>
            
            <a class="box checkupdate" href="javascript:;">
                <h3>版本</h3>
                <div class="num">{cms[version_number]}</div>
                <div class="total">检查更新</div>
                <div class="icon icon-4"><span class="ui-icon-cloud-server"></span></div>
            </a>
        </div>
      
        <div class="ui-row ui-mt-20 homeother">
            <div class="ui-col-6">
            <!---->
            <div class="box">
                <div class="subject">服务器环境</div>
                <ul class="ui-list server">
                    {foreach $services as $key=>$val}
                    <li><a><span>{$key}：</span>{$val}</a></li>
                    {/foreach}
                </ul>
            </div>
            <!---->
            </div>

            <div class="ui-col-6">
            	<!---->                 
                 <div class="box">   
                    <div class="subject"><a href="{U('loglogin/index')}">更多>></a>登录日志</div>
                    <div class="log">
                        {cms:rs top="20" table="cms_log_login" where="$where" order="id desc"}
                        <p><strong><span>{date('Y-m-d H:i',$rs[logindate])}</span>{$rs[loginname]}</strong>{$rs[loginip]}<span>{$rs[loginmsg]}</span></p>
                        {/cms:rs}
                    </div>
                </div>
                <!---->
            </div>
        </div>
            
    </div>

    <div class="foottop"></div>
    <script>
	$(function()
	{
		$(".log").slimscroll({height:"320px",size:"5px",color:"#7CB5EC",opacity:0.6,wheelStep:5,touchScrollStep:50})
		$(".checkupdate").click(function()
		{
			sdcms.loading("正在检查，请稍等");
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'{U("upgrade/version")}',
				data:'token={$token}',
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						var data=$.parseJSON(d.msg);
						var zip=data.zip;
						$.dialog(
						{
							title:'在线升级',
							text:'有新版本可升级，版本号：<span class="ui-text-red">'+data.version+'</span><h3 class="ui-text-red ui-mt-30">升级前请务必做好以下准备工作：</h3><div class="ui-height-40">1、备份好网站的<code>数据库</code>和<code>模板文件</code>。<br>2、<code>网站根目录</code>给予读写权限（虚拟主机一般无需设置）。</div>',
							okval:'升级',
							ok:function(e)
							{
								e.close();
								if(confirm("确定已经备份好数据库和模板文件\n并设置好权限？"))
								{
									sdcms.loading('正在升级，请耐心等待');
									$.ajax(
									{
										type:'post',
										cache:false,
										dataType:'json',
										url:'{U("upgrade/zip")}',
										data:'token={$token}&zip='+zip,
										error:function(e){alert(e.responseText);},
										success:function(data)
										{
											if(data.state=='success')
											{
												sdcms.success(data.msg);
												setTimeout(function(){parent.location.href=parent.location.href},5000);
											}
											else
											{
												sdcms.error(data.msg);
											}
										}
									});
								}
							}
						})
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		});
	});
	</script>
</body>
</html>