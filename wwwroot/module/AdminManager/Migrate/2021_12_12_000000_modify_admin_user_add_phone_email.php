<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; class ModifyAdminUserAddPhoneEmail extends Migration { public function up() { $Q1nVT = config('modstart.admin.database.connection') ?: config('database.default'); Schema::connection($Q1nVT)->table('admin_user', function (Blueprint $qNtCk) { $qNtCk->string('phone', 11)->comment('')->nullable(); $qNtCk->string('email', 100)->comment('')->nullable(); $qNtCk->unique('phone'); $qNtCk->unique('email'); }); } public function down() { } }