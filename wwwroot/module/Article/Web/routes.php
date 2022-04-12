<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ $router->match(array('get', 'post'), 'article/{id}', 'ArticleController@views'); $router->match(array('get', 'post'), 'article/{alias_url}', 'ArticleController@views');