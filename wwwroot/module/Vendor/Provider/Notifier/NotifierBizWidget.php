<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Notifier; class NotifierBizWidget { private static $list = array(); public static function register($HLJws, $IIIcx) { self::$list[] = array('biz' => $HLJws, 'title' => $IIIcx); } public static function get() { return self::$list; } }