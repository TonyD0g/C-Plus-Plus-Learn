<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Html; class HtmlConvertUtil { public static function callInterceptors($Orrs0, $Xiug2) { goto arPrK; ukRHp: return $Xiug2; goto vRscS; ocbgZ: foreach ($Orrs0 as $xzHTg) { $tJxVf = app($xzHTg); $Xiug2 = $tJxVf->convert($Xiug2); } goto ukRHp; arPrK: if (empty($Orrs0)) { return $Xiug2; } goto nzbgy; nzbgy: if (!is_array($Orrs0)) { $Orrs0 = array($Orrs0); } goto ocbgZ; vRscS: } }