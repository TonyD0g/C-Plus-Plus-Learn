<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberVipOrder extends Migration { public function up() { Schema::create('member_vip_order', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('memberUserId')->nullable()->comment('排序'); $qNtCk->integer('vipId')->nullable()->comment(''); $qNtCk->decimal('payFee', 20, 2)->nullable()->comment(''); $qNtCk->tinyInteger('status')->nullable()->comment('默认'); $qNtCk->date('expire')->nullable()->comment(''); $qNtCk->string('type', 20)->nullable()->comment(''); }); } public function down() { } }