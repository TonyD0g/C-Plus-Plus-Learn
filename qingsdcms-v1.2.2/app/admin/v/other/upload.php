<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>本地上传</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<link rel="stylesheet" href="{WEB_ROOT}public/upload/css/style.css" />
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_ROOT}public/admin/js/base.js"></script>
</head>

<body class="ui-p-10">

<div class="ui-tabs ui-tabs-white" data-href="1">
	<ul class="ui-tabs-nav">
	  <li><a href="{U('imagelist','multiple='.$multiple.'&type='.$type.'&gid=0&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}">附件选择</a></li>
	  <li class="active"><a href="javascript:;">本地上传</a></li>
	</ul>
	<div class="ui-tabs-content">
		<div class="ui-tabs-pane active">
			<!--loop-->
			<div id="wrapper">
    
				<div id="container">
					<div id="uploader">
						<div class="statusBar" style="display:none;">
							<div class="progress">
								<span class="text">0%</span>
								<span class="percentage"></span>
							</div><div class="info"></div>
							<div class="btns">
								<div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
							</div>
						</div>
						<div class="queueList">
							<div id="dndArea" class="placeholder">
                            
                            	<div class="ui-form-group" style="max-width:420px;margin:20px auto;">
                                    <div class="ui-input-group">
                                        <span class="before">上传至：</span>
                                        <select name="gid" class="ui-form-ip radius-none">
                                            <option value="0">未分组</option>
                                            {cms:rs top="0" table="cms_file_group" where="isshow=1" order="ordnum,aid"}
                                            <option value="{$rs[aid]}"{if $gid==$rs[aid]} selected{/if}>{$rs[gname]}</option>
                                            {/cms:rs}
                                        </select>
                                        <div class="after" id="filePicker"></div>
                                    </div>
                                </div>
								<p>也可以将文件拖到这里，最多上传<code>{if $multiple==1}50{else}1{/if}</code>个文件 <a href="javascript:;" class="add-iframe ui-btn ui-btn-sm ui-ml">添加分组</a></p>
							</div>
						</div>
					</div>
				</div>
		
			</div>
			<!--loop-->
		</div>
	</div>
</div>
<input type="hidden" id="piclist">
<input type="hidden" id="gourl" value="0">
<script>
$(function()
{
	$("select[name=gid]").change(function()
	{
		var gid=$(this).find("option:selected").val();
		$("#gourl").val(gid);
	});
	$(".add-iframe").click(function()
	{
		$.dialogbox(
		{
			title:"添加分组",
			inputval:"",
			inputholder:"请输入分组名称",
			type:1,
			ok:function(e)
			{
				var val=e.inputval();
				if(val=='')
				{
					sdcms.error("分组名称不能为空");
				}
				else
				{
					$.ajax(
					{
						url:'{U("addgroup")}',
						type:'post',
						dataType:'json',
						data:"token={$token}&name="+encodeURIComponent(val),
						error:function(e){alert(e.responseText);},
						success:function(d)
						{
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
			}
		});
	});
})
var up_max={cms[upload_file_max]};
var up_limit={if $multiple==1}50{else}1{/if};
var up_server="{U('upload/upfile','type='.$type.'&gid='.$gid.'&iseditor='.$iseditor.'&islocal='.$islocal.'&thumb='.$thumb.'&water='.$water.'')}";
var token='{$token}';
</script>
<script src="{WEB_ROOT}public/upload/js/webuploader.js"></script>
<script src="{WEB_ROOT}public/upload/js/upload.js"></script>
</body>
</html>