<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Providers; use Illuminate\Routing\Router; use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider; class RouteServiceProvider extends ServiceProvider { protected $namespace = 'App\\Http\\Controllers'; public function boot(Router $router) { parent::boot($router); } public function map(Router $router) { } }