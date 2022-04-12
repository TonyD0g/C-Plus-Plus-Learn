<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class MemberStatus implements BaseType { const NORMAL = 1; const FORBIDDEN = 2; public static function getList() { return array(self::NORMAL => '正常', self::FORBIDDEN => '禁用'); } }