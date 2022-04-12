<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; use ModStart\Core\Type\BaseType; use ModStart\Module\ModuleManager; use Module\Nav\Biz\NavPositionBiz; class NavPosition implements BaseType { public static function getList() { return array_merge(ModuleManager::getModuleConfigKeyValueItems('Nav', 'position'), NavPositionBiz::allMap()); } public static function first() { goto ss4Xo; ss4Xo: $wiK2p = self::getList(); goto R2tQJ; R2tQJ: $WGpnh = array_keys($wiK2p); goto OtnQN; OtnQN: return array_shift($WGpnh); goto b0Oqq; b0Oqq: } }