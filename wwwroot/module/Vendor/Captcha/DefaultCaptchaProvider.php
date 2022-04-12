<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Captcha; use Illuminate\Support\Facades\View; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Misc\Captcha\CaptchaFacade; class DefaultCaptchaProvider extends AbstractCaptchaProvider { public function render() { return View::make('module::Vendor.View.widget.captcha.default')->render(); } public function validate() { goto PRInf; AiCCH: return Response::generateSuccess(); goto qWjRV; kkGYe: if (!CaptchaFacade::check($Nd07J)) { return Response::generate(-1, '图片验证码错误', null, '[js]$(\'[data-captcha]\').click();'); } goto AiCCH; PRInf: $HoLMG = InputPackage::buildFromInput(); goto lBCIR; lBCIR: $Nd07J = $HoLMG->getTrimString('captcha'); goto kkGYe; qWjRV: } }