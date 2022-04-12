<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\HomePage; class DefaultHomePageProvider extends AbstractHomePageProvider { public function title() { return L('Default') . L('Home'); } public function action() { return '\\App\\Web\\Controller\\IndexController@index'; } }