<?php
#开启错误提示
ini_set('display_errors','On');

#错误提示类型，0表示关闭，E_ALL：全部显示
error_reporting(E_ALL);

#设置编码
header("Content-Type:text/html;charset=utf-8");

#PHP版本检查
if(version_compare(PHP_VERSION,'5.4.0','<') || version_compare(PHP_VERSION,'8.1.0','>')) die('5.4 <= Php版本 < 8.1，请检查!（当前版本是：'.PHP_VERSION.'）');

#设置时区
date_default_timezone_set("Asia/Shanghai");

require 'install.php';