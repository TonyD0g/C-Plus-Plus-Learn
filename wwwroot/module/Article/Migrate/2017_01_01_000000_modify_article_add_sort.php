<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class ModifyArticleAddSort extends Migration { public function up() { Schema::table('article', function (Blueprint $qNtCk) { $qNtCk->integer('sort')->nullable()->comment(''); }); } public function down() { } }