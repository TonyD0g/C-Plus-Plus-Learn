<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Type; use ModStart\Core\Type\BaseType; class WorkPosition implements BaseType { public static function getList() { goto yTCnM; nKphF: return $Wseaz; goto yVr61; yTCnM: static $Wseaz = null; goto YoU46; YoU46: if (null === $Wseaz) { $Wseaz = array(); foreach (array('普通职工', '中层管理者', '高层管理者', '企业主') as $KdsT8) { $Wseaz[$KdsT8] = $KdsT8; } } goto nKphF; yVr61: } }