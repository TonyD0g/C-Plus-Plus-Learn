<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Schedule; abstract class AbstractScheduleProvider { public abstract function cron(); public abstract function title(); public abstract function run(); protected function cronEveryMinute() { return '* * * * *'; } protected function cronEvery10Minute() { return '*/10 * * * * *'; } protected function cronEvery30Minute() { return '0,30 * * * * *'; } protected function cronEveryDayHour24($S6h3M) { return "0 {$S6h3M} * * * *"; } protected function cronEveryDayHour24Minute($S6h3M, $LTisG) { return "{$LTisG} {$S6h3M} * * * *"; } protected function cronEveryHour() { return '0 * * * * *'; } protected function cronEveryDay() { return '0 0 * * * *'; } }