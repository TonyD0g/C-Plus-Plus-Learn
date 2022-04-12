<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Auth; use Module\Member\Util\MemberGroupUtil; use Module\Member\Util\MemberVipUtil; class MemberGroup { public static function get($T_BMM = null) { goto HAVYe; RHGt6: return $glVfp; goto j1KKW; HAVYe: static $glVfp = null; goto C8FAm; Qzo6T: if (null !== $T_BMM) { return $glVfp[$T_BMM]; } goto RHGt6; C8FAm: if (null === $glVfp) { $glVfp = MemberGroupUtil::getMemberGroup(MemberUser::user()); } goto Qzo6T; j1KKW: } }