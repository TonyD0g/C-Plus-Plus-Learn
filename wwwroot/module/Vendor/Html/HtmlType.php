<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Html; use ModStart\Core\Type\BaseType; class HtmlType implements BaseType { const RICH_TEXT = 1; const MARKDOWN = 2; const SIMPLE_TEXT = 3; public static function getList() { return array(self::RICH_TEXT => '富文本', self::MARKDOWN => 'Markdown', self::SIMPLE_TEXT => '简单文本'); } }