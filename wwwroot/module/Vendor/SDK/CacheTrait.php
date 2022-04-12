<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\SDK; use Module\Vendor\Cache\CacheUtil; trait CacheTrait { protected function cacheRememberForever($T_BMM, $KEWDy) { return CacheUtil::rememberForever('ThirdParty:' . $T_BMM, $KEWDy); } protected function cacheRemember($T_BMM, $iUFFi, $KEWDy) { return CacheUtil::remember('ThirdParty:' . $T_BMM, $iUFFi, $KEWDy); } protected function cacheForget($T_BMM) { return CacheUtil::forget('ThirdParty:' . $T_BMM); } protected function cacheGet($T_BMM) { return CacheUtil::get('ThirdParty:' . $T_BMM); } protected function cachePut($T_BMM, $Xiug2, $iUFFi) { CacheUtil::put('ThirdParty:' . $T_BMM, $Xiug2, $iUFFi); } }