<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ Route::group(array('middleware' => array('api.bootstrap', \Module\Member\Middleware\ApiAuthMiddleware::class), 'namespace' => '\\App\\Api\\Controller', 'prefix' => 'api'), function () { Route::match(array('get', 'post'), 'config_app', 'ConfigController@app'); Route::match(array('get', 'post'), 'config_constant', 'ConfigController@constant'); });