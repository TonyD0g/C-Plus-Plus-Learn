<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LBS; use Module\Vendor\Provider\ProviderTrait; class IpProvider { use ProviderTrait; public static function all() { return self::listAll(); } public static function get($Ut_Gf) { return self::getByName($Ut_Gf); } }