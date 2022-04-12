<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberVip extends Migration { public function up() { Schema::table('member_user', function (Blueprint $qNtCk) { $qNtCk->integer('vipId')->nullable()->comment(''); $qNtCk->date('vipExpire')->nullable()->comment(''); }); Schema::create('member_vip_set', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->string('title', 50)->nullable()->comment('名称'); $qNtCk->string('flag', 50)->nullable()->comment('标识'); $qNtCk->integer('pid')->nullable()->comment('排序'); $qNtCk->integer('sort')->nullable()->comment('排序'); $qNtCk->tinyInteger('isDefault')->nullable()->comment('默认'); $qNtCk->string('icon', 100)->nullable()->comment('图标'); $qNtCk->decimal('price', 20, 2)->nullable()->comment(''); $qNtCk->integer('vipDays')->nullable()->comment(''); $qNtCk->text('content')->nullable()->comment('说明'); }); } public function down() { } }