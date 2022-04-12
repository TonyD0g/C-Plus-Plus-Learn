<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use ModStart\Core\Exception\BizException; use ModStart\Module\ModuleBaseController; use ModStart\Module\ModuleManager; use Module\Member\Support\MemberLoginCheck; use Module\Member\Util\MemberVipUtil; class MemberVipController extends ModuleBaseController { private $api; public function index() { goto cc52w; sS7LX: return $this->view('memberVip.index', array('memberVips' => MemberVipUtil::all())); goto N1WAD; ngaam: $this->api = app(\Module\Member\Api\Controller\MemberVipController::class); goto sS7LX; cc52w: BizException::throwsIf('缺少 PayCenter 模块', !ModuleManager::isModuleEnabled('PayCenter')); goto ngaam; N1WAD: } }