<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; class MemberDocController extends Controller { public function get() { goto aePx0; BXJrM: return Response::generateSuccessData(array('title' => modstart_config('Member_' . ucfirst($nKLrL) . 'Title'), 'content' => modstart_config('Member_' . ucfirst($nKLrL) . 'Content'))); goto f68m1; aePx0: $HoLMG = InputPackage::buildFromInput(); goto yzgpt; yzgpt: $nKLrL = $HoLMG->getTrimString('type'); goto DiLR8; DiLR8: BizException::throwsIf('类型错误', !in_array($nKLrL, array('agreement', 'privacy'))); goto BXJrM; f68m1: } }