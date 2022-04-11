<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>添加字段</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
	<div class="position">当前位置：系统管理 > <a href="{U('configgroup/index')}">设置分组</a> > <a href="{U('index',"gid=".$gid."")}">字段管理</a> > <a href="{THIS_LOCAL}">添加字段</a></div>
    <div class="borders">
        <!---->
        <div class="ui-tabs ui-tabs-white" data-href="1">
            <ul class="ui-tabs-nav">
              <li class="active"><a href="{THIS_LOCAL}">添加字段</a></li>
            </ul>
            <div class="ui-tabs-content">
                <div class="ui-tabs-pane active">
                <!--loop-->
                <form class="ui-form" method="post">
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">字段名称：</label>
                        <div class="col-right">
                            <input type="text" name="t0" class="ui-form-ip" placeholder="请输入字段名称" data-rule="字段名称:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">字段Key：</label>
                        <div class="col-right">
                            <input type="text" name="t1" class="ui-form-ip" placeholder="字母和数字的组合，长度3-50个字符" data-rule="字段Key:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">字段类型：</label>
                        <div class="col-right">
                            <select name="t2" id="t2" class="ui-form-ip" data-rule="字段名称:required;">
                                <option value="">请选择字段类型</option>
                                <option value="1">普通文本</option>
                                <option value="2">普通文本-密码</option>
                                <option value="4">普通文本-上传</option>
                                <option value="5">多行文本框</option>
                                <option value="6">单选按钮</option>
                                <option value="7">复选框</option>
                                <option value="8">下拉列表</option>
                                <option value="9">间隔标题</option>
                            </select>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row dis" id="list">
                        <label class="col-left ui-col-form-label">候选值：</label>
                        <div class="col-right">
                            <textarea name="t3" rows="5" class="ui-form-ip"></textarea>
                            <span class="input-tips">示范：项目名称1|项目值1<br>　　　项目名称2|项目值2</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row dis" id="upload_type">
                        <label class="col-left ui-col-form-label">上传类型：</label>
                        <div class="col-right">
                            <select name="t8" class="ui-form-ip" data-rule="上传类型:required;">
                                <option value="">请选择上传类型</option>
                                <option value="1">只能上传图片</option>
                                <option value="2">只能上传视频</option>
                                <option value="3">全部都可以上传</option>
                            </select>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">提示文字：</label>
                        <div class="col-right">
                            <input type="text" name="t4" class="ui-form-ip">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">字段排序：</label>
                        <div class="col-right">
                            <input type="text" name="t5" class="ui-form-ip" value="0">
                            <span class="input-tips">数字越小越靠前</span>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row dis" id="showway">
                        <label class="col-left ui-col-form-label">排列方式：</label>
                        <div class="col-right col-right-top">
                            <label class="ui-radio"><input type="radio" name="t6" id="t6_1" value="1" checked><i></i>横排</label>
                            <label class="ui-radio"><input type="radio" name="t6" id="t6_2" value="2"><i></i>竖排</label>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label">状态：</label>
                        <div class="col-right col-right-top">
                            <label class="ui-radio"><input type="radio" name="t7" id="t7_1" value="1" checked><i></i>正常</label>
                            <label class="ui-radio"><input type="radio" name="t7" id="t7_2" value="0"><i></i>锁定</label>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="col-left ui-col-form-label"></label>
                        <div class="col-right">
                        	<input type="hidden" name="token" value="{$token}">
                            <button type="submit" class="ui-btn ui-btn-info ui-mr">保存</button>
                            <button type="button" class="ui-btn ui-back">返回</button>
                        </div>
                    </div>
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
	$("#t2").change(function()
	{
        switch ($(this).val())
        {
			case "4":
				$("#upload_type").removeClass("dis");
				$("#list,#showway").addClass("dis");
				break;
			case "7":
			case "8":
			 	$("#list").removeClass("dis");
				$("#showway,#upload_type").addClass("dis");
                break;
            case "6":
                $("#list,#showway").removeClass("dis");
				$("#upload_type").addClass("dis");
                break;
            default:
                $("#list,#showway,#upload_type").addClass("dis");
                break;
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
                        setTimeout(function(){location.href='{U("index","gid=".$gid."")}';},1500);
                    }
                    else
                    {
                        sdcms.error(d.msg);
                    }
                }
            });
		}
	});
})
</script>
</body>
</html>