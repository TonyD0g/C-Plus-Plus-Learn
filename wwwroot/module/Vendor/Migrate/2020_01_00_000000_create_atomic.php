<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use ModStart\Core\Dao\ModelManageUtil; class CreateAtomic extends Migration { public function up() { if (!ModelManageUtil::hasTable('atomic')) { Schema::create('atomic', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->string('name', 100)->nullable()->comment(''); $qNtCk->integer('value')->nullable()->comment(''); $qNtCk->integer('expire')->nullable()->comment(''); $qNtCk->unique('name'); $qNtCk->index('expire'); }); } } public function down() { } }