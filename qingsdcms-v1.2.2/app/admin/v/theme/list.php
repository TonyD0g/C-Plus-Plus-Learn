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
    <div class="position">当前位置：模板插件 > <a href="{U('index')}">模板管理</a>{$position} > <a href="{THIS_LOCAL}">模板列表</a></div>
    <div class="border">
        <!---->
        <div class="ui-table-wrap">
    	<table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb">
            <thead class="ui-thead-gray">
                <tr>
                	<th width="20"></th>
                    <th>名称</th>
                    <th width="300">说明</th>
                    <th width="150">大小</th>
                    <th width="180">修改时间</th>
                </tr>
            </thead>
            <tbody>
            {foreach $folder as $key=>$val}
            {if !(in_array($val[0],['block']))}
            <tr>
                <td><span class="ui-icon-folder ui-text-yellow"></span></td>
                <td class="ui-text-left"><a href="{U('lists','root='.$val[2].'')}">{$val[0]}</a></td>
                <td></td>
                <td></td>
                <td>{date('Y-m-d H:i:s',$val[1])}</td>
            </tr>
            {/if}
            {/foreach}
            {foreach $file as $key=>$val}
            {php $n=$dir.'/'.$val[0]}
            {php $a=$note.$val[0]}
            {if !(in_array($val[0],['_config.php','_note.php','_theme.php']))}
            <tr>
                <td><span class="ui-icon-file-text ui-text-blue"></span></td>
                <td class="ui-text-left"><a href="{U('edit','root='.$val[3].'')}">{$val[0]}</a></td>
                <td>{if isset($name[$a])}{$name[$a]}{/if}</td>
                <td>{$val[2]}</td>
                <td>{date('Y-m-d H:i:s',$val[1])}</td>
            </tr>
            {/if}
            {/foreach}
            </tbody>
        </table>
        </div>
        <!---->
    </div>

</body>
</html>