<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Biz; class NavPosition extends AbstractNavPositionBiz { private $name; private $title; public static function make($Ut_Gf, $IIIcx) { goto VoWp8; VoWp8: $T8fTF = new static(); goto iB8x1; iB8x1: $T8fTF->name = $Ut_Gf; goto PoL1k; PoL1k: $T8fTF->title = $IIIcx; goto namht; namht: return $T8fTF; goto yFbPx; yFbPx: } public function name() { return $this->name; } public function title() { return $this->title; } }