<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class ModifyMemberOauthAddInfo extends Migration { public function up() { Schema::table('member_oauth', function (Blueprint $qNtCk) { $qNtCk->string('infoUsername', 100)->nullable(); $qNtCk->string('infoAvatar', 200)->nullable(); }); } public function down() { } }