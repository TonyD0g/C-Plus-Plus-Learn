<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Html; use ModStart\Core\Util\HtmlUtil; use Module\Vendor\Markdown\MarkdownUtil; class HtmlConverter { public static function convertToHtml($RCSL8, $HvAUu, $Orrs0 = null) { goto eGhWH; eGhWH: switch ($RCSL8) { case HtmlType::RICH_TEXT: $yQ7gX = HtmlUtil::filter2($HvAUu); break; case HtmlType::MARKDOWN: goto HJVbq; cK4AO: $yQ7gX = HtmlUtil::filter($yQ7gX); goto evQAC; HJVbq: $yQ7gX = MarkdownUtil::convertToHtml($HvAUu); goto cK4AO; evQAC: break; goto ZsYtz; ZsYtz: case HtmlType::SIMPLE_TEXT: $yQ7gX = HtmlUtil::text2html($HvAUu); break; default: throw new \Exception('HtmlConverter.convertToHtml contentType error'); } goto esv9E; esv9E: if (!empty($Orrs0)) { if (is_array($Orrs0)) { foreach ($Orrs0 as $xzHTg) { $Di_PY = new $xzHTg(); $yQ7gX = $Di_PY->convert($yQ7gX); } } else { $Di_PY = new $Orrs0(); $yQ7gX = $Di_PY->convert($yQ7gX); } } goto Qk1K1; Qk1K1: return $yQ7gX; goto PUJIa; PUJIa: } }