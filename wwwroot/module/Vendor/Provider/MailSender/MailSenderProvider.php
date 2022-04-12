<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\MailSender; use ModStart\Core\Exception\BizException; class MailSenderProvider { private static $instances = array(); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function get($Ut_Gf) { foreach (self::all() as $KdsT8) { if ($KdsT8->name() == $Ut_Gf) { return $KdsT8; } } BizException::throws('没有找到MailSenderProvider'); } public static function hasProvider() { $Y2SRS = app()->config->get('EmailSenderProvider'); return !empty($Y2SRS); } }