<?php

#开启错误提示（On：开启，Off：关闭）
ini_set('display_errors','Off');

#错误提示类型，（0：关闭，E_ALL：全部显示）
error_reporting(0);

#设置编码
header("Content-Type:text/html;charset=utf-8");

#PHP版本检查
if(version_compare(PHP_VERSION,'5.4.0','<') || version_compare(PHP_VERSION,'8.1.0','>')) die('5.4 <= Php版本 < 8.1，请检查!（当前版本是：'.PHP_VERSION.'）');

#只能被同域的Iframe
header('X-Frame-Options:SAMEORIGIN');

#设置时区
date_default_timezone_set("Asia/Shanghai");

#设置HttpOnly
ini_set("session.cookie_httponly",1);

#CSP头设置
#header("Content-Security-Policy:script-src 'self';frame-ancestors 'none';");

#设置跨域
#指定允许其他域名访问，如需修改，将星号替换为域名，不用带http://
header('Access-Control-Allow-Origin:*');

#响应类型  
header('Access-Control-Allow-Methods:POST');

#响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

#加载核心文件
require 'app/cms.php';