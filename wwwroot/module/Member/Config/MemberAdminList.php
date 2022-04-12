<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Config; class MemberAdminList { private static $gridFields = array(); public static function registerGridField(\Closure $KEWDy) { self::$gridFields[] = $KEWDy; } public static function callGridField($bhaAK) { foreach (self::$gridFields as $KEWDy) { call_user_func_array($KEWDy, array($bhaAK)); } } }