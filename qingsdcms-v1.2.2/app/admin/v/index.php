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
<base target="iframe_body">
</head>

<body>

    <div class="ui-north">
        <div class="logo"><img src="{cms[admin_logo]}" height="40"></div>
        <div class="user_base">{get_admin_info('penname')}<span class="ui-icon-down"></span>
            <ul>
                <li><a href="javascript:;" class="editpass" data-url="{U('pass')}">修改密码</a></li>
                <li><a href="{U('out')}" target="_parent">退出登录</a></li>
            </ul>
        </div>
        <div class="other_left"><a href="javascript:;" class="ui-icon-Import"></a></div>
        <div class="other_menu"><a class="ui-icon-lists ui-offside-show" href="javascript:;" data-target="#offside-left"></a></div>
        <div class="other_link">
            <ul>
                <li><a href="{WEB_ROOT}" target="_blank">预览网站</a></li>
				{if get_admin_info('pid')==0}
                <li><a href="javascript:;" class="bizcode">授权码</a></li>
				<li><a href="javascript:;" class="bind">账号绑定</a></li>
				{/if}
            </ul>
        </div>
    </div>
    
    <div class="ui-body">
        <div class="ui-west">
        	<!---->
            <div class="leftwarp">
                
				<!---->
				<div class="ui-collapse-menu-title active"><a href="{THIS_LOCAL}" target="_parent">管理首页</a></div>
				{cms:rp top="0" table="cms_menu" where="isshow=1 and followid=0 $where" order="ordnum,id" auto="j"}
                {php $classid=$rp[id]}
				<div class="ui-collapse-menu-title" data-type="1"><a href="javascript:;">{$rp[title]}</a><i class="ui-icon-right"></i>	</div>
				<div class="ui-collapse-menu-body">
					<ul>
						{cms:rs top="0" table="cms_menu" where="isshow=1 and followid=$classid $where" order="ordnum,id"}
						<li><a href="{get_admin_menu_url($rs[cname],$rs[aname],$rs[dname])}">{$rs[title]}</a></li>
						{/cms:rs}
					</ul>
				</div>
				{/cms:rp}
				<!---->
				
            </div>
            <!---->
        </div>
        
        <div class="ui-center"></div>
        
    </div>
	<div class="ui-offside ui-offside-left" id="offside-left">
        
    </div>
    <div class="ui-music ui-hide"></div>
    <script>
	function editbiz()
	{
		var html='<div class="ui-mb-15"><span class="ui-text-gray">授权类型：</span>';
			html+='<label class="ui-radio"><input type="radio" name="authtype" value="1" {if C("sys_auth_type")=="network"} checked{/if}><i></i>网络授权</label>';
			html+='<label class="ui-radio"><input type="radio" name="authtype" value="0" {if C("sys_auth_type")=="local"} checked{/if}><i></i>本地授权</label>';
			html+='</div>';
		$.dialogbox({
			title:"录入授权码",
			text:'<div class="ui-mb-15">当前域名：<span class="ui-text-red">{$domain}</span></div>'+html,
			inputval:'{C("BIZ_ID")}',
			type:2,
			width:'500px',
			mask:true,
			okval:'保存授权码',
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				var type=$("input[name='authtype']:checked").val();
				var code=e.inputval();
				$.ajax(
				{
					type:'post',
					cache:false,
					dataType:'json',
					url:'{THIS_LOCAL}',
					data:'type='+type+'&code='+code,
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
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
				})
			}
		})
	}
    $(function()
	{
		{if APP_DEMO}
		if(sdcms.getCookie("checkdemo")=='')
		{
			$.dialog(
			{
				title:"友情提示",
				am:'ui-am-slide-right',
				text:"您的账户权限为：只读。<div class='ui-text-red'>您所做的任何修改均不会生效！！！</div>",
				ok:function(e)
				{
					e.close();
					sdcms.setCookie("checkdemo",'1',1);
				},
				cancelshow:false
			});
		}
		{/if}
		$(".bizcode").click(function()
		{
			//关闭所有窗口
			$.dialogclose();
			editbiz();
		});
		$(".bind").click(function()
		{
			$.dialogbox(
			{
				title:"官网账号绑定",
				text:'{U("bind/index")}',
				width:'420px',
				height:'200px',
				type:3,
				oktheme:'ui-btn-info',
				okval:'绑定',
				ok:function(e)
				{
					e.iframe().contents().find("#sdcms-submit").click();
				}
				{if C('sys_uname')},cancelval:'解除绑定',
				cancel:function(e)
				{
					e.close();
					setTimeout(function()
					{
						$.dialog(
						{
							title:"操作提示",
							text:"确定要解除绑定？",
							oktheme:'ui-btn-info',
							ok:function(e)
							{
								$.ajax(
								{
									url:'{U("bind/clear")}',
									type:'post',
									dataType:'json',
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
					},500)
				}{/if}
			});
		});
        $(".user_base").hover(function()
		{
            $("ul",this).css("display","block");},
            function(){$("ul",this).css("display","none");
        });
		$("#offside-left").html($(".ui-west").html());
		$('.ui-collapse-menu-body li').bind('click',function()
		{
            $('.ui-collapse-menu-body li').removeClass('hover');
            $(this).addClass('hover');
        });
		//模拟滚动条
		$(".leftwarp").slimscroll({height:"auto",size:"5px",color:"#9CABC3",opacity:0.6,wheelStep:5,touchScrollStep:50})
        $(".ui-center").html('<iframe name="iframe_body" src="{U('right')}" width="100%" height="100%" frameborder="0"></iframe>');
		$(".other_left a").click(function()
		{
			if($(".ui-body").hasClass("ui-mobile"))
			{
				$(".ui-body").removeClass("ui-mobile");
			}
			else
			{
				$(".ui-body").addClass("ui-mobile");
			}
		})
		$(".editpass").click(function()
		{
			var url=$(this).data("url");
			$.dialogbox(
			{
				title:"修改密码",
				text:url,
				width:'550px',
				height:'230px',
				type:3,
				oktheme:'ui-btn-info',
				ok:function(e)
				{
					e.iframe().contents().find("#sdcms-submit").click();
				}
			});
		});
    })
    </script>
</body>
</html>