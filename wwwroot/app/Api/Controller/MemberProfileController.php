<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Core\Util\ArrayUtil; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; use Module\Member\Util\MemberUtil; class MemberProfileController extends Controller implements MemberLoginCheck { public function basic($iLjtx = null) { goto VDmKO; JzE19: MemberUtil::update(MemberUser::id(), ArrayUtil::keepKeys($iLjtx, array('gender', 'realname', 'signature'))); goto haGpQ; X3HS4: if (null === $iLjtx) { $iLjtx = $D4PBu->all(); } goto JzE19; haGpQ: return Response::jsonSuccess('保存成功'); goto gtx_6; VDmKO: $D4PBu = InputPackage::buildFromInput(); goto X3HS4; gtx_6: } }