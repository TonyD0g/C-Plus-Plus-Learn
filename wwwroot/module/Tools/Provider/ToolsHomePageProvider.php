<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Tools\Provider; use Module\Vendor\Provider\HomePage\AbstractHomePageProvider; class ToolsHomePageProvider extends AbstractHomePageProvider { public function title() { return '工具箱首页'; } public function action() { return '\\Module\\Tools\\Web\\Controller\\IndexController@index'; } }