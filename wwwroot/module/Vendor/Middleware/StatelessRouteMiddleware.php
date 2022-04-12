<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Middleware; class StatelessRouteMiddleware { public function handle($FPoEp, \Closure $m3B93) { config()->set('session.driver', 'array'); return $m3B93($FPoEp); } }