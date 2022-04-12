<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use ModStart\Core\Dao\ModelManageUtil; class ModifyNavAddOpenType extends Migration { public function up() { Schema::table('nav', function (Blueprint $qNtCk) { $qNtCk->tinyInteger('openType')->nullable()->comment(''); }); \ModStart\Core\Dao\ModelUtil::updateAll('nav', array('openType' => \Module\Nav\Type\NavOpenType::CURRENT_WINDOW)); } public function down() { } }