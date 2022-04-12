<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ Route::group(array('middleware' => array('web.bootstrap', \Module\Member\Middleware\WebAuthMiddleware::class), 'namespace' => '\\App\\Web\\Controller'), function () { Route::match(array('get', 'post'), '', 'IndexController@index'); Route::match(array('get', 'post'), 'member', 'MemberController@index'); Route::match(array('get', 'post'), 'member_profile', 'MemberProfileController@index'); });