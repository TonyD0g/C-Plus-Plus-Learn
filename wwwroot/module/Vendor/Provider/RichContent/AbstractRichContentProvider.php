<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Module\Vendor\Html\HtmlConvertUtil; abstract class AbstractRichContentProvider { public abstract function name(); public abstract function title(); public abstract function render($Ut_Gf, $Xiug2, $HAqS9 = array()); public function toHtml($Xiug2, $iaoPv = null) { return HtmlConvertUtil::callInterceptors($iaoPv, $Xiug2); } }