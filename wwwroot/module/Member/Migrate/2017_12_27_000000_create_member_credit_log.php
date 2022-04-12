<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberCreditLog extends Migration { public function up() { Schema::create('member_credit_log', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('memberUserId')->nullable()->comment('用户ID'); $qNtCk->integer('change')->nullable()->comment('金额'); $qNtCk->string('remark', 100)->nullable()->comment('备注'); $qNtCk->index(array('memberUserId')); }); } public function down() { } }