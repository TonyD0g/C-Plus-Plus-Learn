<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class Gender implements BaseType { const MALE = 1; const FEMALE = 2; const UNKNOWN = 0; public static function getList() { return array(self::MALE => '男', self::FEMALE => '女', self::UNKNOWN => '未知'); } }