<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Biz; class ArticlePosition extends AbstractArticlePositionBiz { private $name; private $title; public static function make($Ut_Gf, $IIIcx) { goto IIgIU; IHnzB: $T8fTF->title = $IIIcx; goto bnp7F; bnp7F: return $T8fTF; goto UnieA; dni97: $T8fTF->name = $Ut_Gf; goto IHnzB; IIgIU: $T8fTF = new static(); goto dni97; UnieA: } public function name() { return $this->name; } public function title() { return $this->title; } }