<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Console\Commands; use Illuminate\Console\Command; use Illuminate\Foundation\Inspiring; use TechOnline\Laravel\Dao\ModelUtil; use TechOnline\Utils\CurlUtil; use TechOnline\Utils\TimeUtil; use TechSoft\Laravel\Data\DataUtil; use TechSoft\Laravel\Third\BaiduAI; class MigrateJob extends Command { protected $signature = 'MigrateJob'; protected $description = 'Display an inspiring quote'; public function handle() { } }