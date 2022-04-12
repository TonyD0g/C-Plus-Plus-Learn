<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto dcSog; dsclw: $router->match(array('get', 'post'), 'captcha/image', 'CaptchaController@image'); goto kyms6; rh8zn: $router->match(array('get', 'post'), 'install/lock', 'InstallController@lock'); goto dsclw; noAQA: $router->match(array('get', 'post'), 'install/execute', 'InstallController@execute'); goto rh8zn; UvX0d: $router->match(array('get', 'post'), 'install/prepare', 'InstallController@prepare'); goto noAQA; kyms6: $router->match(array('get'), 'placeholder/{width}x{height}', '\\Module\\Vendor\\Web\\Controller\\PlaceholderController@index'); goto KGr77; dcSog: $router->match(array('get', 'post'), 'install/ping', 'InstallController@ping'); goto UvX0d; KGr77: $router->group(array('middleware' => array(\Module\Vendor\Middleware\NoneLoginOperateAuthMiddleware::class)), function () use($router) { $router->match(array('get', 'post'), 'content_verify/{name}', 'ContentVerifyController@index'); });