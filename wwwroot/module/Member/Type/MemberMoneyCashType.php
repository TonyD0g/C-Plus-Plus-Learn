<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class MemberMoneyCashType implements BaseType { const ALIPAY = 1; public static function getList() { return array(self::ALIPAY => '支付宝'); } }