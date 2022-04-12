<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Markdown; use Illuminate\Support\Str; class MarkdownUtil { public static function convertToHtml($snPVU) { goto V5yZI; t1GWe: return $CjcMT->convertToHtml($snPVU); goto vk7bJ; V5yZI: if (PHP_VERSION_ID >= 80000) { return Str::of($snPVU)->markdown(); } goto wOSgl; wOSgl: $CjcMT = new MarkConverter(array('renderer' => array('soft_break' => '<br />'))); goto t1GWe; vk7bJ: } }