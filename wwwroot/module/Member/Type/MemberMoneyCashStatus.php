<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class MemberMoneyCashStatus implements BaseType { const VERIFYING = 1; const SUCCESS = 2; public static function getList() { return array(self::VERIFYING => '正在审核', self::SUCCESS => '提现成功'); } }