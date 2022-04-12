<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberMoneyCash extends Migration { public function up() { Schema::create('member_money_cash', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('memberUserId')->nullable()->comment('用户ID'); $qNtCk->tinyInteger('status')->nullable()->comment('状态'); $qNtCk->decimal('money', 20, 2)->nullable()->comment('金额'); $qNtCk->decimal('moneyAfterTax', 20, 2)->nullable()->comment('实际到账'); $qNtCk->string('remark', 100)->nullable()->comment('备注'); $qNtCk->tinyInteger('type')->nullable()->comment('提现账号类型'); $qNtCk->string('realname', 50)->nullable()->comment('提现账号姓名'); $qNtCk->string('account', 200)->nullable()->comment('提现账号'); $qNtCk->index(array('memberUserId')); }); } public function down() { } }