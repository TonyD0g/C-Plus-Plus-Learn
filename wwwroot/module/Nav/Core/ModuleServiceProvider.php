<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Core; use Illuminate\Events\Dispatcher; use Illuminate\Support\ServiceProvider; use ModStart\Admin\Config\AdminMenu; use ModStart\Module\ModuleClassLoader; class ModuleServiceProvider extends ServiceProvider { public function boot(Dispatcher $PNkBK) { if (method_exists(ModuleClassLoader::class, 'addClass')) { ModuleClassLoader::addClass('MNav', __DIR__ . '/../Helpers/MNav.php'); } AdminMenu::register(array(array('title' => '物料管理', 'icon' => 'description', 'sort' => 200, 'children' => array(array('title' => '导航配置', 'url' => '\\Module\\Nav\\Admin\\Controller\\NavController@index'))))); } public function register() { } }