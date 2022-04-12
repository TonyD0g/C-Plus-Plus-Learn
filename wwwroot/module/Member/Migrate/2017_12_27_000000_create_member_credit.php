<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberCredit extends Migration { public function up() { Schema::create('member_credit', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('memberUserId')->nullable()->comment('用户ID'); $qNtCk->integer('total')->nullable()->comment('数量'); $qNtCk->unique(array('memberUserId')); }); } public function down() { } }