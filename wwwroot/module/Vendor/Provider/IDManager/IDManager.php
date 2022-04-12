<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\IDManager; class IDManager { private static $instances = array(); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function get($Ut_Gf) { goto yVqQH; unjH8: return null; goto OSvtJ; yVqQH: $Ut_Gf = modstart_config($Ut_Gf, $Ut_Gf); goto zNlbD; zNlbD: foreach (self::all() as $CfMSZ) { if ($CfMSZ->name() == $Ut_Gf) { return $CfMSZ; } } goto unjH8; OSvtJ: } }