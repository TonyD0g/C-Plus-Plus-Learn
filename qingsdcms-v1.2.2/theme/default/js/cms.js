/*验证码点击*/
$("#verify_code").click(function()
{
	var src=$(this).attr("src");
	src+=((src.indexOf("?")>0)?'&':'?')+'&rnd='+Math.round();
	$(this).attr("src",src);
	$("#code").val("");
});

/*搜索为空检查*/
function checksearch(that)
{
	if($.trim(that.keyword.value)=='')
	{
		sdcms.warn('请输入关键字');
		return false;
	}
}

$(function()
{
	/*留言提交表单*/
	$(".ui-form-book").form(
	{
		type:2,
		align:'center',
		result:function(form)
		{
			var posturl=$(form).attr("action") || '';
			var backurl=$(form).data("backurl") || '';
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:posturl,
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){location.href=backurl;},1500);
					}
					else
					{
						$("#verify_code").click();
						sdcms.error(d.msg);
					}  
				}
			});
		}
	});
	
	/*分享点击*/
	$(".ui-show-share a").click(function()
	{
		var that=$(this);
		var type=that.data('share');
		var title=document.title;
		var desc=$('meta[name="description"]').length ? $('meta[name="description"]').attr("content"):"";
		var pic=$(".ui-show-body img:first").attr("src") || "";
		var url=document.URL;
		var gourl='';
		switch(type)
		{
			case "qq":
				gourl="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+url+"&title="+title+"&desc=&summary=&site=&pics="+pic;
				break;
			case "weibo":
				gourl="http://service.weibo.com/share/share.php?title="+title+"&url="+url+"&source=bookmark&pic="+pic;
				break;
		}
		if(gourl!='')
		{
			that.attr("href",gourl);
			that.attr("target","_blank");
		}
		else
		{
			$("#qrcode").remove();
			$.dialog(
			{
				title:"分享到微信",
				text:'<div class="ui-text-center"><div id="qrcode" style="width:300px;height:300px;margin:0 auto 15px auto;"></div><p>请打开【微信】，使用【扫一扫】完成分享。</p></div>',
				footer:false
			});
			$("#qrcode").qrcode({width:300,height:300,text:url}); 
		}
	});
	
	/*子栏目点击显示：手机站中使用*/
	$(".subnav").click(function()
	{
		if($(this).find("i").hasClass("ui-icon-folder-open"))
		{
			$(this).find("i").removeClass("ui-icon-folder-open");
		}
		else
		{
			$(this).find("i").addClass("ui-icon-folder-open");
		}
		$(".ui-subnav").slideToggle("slow");
	});
});

/*百度自动推送*/
(function()
{
    var bp=document.createElement('script');
    bp.src='https://zz.bdstatic.com/linksubmit/push.js';
    var s=document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp,s);
})();