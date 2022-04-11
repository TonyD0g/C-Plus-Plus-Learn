<?php defined('IN_CMS') or die();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<title>轻站在线安装程序_安装协议</title>
<link rel="stylesheet" href="../public/css/ui.css">
<link rel="stylesheet" href="css/app.css">
<script src="../public/js/jquery.js"></script>
<script src="../public/js/base.js"></script>
<script src="../public/js/ui.js"></script>
</head>

<body>

    <form class="ui-form" method="post">
    <div class="width inner_container">
        <div class="install">
            <div id="step"></div>
            <div class="subject">
                <b>安装协议</b>
            </div>
            <p>1、所有用户均可根据自己的需要对程序进行修改。但无论何种情况，即：无论用途如何、是否经过修改或美化、修改程度如何，修改后的程序版权依然归开发团队所有。</p>
            <p>2、您可以免费使用本程序用于商业用途，并允许传播给其他人。</p>
            <p class="ui-mt-15"><b>免责声明</b></p>
            <p>1、利用本软件构建的网站的任何信息内容以及导致的任何版权纠纷和法律争议及后果，我们不承担任何责任。</p>
            <p>2、程序的使用（或无法再使用）中所有一般化、特殊化、偶然性或必然性的损坏（包括但不限于数据的丢失，自己或第三方所维护数据的不正确修改，和其他程序协作过程中程序的崩溃等），我们不承担任何责任。</p>
            <div class="ui-text-center ui-mt-30"><button type="button" class="ui-btn ui-btn-blue" onClick="location.href='?act=check'">同意安装协议并继续</button></div>
        </div>
    </div>
    </form>
    

    <!--[if lt IE 9]>
    <div class="notsupport">
        <h1>:( 非常遗憾</h1>
        <h2>您的浏览器版本太低，请升级您的浏览器</h2>
    </div>
    <![endif]-->
    <script>
    $(function()
    {
        $("#step").step({data:['安装协议','环境检测','参数配置','安装结果'],index:1});
    })
    </script>
</body>
</html>