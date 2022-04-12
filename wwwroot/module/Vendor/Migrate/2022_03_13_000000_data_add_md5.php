<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class DataAddMd5 extends Migration { public function up() { Schema::table('data', function (Blueprint $qNtCk) { $qNtCk->string('md5', 32)->nullable()->comment(''); $qNtCk->index('md5'); }); Schema::table('data_temp', function (Blueprint $qNtCk) { $qNtCk->string('md5', 32)->nullable()->comment(''); $qNtCk->index('md5'); }); } public function down() { } }