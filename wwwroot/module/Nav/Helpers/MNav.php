<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ class MNav { public static function all($T_4Ez = 'head') { goto gEmOr; qZ1Na: return $LdZT6; goto iy7z3; uSJfs: foreach ($LdZT6 as $grToB => $aEiYS) { $LdZT6[$grToB]['_attr'] = \Module\Nav\Type\NavOpenType::getBlankAttributeFromValue($aEiYS); } goto qZ1Na; gEmOr: $LdZT6 = \Module\Nav\Util\NavUtil::listByPositionWithCache($T_4Ez); goto uSJfs; iy7z3: } }