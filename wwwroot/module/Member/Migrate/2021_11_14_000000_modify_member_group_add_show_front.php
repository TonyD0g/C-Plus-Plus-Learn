<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyMemberGroupAddShowFront extends Migration { public function up() { Schema::table('member_group', function (Blueprint $qNtCk) { $qNtCk->tinyInteger('showFront')->nullable()->comment('前台显示'); }); } public function down() { } }