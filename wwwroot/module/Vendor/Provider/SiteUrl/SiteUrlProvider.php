<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SiteUrl; use ModStart\Core\Exception\BizException; class SiteUrlProvider { private static $list = array(); private static $init = false; public static function register($Y2SRS) { self::$list[] = $Y2SRS; } public static function get() { if (!self::$init) { self::$init = true; foreach (self::$list as $Zc0iK => $aEiYS) { if (is_string($aEiYS)) { self::$list[$Zc0iK] = app($aEiYS); } } } return self::$list; } public static function update($K2Mwf, $IIIcx = '', $HAqS9 = array()) { BizException::throwsIfEmpty('SiteUrlProvider.Error -> url empty', $K2Mwf); foreach (self::get() as $tJxVf) { $tJxVf->update($K2Mwf, $IIIcx, $HAqS9); } } public static function delete($K2Mwf) { BizException::throwsIfEmpty('SiteUrlProvider.Error -> url empty', $K2Mwf); foreach (self::get() as $tJxVf) { $tJxVf->delete($K2Mwf); } } }