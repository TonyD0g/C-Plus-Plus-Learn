<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class MemberMessageStatus implements BaseType { const UNREAD = 1; const READ = 2; public static function getList() { return array(self::UNREAD => '未读', self::READ => '已读'); } }