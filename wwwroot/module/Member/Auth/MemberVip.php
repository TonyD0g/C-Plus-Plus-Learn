<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Auth; use Module\Member\Util\MemberVipUtil; class MemberVip { public static function get($T_BMM = null, $bw2yx = null) { goto YOKg5; kK2pV: if (null === $Ui2lF) { $Ui2lF = MemberVipUtil::getMemberVip(MemberUser::user()); } goto rG5JG; YOKg5: static $Ui2lF = null; goto kK2pV; rG5JG: if (null !== $T_BMM) { return isset($Ui2lF[$T_BMM]) ? $Ui2lF[$T_BMM] : $bw2yx; } goto UBfiI; UBfiI: return $Ui2lF; goto njFye; njFye: } public static function isDefault() { return self::get('isDefault', false); } }