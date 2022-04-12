<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Util; use ModStart\Support\Manager\FieldManager; use Module\Member\Widget\Field\AdminMemberInfo; use Module\Member\Widget\Field\MemberImage; class MemberFieldUtil { public static function register() { FieldManager::extend('memberImage', MemberImage::class); FieldManager::extend('adminMemberInfo', AdminMemberInfo::class); } }