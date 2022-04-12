<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Console; use Illuminate\Console\Scheduling\Schedule; use Illuminate\Foundation\Console\Kernel as ConsoleKernel; class Kernel extends ConsoleKernel { protected $commands = array(Commands\MigrateJob::class); protected function schedule(Schedule $gmeDm) { } }