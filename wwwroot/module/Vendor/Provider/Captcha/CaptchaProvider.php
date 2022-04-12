<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Captcha; use ModStart\Core\Exception\BizException; class CaptchaProvider { private static $instances = array(DefaultCaptchaProvider::class); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function nameTitleMap() { return array_build(self::all(), function ($Zc0iK, $aEiYS) { return array($aEiYS->name(), $aEiYS->title()); }); } public static function get($Ut_Gf) { foreach (self::all() as $KdsT8) { if ($KdsT8->name() == $Ut_Gf) { return $KdsT8; } } return null; } public static function hasProvider() { $Y2SRS = app()->config->get('CaptchaProvider'); return !empty($Y2SRS); } }