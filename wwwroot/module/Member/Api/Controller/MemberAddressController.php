<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Api\Controller; use ModStart\Core\Input\Response; use ModStart\Module\ModuleBaseController; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; use Module\Member\Util\MemberAddressUtil; class MemberAddressController extends ModuleBaseController implements MemberLoginCheck { public function all() { return Response::generateSuccessData(MemberAddressUtil::listUserAddresses(MemberUser::id())); } }