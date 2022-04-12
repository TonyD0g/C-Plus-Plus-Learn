<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Captcha; use Illuminate\Support\Facades\View; use ModStart\Core\Input\InputPackage; use ModStart\Core\Input\Response; use ModStart\Misc\Captcha\CaptchaFacade; class DefaultCaptchaProvider extends AbstractCaptchaProvider { public function name() { return 'default'; } public function title() { return '图片验证码'; } public function render() { return View::make('module::Vendor.View.widget.captcha.default')->render(); } public function validate() { goto d3Lia; TOSfT: $Nd07J = $HoLMG->getTrimString('captcha'); goto sKold; sHD7m: return Response::generateSuccess(); goto LmEvE; d3Lia: $HoLMG = InputPackage::buildFromInput(); goto TOSfT; sKold: if (!CaptchaFacade::check($Nd07J)) { return Response::generate(-1, '图片验证码错误', null, '[js]$(\'[data-captcha]\').click();'); } goto sHD7m; LmEvE: } }