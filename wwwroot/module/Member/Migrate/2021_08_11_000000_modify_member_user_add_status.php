<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyMemberUserAddStatus extends Migration { public function up() { Schema::table('member_user', function (Blueprint $qNtCk) { $qNtCk->tinyInteger('status')->nullable()->comment(''); }); \ModStart\Core\Dao\ModelUtil::updateAll('member_user', array('status' => \Module\Member\Type\MemberStatus::NORMAL)); } public function down() { } }