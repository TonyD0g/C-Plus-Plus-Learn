<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class NavNavAddPid extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTableColumn('nav', 'pid')) { Schema::table('nav', function (Blueprint $qNtCk) { $qNtCk->integer('pid')->nullable()->comment('上级ID'); }); } \ModStart\Core\Dao\ModelUtil::updateAll('nav', array('pid' => 0)); } public function down() { } }