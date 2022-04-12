<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ $router->match(array('get', 'post'), 'widget/icon', 'WidgetIconController@index'); $router->match(array('get', 'post'), 'widget/link_select', 'WidgetLinkController@select');