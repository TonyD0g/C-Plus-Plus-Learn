<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Web\Controller; use Illuminate\Routing\Controller; use ModStart\Misc\Captcha\CaptchaFacade; class CaptchaController extends Controller { public function image() { return CaptchaFacade::create('default'); } }