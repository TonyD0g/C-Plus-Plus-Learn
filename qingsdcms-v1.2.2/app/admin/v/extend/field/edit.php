<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>编辑字段</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
</head>

<body>
    <div class="position">当前位置：扩展管理 > <a href="{U('index')}">字段管理</a> > <a href="{THIS_LOCAL}">编辑字段</a></div>
    <div class="borders">
        <!---->
        
        <div class="ui-tabs ui-tabs-white" data-href="1">
            <ul class="ui-tabs-nav">
              <li class="active"><a href="{THIS_LOCAL}">编辑字段</a></li>
            </ul>
            <div class="ui-tabs-content">
                <div class="ui-tabs-pane active">
                    <!--loop-->
                    <form class="ui-form" method="post">
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段名称：</label>
                            <div class="col-right">
                                <input type="text" name="t0" class="ui-form-ip" value="{$field_title}" placeholder="请输入字段名称" data-rule="字段名称:required;">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段Key：</label>
                            <div class="col-right">
                                <input type="text" name="t1" class="ui-form-ip" value="{$field_key}" disabled="disabled">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段类型：</label>
                            <div class="col-right">
                                <select name="t2" class="ui-form-ip" data-rule="字段类型:required;" disabled>
                                    <option value="">请选择字段类型</option>
                                    <option value="1"{if $field_type==1} selected{/if}>普通文本</option>
                                    <option value="2"{if $field_type==2} selected{/if}>普通文本-日期</option>
                                    <option value="3"{if $field_type==3} selected{/if}>普通文本-整数</option>
                                    <option value="4"{if $field_type==4} selected{/if}>普通文本-价格</option>
                                    <option value="5"{if $field_type==5} selected{/if}>普通文本-上传</option>
                                    <option value="6"{if $field_type==6} selected{/if}>普通文本-密码</option>
                                    <option value="7"{if $field_type==7} selected{/if}>普通文本-隐藏域</option>
                                    <option value="8"{if $field_type==8} selected{/if}>多行文本框</option>
                                    <option value="9"{if $field_type==9} selected{/if}>单选按钮</option>
                                    <option value="10"{if $field_type==10} selected{/if}>复选框</option>
                                    <option value="11"{if $field_type==11} selected{/if}>下拉列表</option>
                                    <option value="12"{if $field_type==12} selected{/if}>编辑器</option>
                                    <option value="13"{if $field_type==13} selected{/if}>图集</option>
                                    <option value="14"{if $field_type==14} selected{/if}>数据集</option>
                                    <option value="15"{if $field_type==15} selected{/if}>下载集</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="upload_type">
                            <label class="col-left ui-col-form-label">上传类型：</label>
                            <div class="col-right">
                                <select name="t3" class="ui-form-ip" data-rule="上传类型:required;">
                                    <option value="">请选择上传类型</option>
                                    <option value="1"{if $field_upload_type==1} selected{/if}>只能上传图片</option>
                                    <option value="2"{if $field_upload_type==2} selected{/if}>只能上传视频</option>
                                    <option value="3"{if $field_upload_type==3} selected{/if}>全部都可以上传</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="editor_type">
                            <label class="col-left ui-col-form-label">编辑器模式：</label>
                            <div class="col-right">
                                <select name="t4" class="ui-form-ip" data-rule="编辑器模式:required;">
                                    <option value="">请选择编辑器模式</option>
                                    <option value="1"{if $field_editor==1} selected{/if}>精简模式</option>
                                    <option value="2"{if $field_editor==2} selected{/if}>全功能模式</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="listval">
                            <label class="col-left ui-col-form-label">候选值：</label>
                            <div class="col-right">
                                <textarea name="t5" class="ui-form-ip" rows="5" cols="50" data-rule="候选值:required;">{$field_list}</textarea>
                                <span class="gray">示范：项目名称1|项目值1<br>　　　项目名称2|项目值2</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="field_radio">
                            <label class="col-left ui-col-form-label">排列方式：</label>
                            <div class="col-right col-right-top">
                                <label class="ui-radio"><input type="radio" name="t6" id="t6_1" value="1" {if $field_radio==1} checked{/if}><i></i>横排</label>
                                <label class="ui-radio"><input type="radio" name="t6" id="t6_2" value="2" {if $field_radio==2} checked{/if}><i></i>竖排</label>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">数据表：</label>
                            <div class="col-right">
                                <input type="text" name="t13" class="ui-form-ip" value="{$field_table}" data-rule="数据表:required;"><span class="input-tips">示范：cms_show</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Join参数：</label>
                            <div class="col-right">
                                <input type="text" name="t14" class="ui-form-ip" value="{$field_join}"><span class="input-tips">可以为空，示范：left join cms_show on cms_data.cid=cms_show.id</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Where参数：</label>
                            <div class="col-right">
                                <input type="text" name="t15" class="ui-form-ip" value="{$field_where}"><span class="input-tips">可以为空，示范：isshow=1</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">Order参数：</label>
                            <div class="col-right">
                                <input type="text" name="t16" class="ui-form-ip" value="{$field_order}"><span class="input-tips">可以为空，示范：id desc</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">项目值：</label>
                            <div class="col-right">
                                <input type="text" name="t17" class="ui-form-ip" value="{$field_value}" data-rule="项目值:required;"><span class="input-tips">示范：id</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row field_data dis">
                            <label class="col-left ui-col-form-label">项目标签：</label>
                            <div class="col-right">
                                <input type="text" name="t18" class="ui-form-ip" value="{$field_label}" data-rule="项目标签:required;"><span class="input-tips">示范：title</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row dis" id="maxlength">
                            <label class="col-left ui-col-form-label">最大输入长度：</label>
                            <div class="col-right">
                                <input type="text" name="t7" class="ui-form-ip" value="{$field_length}"><span class="input-tips">0-255，为0时表示不限制</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">默认值：</label>
                            <div class="col-right">
                                <input type="text" name="t8" class="ui-form-ip" value="{$field_default}">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">提示文字：</label>
                            <div class="col-right">
                                <input type="text" name="t9" class="ui-form-ip" value="{$field_tips}">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">验证规则：</label>
                            <div class="col-right">
                                <select name="t10" class="ui-form-ip" >
                                    <option value="0"{if $field_rule==0} selected{/if}>不验证</option>
                                    <option value="1"{if $field_rule==1} selected{/if}>不能为空</option>
                                    <option value="2"{if $field_rule==2} selected{/if}>日期格式</option>
                                    <option value="3"{if $field_rule==3} selected{/if}>整数格式</option>
                                    <option value="4"{if $field_rule==4} selected{/if}>小数格式</option>
                                    <option value="5"{if $field_rule==5} selected{/if}>电话格式</option>
                                    <option value="6"{if $field_rule==6} selected{/if}>手机格式</option>
                                    <option value="7"{if $field_rule==7} selected{/if}>邮箱</option>
                                    <option value="8"{if $field_rule==8} selected{/if}>邮编格式</option>
                                    <option value="9"{if $field_rule==9} selected{/if}>QQ号码格式</option>
                                    <option value="10"{if $field_rule==10} selected{/if}>网址格式</option>
                                    <option value="11"{if $field_rule==11} selected{/if}>用户名</option>
                                    <option value="12"{if $field_rule==12} selected{/if}>密码</option>
                                    <option value="13"{if $field_rule==13} selected{/if}>身份证</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">字段排序：</label>
                            <div class="col-right">
                                <input type="text" name="t11" class="ui-form-ip" value="{$ordnum}">
                                <span class="input-tips">数字越小越靠前</span>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="col-left ui-col-form-label">状态：</label>
                            <div class="col-right col-right-top">
                                <label class="ui-radio"><input type="radio" name="t12" id="t12_1" value="1" {if $isshow==1} checked{/if}><i></i>正常</label>
                                <label class="ui-radio"><input type="radio" name="t12" id="t12_2" value="0" {if $isshow==0} checked{/if}><i></i>锁定</label>
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
    {if $field_type==1||$field_type==2||$field_type==3||$field_type==4||$field_type==6||$field_type==7}
    $("#upload_type,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
    $("#maxlength").removeClass("dis");
    {elseif $field_type==5}
    $("#listval,#field_radio,#editor_type,.field_data").addClass("dis");
    $("#upload_type,#maxlength").removeClass("dis");
    {elseif $field_type==9}
    $("#upload_type,#maxlength,#editor_type,.field_data").addClass("dis");
    $("#listval,#field_radio").removeClass("dis");
    {elseif $field_type==10}
    $("#upload_type,#maxlength,#field_radio,#editor_type,.field_data").addClass("dis");
    $("#listval").removeClass("dis");
	{elseif $field_type==11}
    $("#upload_type,#maxlength,#field_radio,#editor_type,.field_data").addClass("dis");
    $("#listval").removeClass("dis");
    {elseif $field_type==12}
    $("#upload_type,#maxlength,#field_radio,#listval,.field_data").addClass("dis");
    $("#editor_type").removeClass("dis");
	{elseif $field_type==14}
	$("#upload_type,#listval,#field_radio,#editor_type,#maxlength").addClass("dis");
	$(".field_data").removeClass("dis");
	{elseif $field_type==15}
	$("#listval,#field_radio,#editor_type,.field_data,#maxlength").addClass("dis");
	$("#upload_type").removeClass("dis");
    {else}
    $("#upload_type,#maxlength,#listval,#field_radio,#editor_type,.field_data").addClass("dis");
    {/if}
	
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