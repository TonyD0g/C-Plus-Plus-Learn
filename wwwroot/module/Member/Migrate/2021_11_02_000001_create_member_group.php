<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateMemberGroup extends Migration { public function up() { goto zw7kG; R6BIU: \ModStart\Core\Dao\ModelUtil::insertAll('member_group', array(array('title' => '普通用户', 'description' => '', 'isDefault' => true), array('title' => '高级用户', 'description' => '', 'isDefault' => false))); goto oztN3; zw7kG: Schema::create('member_group', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->string('title', 50)->nullable()->comment('名称'); $qNtCk->string('description', 200)->nullable()->comment('描述'); $qNtCk->tinyInteger('isDefault')->nullable()->comment('默认'); }); goto a6_3C; a6_3C: Schema::table('member_user', function (Blueprint $qNtCk) { $qNtCk->integer('groupId')->nullable()->comment(''); }); goto R6BIU; oztN3: } public function down() { } }