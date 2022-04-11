<?php defined('IN_CMS') or die();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<title>轻站在线安装程序_安装结果</title>
<link rel="stylesheet" href="../public/css/ui.css">
<link rel="stylesheet" href="css/app.css">
<script src="../public/js/jquery.js"></script>
<script src="../public/js/base.js"></script>
<script src="../public/js/ui.js"></script>
</head>

<body>
    
    <div class="width inner_container">
        <div class="install">
            <div id="step"></div>
            <div class="subject">
                <b>安装结果</b>
            </div>
            <h1>恭喜您，安装成功！</h1>
            <div class="ui-mt-30">
            	<button class="ui-btn ui-btn-yellow ui-mr" onClick="location.href='../'">访问首页</button>
                <button class="ui-btn ui-btn-blue" onClick="location.href='../?m=admin'">访问后台</button>
            </div>

        </div>
        
    </div>

    <!--[if lt IE 9]>
    <div class="notsupport">
        <h1>:( 非常遗憾</h1>
        <h2>您的浏览器版本太低，请升级您的浏览器</h2>
    </div>
    <![endif]-->
    <script>
    $(function()
    {
        $("#step").step({data:['安装协议','环境检测','参数配置','安装结果'],index:4});
    })
    </script>
</body>
</html>