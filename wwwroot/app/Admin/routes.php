<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ Route::group(array('prefix' => env('ADMIN_PATH', '/admin/'), 'middleware' => array('admin.bootstrap', 'admin.auth'), 'namespace' => '\\App\\Admin\\Controller'), function () { Route::match(array('get', 'post'), '', 'IndexController@index'); });