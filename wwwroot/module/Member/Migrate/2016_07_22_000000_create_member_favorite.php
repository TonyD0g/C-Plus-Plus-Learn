<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberFavorite extends Migration { public function up() { Schema::create('member_favorite', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('userId')->comment('用户ID')->nullable(); $qNtCk->string('category', 20)->comment('类别')->nullable(); $qNtCk->integer('categoryId')->comment('所属类别ID')->nullable(); $qNtCk->index(array('userId', 'category')); }); } public function down() { } }