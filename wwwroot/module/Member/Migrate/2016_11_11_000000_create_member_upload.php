<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberUpload extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_upload')) { Schema::create('member_upload', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->unsignedInteger('userId')->nullable()->comment('用户ID'); $qNtCk->string('category', 10)->nullable()->comment('大类'); $qNtCk->unsignedInteger('dataId')->nullable()->comment('文件ID'); $qNtCk->integer('uploadCategoryId')->nullable()->comment('分类ID'); $qNtCk->index(array('userId', 'uploadCategoryId')); }); } } public function down() { } }