<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>内容管理</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/layout.css">
<link rel="stylesheet" href="{WEB_ROOT}public/ztree/css/zTreeStyle.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/ztree/jquery.ztree.core-3.5.min.js"></script>
<script src="{WEB_ROOT}public/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script>
var setting={check:{enable:true,chkStyle:"radio",radioType:"all"},data:{simpleData:{enable:true}},callback:{onCheck:onCheck}};
var zNodes=[
{foreach $cate as $index=>$key}
{id:{$index},pId:{$key['followid']},name:"{$key['cate_name']}",open:true{if get_sonid_num($key['cateid'])!=0 || $key['cate_type']<0 || $key['cateid']==$classid},chkDisabled:true{/if}},
{/foreach}
];
function onCheck(e,treeId,treeNode)
{
	$("#go").attr("value",treeNode.id);
}
$(function(){
$.fn.zTree.init($("#ztree"),setting,zNodes);
})
</script>
</head>

<body class="bg_white">
    <div class="border_iframe">
        <p class="ui-mb"><strong>目标栏目：</strong></p>
        <input type="hidden" name="token" id="token" value="{$token}">
        <input type="hidden" name="go" id="go" value="">
        <ul id="ztree" class="ztree"></ul>
    </div>
</body>
</html>