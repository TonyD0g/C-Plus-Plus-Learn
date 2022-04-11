function unique(arr)
{
	return arr.filter(function(item,index,arr)
	{
		return arr.indexOf(item, 0) === index;
	});
}

function gettag(str)
{
	var arr=str.toString().split(",");
	var data=[];
	var j=0;
	for(i=0;i<arr.length;i++)
	{
		if(j<5)
		{
			data.push(arr[i]);
		}
		j++;
	}
	return data.join(',');
}

$(function()
{
	$(document).on("click",".imagelist .img-left",function()
	{
		var $li=$(this).parent().parent();
		console.log($li)
		var $pre=$li.prev("li");
		$pre.insertAfter($li)
	})
	$(document).on("click",".imagelist .img-right",function()
	{
		var $li=$(this).parent().parent();
		var $next=$li.next("li");
		$next.insertBefore($li);
	});
	$(document).on("click",".imagelist .img-del",function()
	{
		$(this).parent().parent().remove();
	});
	$(document).on("click",".spec-prev",function()
	{
		var $li=$(this).parent().parent();
		var $pre=$li.prev("tr");
		$pre.insertAfter($li)
	});
	$(document).on("click",".down-prev",function()
	{
		var $li=$(this).parent().parent();
		var $pre=$li.prev("tr");
		$pre.insertAfter($li)
	});
	$(document).on("click",".down-next",function()
	{
		var $li=$(this).parent().parent();
		var $next=$li.next("tr");
		$next.insertBefore($li);
	});
	$(document).on("click",".down-del",function()
	{
		$(this).parent().parent().remove();
	});
	$(document).on("click",".spec-next",function()
	{
		var $li=$(this).parent().parent();
		var $next=$li.next("tr");
		$next.insertBefore($li);
	});
	$(document).on("click",".spec-del",function()
	{
		if($("#datalist tr").length==1)
		{
			sdcms.error('至少填写一个候选值');
		}
		else
		{
			$(this).parent().parent().remove();
		}	
	});
	$(document).on("click",".price-del",function()
	{
		$(this).parent().parent().remove();
	});
	$(document).on("click",".fm-choose",function()
	{
		var name=$(this).data("name");
		var url=$(this).data("url");
		var type=$(this).data("type");
		var multiple=$(this).data("multiple");
		var placeholer=$(this).data("replace");
		var spec=$(this).data("spec");
		var that=this;
		$.dialogbox(
		{
			'title':"附件选择",
			'text':url,
			'width':'80%',
			'height':'80%',
			'type':3,
			'oktheme':'ui-btn-info',
			'ok':function(e)
			{
				var data=e.iframe().contents().find("#piclist").val();
				if(data=='')
				{
					sdcms.error('请至少选择一个文件');
					return false;
				}
				else
				{
					if(multiple==0)
					{
						if(name=='preview')
						{
							$(that).closest(".preview").find("input").val(data);
							$(that).closest(".preview").find("img").attr("src",data);
						}
						else
						{
							$("#"+name).val(data);
							if(placeholer!='undefined')
							{
								$("."+placeholer).html('<img src='+data+'>');
							}
							if(spec!='undefined')
							{
								$("#"+name).closest(".uploadspec").find(".upload_action").addClass("hide");
								$("#"+name).closest(".uploadspec").find(".upload_image").attr("src",data);
								$("#"+name).closest(".uploadspec").find(".pre").removeClass("hide");
							}
						}
					}
					else if(multiple==1)
					{
						var pic=data.split("|");
						for(i=0;i<pic.length;i++)
						{
							var url=pic[i];
							var num=1;
							$("#list_"+name+" li").each(function()
							{
								var maxnum=parseInt($(this).attr("num"));
								if (maxnum>=num)
								{
									num=maxnum+1;
								}
							});
							var html='';
							html+='<li num="'+num+'">';
							html+='	<div class="preview">';
							html+='		<input type="hidden" name="'+name+'['+num+'][image]" value="'+url+'">';
							html+='		<u href="'+url+'" class="ui-lightbox"><img src="'+url+'" /></u>';
							html+='	</div>';
							html+='	<div class="intro">';
							html+='		<textarea name="'+name+'['+num+'][desc]" class="ui-form-ip" placeholder="图片描述..."></textarea>';
							html+='	</div>';
							html+='	<div class="action"><a href="javascript:;" class="img-left"><i class="ui-icon-left"></i>左移</a><a href="javascript:;" class="img-right"><i class="ui-icon-right"></i>右移</a><a href="javascript:;" class="img-del"><i class="ui-icon-delete"></i>删除</a></div>';
							html+='</li>';
							$("#list_"+name).append(html);
							Sortable.create($("#list_"+name)[0],{animation:400});
						}
					}
					else
					{
						var pic=data.split("|");
						for(i=0;i<pic.length;i++)
						{
							var url=pic[i];
							var num=1;
							$("#downlist_"+name+" tr").each(function()
							{
								var maxnum=parseInt($(this).attr("num"));
								if (maxnum>=num)
								{
									num=maxnum+1;
								}
							});
							var html='';
							html+='<tr num="'+num+'">';
							html+='    <td><input type="text" name="'+name+'['+num+'][name]" id="'+name+'_name_'+num+'" value="下载地址'+num+'" class="ui-form-ip" data-rule="名称:required;">';
							html+='    <td><input type="text" name="'+name+'['+num+'][url]" id="'+name+'_url_'+num+'" value="'+url+'" class="ui-form-ip" data-rule="下载地址:required;">';
							html+='    <td>';
							html+='        <a href="javascript:;" class="down-prev ui-mr-sm"><i class="ui-icon-up"></i>上移</a>';
							html+='        <a href="javascript:;" class="down-next ui-mr-sm"><i class="ui-icon-down"></i>下移</a>';
							html+='        <a href="javascript:;" class="down-del"><i class="ui-icon-delete"></i>删除</a>';
							html+='    </td>';
							html+='</tr>';
							$("#downlist_"+name).append(html);
						}
					}
					e.close();
				};
			}
		});
	});
	$(".fm-tags").click(function()
	{
		var name=$(this).attr("data-name");
		var url=$(this).attr("data-url");
		$.dialogbox(
		{
			'title':"标签选择",
			'text':url,
			'width':'550px',
			'height':'300px',
			'type':3,
			'oktheme':'ui-btn-info',
			'ok':function(e)
			{
				var data=e.iframe().contents().find("#taglist").val();
				if(data=='')
				{
					sdcms.error('请至少选择一个标签');
					return false;
				}
				else
				{
					var old=$("#"+name).val();
					var tags=data;
					var str='';
					if(old=='')
					{
						str=data;
					}
					else
					{
						str=data+','+old;
					}
					$("#"+name).val(gettag(unique(str.split(','))));
					e.close();
				}
			}
		});
	});
	$(".fm-choose-ad").click(function()
	{
		var name=$(this).attr("data-name");
		var url=$(this).attr("data-url");
		var type=$(this).attr("data-type");
		var multiple=$(this).attr("data-multiple");
		$.dialogbox(
		{
			'title':"附件选择",
			'text':url,
			'width':'80%',
			'height':'80%',
			'type':3,
			'oktheme':'ui-btn-info',
			'ok':function(e)
			{
				var data=e.iframe().contents().find("#piclist").val();
				if(data=='')
				{
					sdcms.error('请至少选择一个文件',{'icon':5});
					return false;
				}
				else
				{
					if(multiple==0)
					{
						$("#"+name).val(data);
						if(placeholer!='undefined')
						{
							$("."+placeholer).html('<img src='+data+'>');
						}
					}
					else
					{
						var pic=data.split("|");
						for(i=0;i<pic.length;i++)
						{
							var url=pic[i];
							var num=1;
							$("#list_"+name+" li").each(function()
							{
								var maxnum=parseInt($(this).attr("num"));
								if(maxnum>=num)
								{
									num=maxnum+1;
								}
							});
							var html='';
							html+='<li num="'+num+'">';
							html+='	<div class="preview">';
							html+='		<input type="hidden" name="'+name+'['+num+'][image]" value="'+url+'">';
							html+='		<img src="'+url+'" />';
							html+='	</div>';
							html+='	<div class="intro">';
							html+='		<textarea name="'+name+'['+num+'][desc]" class="ui-form-ip" placeholder="请输入描述..."></textarea>';
							html+='	</div>';
							html+='	<div class="intro">';
							html+='		<textarea name="'+name+'['+num+'][url]" class="ui-form-ip" placeholder="请输入链接网址..."></textarea>';
							html+='	</div>';
							html+='	<div class="action"><a href="javascript:;" class="img-left"><i class="ui-icon-left"></i>左移</a><a href="javascript:;" class="img-right"><i class="ui-icon-right"></i>右移</a><a href="javascript:;" class="img-del"><i class="ui-icon-delete"></i>删除</a></div>';
							html+='</li>';
							$("#list_"+name).append(html);
							Sortable.create($("#list_"+name)[0],{animation:400});
						}
					}
					e.close();
				}
			}
		});

	});
	$(".downlistadd").click(function()
	{
		var name=$(this).attr("data-name");
		var num=1;
		$("#downlist_"+name+" tr").each(function()
		{
			var max=parseInt($(this).attr("num"));
			if (max>=num)
			{
				num=max+1;
			}
		});
		var html='';					
		html+='<tr num="'+num+'">';
		html+='    <td><input type="text" name="'+name+'['+num+'][name]" id="'+name+'_name_'+num+'" value="下载地址'+num+'" class="ui-form-ip" data-rule="名称:required;">';
		html+='    <td><input type="text" name="'+name+'['+num+'][url]" id="'+name+'_url_'+num+'" class="ui-form-ip" data-rule="下载地址:required;">';
		html+='    <td>';
		html+='        <a href="javascript:;" class="down-prev mr-sm"><i class="ui-icon-up"></i>上移</a>';
		html+='        <a href="javascript:;" class="down-next mr-sm"><i class="ui-icon-down"></i>下移</a>';
		html+='        <a href="javascript:;" class="down-del"><i class="ui-icon-delete"></i>删除</a>';
		html+='    </td>';
		html+='</tr>';
		$("#downlist_"+name+"").append(html);
	});
	$(".template").click(function()
	{
		var name=$(this).attr("data-name");
		var url=$(this).attr("data-url");
		$.dialogbox(
		{
			'title':"模板选择",
			'text':url,
			'width':'60%',
			'height':'60%',
			'type':3,
			'oktheme':'ui-btn-info',
			'ok':function(e)
			{
				var data=e.iframe().contents().find("#go").val();
				if(data=='')
				{
					sdcms.error('请选择模板');
					return false;
				}
				else
				{
					$("#"+name).val(data);
					e.close();
				}
			}
		});
	});

	$(".editor_savepic").click(function()
	{
		var name=$(this).data("name");
		var url=$(this).data("url");
		var token=$(this).data("token");
		var ue=UE.getEditor(name);
		var data=ue.getContent();
		var that=this;
		$(this).val("处理中...");
		$.ajax(
		{
			url:url,
			type:'post',
			data:'token='+token+'&content='+encodeURIComponent(data),
			error:function(){alert(e.responseText)},
			success:function(d)
			{
				ue.setContent(d);
				$(that).val("处理完成");
				setTimeout(function(){$(that).val("保存编辑器中外部图片")},3000)
			}
		});
	});
});

function ueditorimage(editor,url,webroot)
{
	$.dialogbox(
	{
		'title':"附件选择",
		'text':url,
		'width':'80%',
		'height':'80%',
		'type':3,
		'oktheme':'ui-btn-info',
		'ok':function(e)
		{
			var data=e.iframe().contents().find("#piclist").val();
			editor.focus();
			if(data!='')
			{
				var html='';
				var pic=data.split("|");
				for(i=0;i<pic.length;i++)
				{
					var type=pic[i].substr(pic[i].lastIndexOf('.') + 1).toLowerCase();
					var name=pic[i].substr(pic[i].lastIndexOf('/') + 1);
					if("png|jpg|jpeg|gif".indexOf(type)!=-1)
					{
						html+='<img src="'+pic[i]+'">';
					}
					else if("mp4".indexOf(type)!=-1)
					{
						html+='<video width="550" height="400" src="'+pic[i]+'" controls="controls"></video>';
					}
					else
					{
						html+='<img src="'+webroot+'public/ueditor/dialogs/attachment/fileTypeImages/icon_'+type+'.gif"> <a href="'+pic[i]+'" target="_blank">'+name+'</a>';
					}
				}
				editor.execCommand('inserthtml',html);
			}
			e.close();
		}
	});
}