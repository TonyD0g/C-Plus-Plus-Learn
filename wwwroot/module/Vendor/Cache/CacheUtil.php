<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Cache; use Illuminate\Support\Facades\Cache; class CacheUtil { private static function client() { return Cache::store(); } public static function rememberForever($T_BMM, $KEWDy) { return self::client()->rememberForever($T_BMM, $KEWDy); } public static function remember($T_BMM, $iUFFi, $KEWDy) { return self::client()->remember($T_BMM, intval($iUFFi / 60), $KEWDy); } public static function forget($T_BMM) { return self::client()->forget($T_BMM); } public static function get($T_BMM) { return self::client()->get($T_BMM); } public static function put($T_BMM, $Xiug2, $iUFFi) { self::client()->put($T_BMM, $Xiug2, ceil($iUFFi / 60)); } public static function forever($T_BMM, $Xiug2) { self::client()->forever($T_BMM, $Xiug2); } }