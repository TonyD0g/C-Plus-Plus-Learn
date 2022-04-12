<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberUploadCategory extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_upload_category')) { Schema::create('member_upload_category', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('userId')->nullable()->comment('用户ID'); $qNtCk->string('category', 10)->nullable()->comment('大类'); $qNtCk->integer('pid')->nullable()->comment('上级分类'); $qNtCk->integer('sort')->nullable()->comment('排序'); $qNtCk->string('title', 50)->nullable()->comment('名称'); $qNtCk->index(array('userId')); }); } } public function down() { } }