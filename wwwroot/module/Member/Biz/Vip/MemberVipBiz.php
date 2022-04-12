<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Biz\Vip; use Module\Vendor\Biz\BizTrait; class MemberVipBiz { use BizTrait; public static function all() { return self::listAll(); } public static function get($Ut_Gf) { return self::getByName($Ut_Gf); } }