<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Admin\Core; use Illuminate\Events\Dispatcher; use Illuminate\Support\ServiceProvider; use ModStart\Admin\Config\AdminMenu; class ModuleServiceProvider extends ServiceProvider { public function boot(Dispatcher $XQBqW) { AdminMenu::register(function () { return array(array('title' => '系统概况', 'icon' => 'home', 'sort' => 50, 'url' => '\\App\\Admin\\Controller\\IndexController@index')); }); } public function register() { } }