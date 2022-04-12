<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto fd26h; fd26h: $router->match(array('get', 'post'), 'tecmz/upgrade', 'UpgradeController@index'); goto NyQXu; NyQXu: $router->match(array('get', 'post'), 'tecmz/upgrade/manual', 'UpgradeController@manual'); goto HHvaA; HHvaA: $router->match(array('get', 'post'), 'tecmz/upgrade/info', 'UpgradeController@info');