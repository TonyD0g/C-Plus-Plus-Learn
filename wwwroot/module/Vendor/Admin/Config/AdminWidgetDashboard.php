<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Admin\Config; use ModStart\Admin\Auth\AdminPermission; use ModStart\Admin\Layout\AdminPage; use ModStart\Layout\Row; use ModStart\Widget\Box; use Module\Vendor\Provider\ContentVerify\ContentVerifyProvider; class AdminWidgetDashboard { private static $todo = array(); private static $icon = array(); private static $foot = array(); public static function registerTodo($jyQwv) { self::$todo[] = $jyQwv; } public static function callTodo(Row $sfPWW) { foreach (self::$todo as $KdsT8) { call_user_func_array($KdsT8, array($sfPWW)); } } public static function registerIcon($jyQwv) { self::$icon[] = $jyQwv; } public static function callIcon(Row $sfPWW) { foreach (self::$icon as $KdsT8) { call_user_func_array($KdsT8, array($sfPWW)); } } public static function registerFoot($jyQwv) { self::$foot[] = $jyQwv; } public static function call(AdminPage $ZcuyS) { goto DDcv4; NlvcH: if (!empty($rqykj)) { $ZcuyS->row(Box::make(join('', $rqykj), '待审核')); } goto AwIdd; DDcv4: $rqykj = array(); goto ovRoA; ovRoA: foreach (ContentVerifyProvider::all() as $Y2SRS) { if (AdminPermission::permit($Y2SRS->verifyRule())) { $Hta4C = $Y2SRS->verifyCount(); if ($Hta4C > 0) { goto K03SV; K03SV: $K2Mwf = $Y2SRS->verifyUrl(); goto LlR4Y; iN6wm: $rqykj[] = "<a class='tw-mr-4 tw-inline-block' href='{$K2Mwf}'>{$IIIcx}<span class='ub-text-danger'>{$Hta4C}</span>条</a>"; goto JuUbC; LlR4Y: $IIIcx = $Y2SRS->title(); goto iN6wm; JuUbC: } } } goto NlvcH; AwIdd: foreach (self::$foot as $KdsT8) { if ($KdsT8 instanceof \Closure) { call_user_func_array($KdsT8, array($ZcuyS)); } } goto aV6_5; aV6_5: } }