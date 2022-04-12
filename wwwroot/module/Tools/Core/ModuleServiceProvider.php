<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Tools\Core; use Illuminate\Events\Dispatcher; use Illuminate\Support\ServiceProvider; use ModStart\Admin\Config\AdminMenu; use ModStart\Module\ModuleManager; use Module\Tools\Provider\ToolsHomePageProvider; use Module\Vendor\Admin\Config\AdminWidgetLink; use Module\Vendor\Provider\HomePage\HomePageProvider; class ModuleServiceProvider extends ServiceProvider { public function boot(Dispatcher $PNkBK) { AdminWidgetLink::register(function () { $VoVPx = array(); $VoVPx[] = array('工具箱首页', modstart_web_url('tools')); $Mu83B = array(); $JJGcw = ModuleManager::path('Tools', 'Docs/tools.json'); if (file_exists($JJGcw)) { $Mu83B = json_decode(file_get_contents($JJGcw), true); } foreach ($Mu83B as $VfQYR) { foreach ($VfQYR['children'] as $aKA5T) { $VoVPx[] = array("{$VfQYR['title']}-{$aKA5T['title']}", modstart_web_url('tools/#/' . $aKA5T['url'])); } } return AdminWidgetLink::build('工具箱', $VoVPx); }); HomePageProvider::register(ToolsHomePageProvider::class); } public function register() { } }