<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Notifier; use Module\Vendor\Util\NoneLoginOperateUtil; class NotifierProvider { public static function all() { goto INQlz; INQlz: static $If7AP = null; goto Y1i9F; Y1i9F: if (null === $If7AP) { goto xAHue; xAHue: $nsp4c = config('NotifierProviders'); goto I4JaI; yyZAc: $If7AP = array_map(function ($pnvZA) { return app($pnvZA); }, array_unique($nsp4c)); goto LhJ0G; I4JaI: if (empty($nsp4c)) { $nsp4c = array(DefaultNotifierProvider::class); } goto yyZAc; LhJ0G: } goto zk30f; zk30f: return $If7AP; goto vBG3h; vBG3h: } public static function notify($HLJws, $IIIcx, $HvAUu, $HAqS9 = array()) { foreach (self::all() as $tJxVf) { $tJxVf->notify($HLJws, $IIIcx, $HvAUu, $HAqS9); } } public static function notifyProcess($HLJws, $IIIcx, $HvAUu, $ilZrD) { self::notify($HLJws, $IIIcx, $HvAUu, array('processUrl' => $ilZrD)); } public static function notifyNoneLoginOperateProcessUrl($HLJws, $IIIcx, $HvAUu, $antGk, $jC8lG = array()) { $ilZrD = NoneLoginOperateUtil::generateUrl($antGk, $jC8lG); self::notifyProcess($HLJws, $IIIcx, $HvAUu, $ilZrD); } }