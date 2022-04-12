<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberOauth extends Migration { public function up() { Schema::create('member_oauth', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('memberUserId')->comment('用户ID')->nullable(); $qNtCk->string('type', 30)->comment('类型')->nullable(); $qNtCk->string('openId', 150)->comment('OpenId')->nullable(); $qNtCk->index(array('type', 'openId')); $qNtCk->index(array('memberUserId')); }); } public function down() { } }