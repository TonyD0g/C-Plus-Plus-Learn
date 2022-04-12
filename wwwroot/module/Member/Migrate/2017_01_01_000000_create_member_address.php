<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class CreateMemberAddress extends Migration { public function up() { Schema::create('member_address', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('userId')->nullable()->comment('用户ID'); $qNtCk->string('name', 20)->nullable()->comment('姓名'); $qNtCk->string('phone', 20)->nullable()->comment('手机号'); $qNtCk->string('area', 100)->nullable()->comment('省市地区'); $qNtCk->string('detail', 200)->nullable()->comment('详细地址'); $qNtCk->string('post', 20)->nullable()->comment('邮政编码'); $qNtCk->tinyInteger('isDefault')->nullable()->comment('默认'); $qNtCk->index(array('userId')); }); } public function down() { } }