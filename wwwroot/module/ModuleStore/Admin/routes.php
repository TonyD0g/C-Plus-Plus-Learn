<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto Fu21h; vYANx: $router->match(array('get', 'post'), 'module_store/enable', 'ModuleStoreController@enable'); goto eq037; SDqR9: $router->match(array('get', 'post'), 'module_store/all', 'ModuleStoreController@all'); goto taOUd; taOUd: $router->match(array('get', 'post'), 'module_store/install', 'ModuleStoreController@install'); goto N1FAx; N1FAx: $router->match(array('get', 'post'), 'module_store/uninstall', 'ModuleStoreController@uninstall'); goto vYANx; eq037: $router->match(array('get', 'post'), 'module_store/disable', 'ModuleStoreController@disable'); goto M1Yo2; M1Yo2: $router->match(array('get', 'post'), 'module_store/upgrade', 'ModuleStoreController@upgrade'); goto WAB9h; Fu21h: $router->match(array('get', 'post'), 'module_store', 'ModuleStoreController@index'); goto SDqR9; WAB9h: $router->match(array('get', 'post'), 'module_store/config/{module}', 'ModuleStoreController@config');