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
    <div class="position">当前位置：扩展管理 > <a href="{U('index')}">字段管理</a> > <a href="{THIS_LOCAL}">添加字段</a></div>
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
                            <label class="col-left ui-col-form-label">字段用途：</label>
                            <div class="col-right">
                                <select name="mid" class="ui-form-ip" data-rule="字段用途:required;">
                                    <option value="">请选择字段用途</option>
                                    <option value="1"{if $mid==1} selected{/if}>栏目表</option>
                                    <option value="2"{if $mid==2} selected{/if}>内容表</option>
                                    <option value="3"{if $mid==3} selected{/if}>广告表</option>
                                </select>
                                <span class="input-tips">保存后不可以修改</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段名称：</label>
                            <div class="col-right">
                                <input type="text" name="t0" class="ui-form-ip" placeholder="请输入字段名称" data-rule="字段名称:required;">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段Key：</label>
                            <div class="col-right">
								<div class="ui-input-group">
                                	<input type="text" name="t1" class="ui-form-ip radius-right-none" placeholder="字母和数字的组合，长度3-50个字符" data-rule="字段Key:required;">
									<label class="ui-checkbox after"><input type="checkbox" name="prefix" value="1" checked><i></i>添加My前缀</label>
								</div>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段类型：</label>
                            <div class="col-right">
                                <select name="t2" id="t2" class="ui-form-ip" data-rule="字段类型:required;">
                                    <option value="">请选择字段类型</option>
                                    <option value="1">普通文本</option>
                                    <option value="2">普通文本-日期</option>
                                    <option value="3">普通文本-整数</option>
                                    <option value="4">普通文本-价格</option>
                                    <option value="5">普通文本-上传</option>
                                    <option value="6">普通文本-密码</option>
                                    <option value="7">普通文本-隐藏域</option>
                                    <option value="8">多行文本框</option>
                                    <option value="9">单选按钮</option>
                                    <option value="10">复选框</option>
                                    <option value="11">下拉列表</option>
                                    <option value="12">编辑器</option>
                                    <option value="13">图集</option>
                                    <option value="14">数据集</option>
                                    <option value="15">下载集</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段定义：</label>
                            <div class="col-right">
                                <div class="ui-input-group">
                                    <input type="text" name="t13" id="t13" class="ui-form-ip radius-right-none" data-rule="字段定义:required;">
                                    <select class="ui-form-ip after" id="after">
                                        <option value="">可选参数：</option>
                                        <option value="varchar(255) DEFAULT NULL">varchar(255) DEFAULT NULL</option>
                                        <option value="int(10) DEFAULT 0">int(10) DEFAULT 0</option>
                                        <option value="decimal(10,2) DEFAULT 0">decimal(10,2) DEFAULT 0</option>
                                        <option value="text">text</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="upload_type">
                            <label class="col-left ui-col-form-label">上传类型：</label>
                            <div class="col-right">
                                <select name="t3" class="ui-form-ip" data-rule="上传类型:required;">
                                    <option value="">请选择上传类型</option>
                                    <option value="1">只能上传图片</option>
                                    <option value="2">只能上传视频</option>
                                    <option value="3">全部都可以上传</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="editor_type">
                            <label class="col-left ui-col-form-label">编辑器模式：</label>
                            <div class="col-right">
                                <select name="t4" class="ui-form-ip" data-rule="编辑器模式:required;">
                                    <option value="">请选择编辑器模式</option>
                                    <option value="1">精简模式</option>
                                    <option value="2">全功能模式</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="listval">
                            <label class="col-left ui-col-form-label">候选值：</label>
                            <div class="col-right">
                                <textarea name="t5" class="ui-form-ip" rows="5" cols="50" data-rule="候选值:required;"></textarea>
                                <span class="gray">示范：项目名称1|项目值1<br>　　　项目名称2|项目值2</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="field_radio">
                            <label class="col-left ui-col-form-label">排列方式：</label>
                            <div class="col-right col-right-top">
                                <label class="ui-radio"><input type="radio" name="t6" id="t6_1" value="1" checked><i></i>横排</label>
                                <label class="ui-radio"><input type="radio" name="t6" id="t6_2" value="2"><i></i>竖排</label>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">数据表：</label>
                            <div class="col-right">
                                <input type="text" name="t14" class="ui-form-ip" data-rule="数据表:required;"><span class="input-tips">示范：cms_show</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Join参数：</label>
                            <div class="col-right">
                                <input type="text" name="t15" class="ui-form-ip"><span class="input-tips">可以为空，示范：left join cms_show on cms_data.cid=cms_show.id</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Where参数：</label>
                            <div class="col-right">
                                <input type="text" name="t16" class="ui-form-ip"><span class="input-tips">可以为空，示范：isshow=1</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Order参数：</label>
                            <div class="col-right">
                                <input type="text" name="t17" class="ui-form-ip"><span class="input-tips">可以为空，示范：id desc</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">项目值：</label>
                            <div class="col-right">
                                <input type="text" name="t18" class="ui-form-ip" data-rule="项目值:required;"><span class="input-tips">示范：id</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">项目标签：</label>
                            <div class="col-right">
                                <input type="text" name="t19" class="ui-form-ip" data-rule="项目标签:required;"><span class="input-tips">示范：title</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="maxlength">
                            <label class="col-left ui-col-form-label">最大输入长度：</label>
                            <div class="col-right">
                                <input type="text" name="t7" class="ui-form-ip" value="0"><span class="input-tips">0-255，为0时表示不限制</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">默认值：</label>
                            <div class="col-right">
                                <input type="text" name="t8" class="ui-form-ip">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">提示文字：</label>
                            <div class="col-right">
                                <input type="text" name="t9" class="ui-form-ip">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">验证规则：</label>
                            <div class="col-right">
                                <select name="t10" class="ui-form-ip" >
                                    <option value="0">不验证</option>
                                    <option value="1">不能为空</option>
                                    <option value="2">日期格式</option>
                                    <option value="3">整数格式</option>
                                    <option value="4">小数格式</option>
                                    <option value="5">电话格式</option>
                                    <option value="6">手机格式</option>
                                    <option value="7">邮箱</option>
                                    <option value="8">邮编格式</option>
                                    <option value="9">QQ号码格式</option>
                                    <option value="10">网址格式</option>
                                    <option value="11">用户名</option>
                                    <option value="12">密码</option>
                                    <option value="13">身份证</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段排序：</label>
                            <div class="col-right">
                                <input type="text" name="t11" class="ui-form-ip" value="0">
                                <span class="input-tips">数字越小越靠前</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">状态：</label>
                            <div class="col-right col-right-top">
                                <label class="ui-radio"><input type="radio" name="t12" value="1" checked><i></i>正常</label>
                                <label class="ui-radio"><input type="radio" name="t12" value="0"><i></i>隐藏</label>
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
            case "1":
            case "6":
            case "7":
                $("#upload_type,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#maxlength").removeClass("dis");
                $("#t13").val("varchar(255) DEFAULT NULL");
                break;
            case "2":
            case "3":
                $("#upload_type,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#maxlength").removeClass("dis");
                $("#t13").val("int(10) DEFAULT 0");
                break;
            case "4":
                $("#upload_type,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#maxlength").removeClass("dis");
                $("#t13").val("decimal(10,2) DEFAULT 0");
                break;
            case "5":
                $("#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#upload_type,#maxlength").removeClass("dis");
                $("#t13").val("varchar(255) DEFAULT NULL");
                break;
            case "8":
			case "13":
                $("#upload_type,#maxlength,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#t13").val("text");
                break;
            case "9":
                $("#upload_type,#maxlength,#editor_type,.field_data").addClass("dis");
                $("#listval,#field_radio").removeClass("dis");
                $("#t13").val("varchar(255) DEFAULT NULL");
                break;
            case "10":
				$("#upload_type,#maxlength,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#listval").removeClass("dis");
                $("#t13").val("varchar(255) DEFAULT NULL");
                break;
            case "11":
                $("#upload_type,#maxlength,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#listval").removeClass("dis");
                $("#t13").val("int(10) DEFAULT 0");
                break;
            case "12":
                $("#upload_type,#maxlength,#field_radio,#listval,.field_data").addClass("dis");
                $("#editor_type").removeClass("dis");
                $("#t13").val("text");
                break;
			case "14":
                $("#upload_type,#listval,#field_radio,#editor_type,#maxlength").addClass("dis");
				$(".field_data").removeClass("dis");
                $("#t13").val("int(10) DEFAULT 0");
                break;
			case "15":
                $("#listval,#field_radio,#editor_type,.field_data,#maxlength").addClass("dis");
                $("#upload_type").removeClass("dis");
                $("#t13").val("text");
                break;
            default:
                $("#upload_type,#maxlength,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
                $("#t13").val("");
                break;
        }
    });
	$("#after").change(function()
	{
		if($(this).val()!='')
		{
			$("#t13").val($(this).val());
		} 
    });
	$(".ui-form").form(
	{
		type:2,
		align:'top-right',
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
                       	setTimeout(function(){location.href='{U("index","mid=".$mid."")}';},1500);
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