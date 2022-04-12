<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SmsTemplate; use ModStart\Support\Concern\HasFields; class SmsTemplateProvider { private static $instances = array(); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function map() { goto HaSls; HaSls: $Wseaz = array(); goto G_W2Z; CFU4x: return $Wseaz; goto AVd5V; G_W2Z: foreach (self::all() as $KdsT8) { $Wseaz[$KdsT8->name()] = array('name' => $KdsT8->name(), 'title' => $KdsT8->title(), 'description' => $KdsT8->description(), 'example' => $KdsT8->example()); } goto CFU4x; AVd5V: } }