<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberMessage extends Migration { public function up() { if (!\ModStart\Core\Dao\ModelManageUtil::hasTable('member_message')) { Schema::create('member_message', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->integer('userId')->comment('用户ID')->nullable(); $qNtCk->tinyInteger('status')->comment('1未读 2已读')->nullable(); $qNtCk->integer('fromId')->comment('来源用户ID')->nullable(); $qNtCk->string('content', 20000)->comment('消息内容(html)')->nullable(); $qNtCk->index(array('userId', 'status')); }); } } public function down() { } }