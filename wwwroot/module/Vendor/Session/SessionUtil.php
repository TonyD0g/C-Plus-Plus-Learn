<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Session; use Illuminate\Support\Facades\Session; use Module\Vendor\Atomic\AtomicUtil; class SessionUtil { public static function atomicProduce($Ut_Gf, $Xiug2, $P1cLT = 3600) { AtomicUtil::produce("{$Ut_Gf}:" . Session::getId(), $Xiug2, $P1cLT); } public static function atomicConsume($Ut_Gf, $Vhd2R = null) { return AtomicUtil::consume("{$Ut_Gf}:" . Session::getId()); } public static function atomicRemove($Ut_Gf, $Vhd2R = null) { AtomicUtil::remove("{$Ut_Gf}:" . Session::getId()); } }