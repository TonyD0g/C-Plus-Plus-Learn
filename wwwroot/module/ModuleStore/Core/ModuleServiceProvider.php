<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\ModuleStore\Core; use Illuminate\Events\Dispatcher; use Illuminate\Support\ServiceProvider; use ModStart\Admin\Config\AdminMenu; class ModuleServiceProvider extends ServiceProvider { public function boot(Dispatcher $PNkBK) { AdminMenu::register(function () { return array(array('title' => L('System Manage'), 'icon' => 'code-alt', 'sort' => 700, 'children' => array(array('title' => L('Module Manage'), 'rule' => 'ModuleStoreManage', 'url' => '\\Module\\ModuleStore\\Admin\\Controller\\ModuleStoreController@index')))); }); } public function register() { } }