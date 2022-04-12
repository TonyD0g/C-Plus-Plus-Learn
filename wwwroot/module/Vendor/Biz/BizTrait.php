<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Biz; trait BizTrait { private static $list = array(); public static function register($HLJws) { self::$list[] = $HLJws; } public static function registerAll(...$flgKC) { foreach ($flgKC as $HLJws) { self::register($HLJws); } } public static function listAll() { foreach (self::$list as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$list[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$list[$Zc0iK] = app($aEiYS); } } } return self::$list; } private static function getByName($Ut_Gf) { foreach (self::all() as $KdsT8) { if ($KdsT8->name() == $Ut_Gf) { return $KdsT8; } } return null; } public static function allMap() { return array_build(self::all(), function ($Zc0iK, $aEiYS) { return array($aEiYS->name(), $aEiYS->title()); }); } }