<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; use ModStart\Core\Type\BaseType; class NavOpenType implements BaseType { const CURRENT_WINDOW = 1; const NEW_BLANK = 2; public static function getList() { return array(self::CURRENT_WINDOW => '当前窗口', self::NEW_BLANK => '新窗口'); } public static function getBlankAttributeFromValue($K6grT) { goto cK0Jm; f67X5: switch ($K6grT) { case self::NEW_BLANK: return 'target="_blank"'; } goto wzq6N; cK0Jm: if (empty($K6grT)) { return ''; } goto z17HX; wzq6N: return ''; goto e5yab; z17HX: if (is_array($K6grT)) { $K6grT = isset($K6grT['openType']) ? $K6grT['openType'] : null; } goto f67X5; e5yab: } }