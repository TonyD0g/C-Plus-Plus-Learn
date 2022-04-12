<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class MemberMoneyChargeStatus implements BaseType { const CREATED = 1; const SUCCESS = 2; public static function getList() { return array(self::CREATED => '新创建', self::SUCCESS => '提现成功'); } }