<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Schedule; use Illuminate\Console\Scheduling\Schedule; class ScheduleProvider { private static $instances = array(); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function call(Schedule $Zy2Ee) { foreach (ScheduleProvider::all() as $Y2SRS) { $Zy2Ee->call(function () use($Y2SRS) { call_user_func(array($Y2SRS, 'run')); })->cron($Y2SRS->cron()); } } }