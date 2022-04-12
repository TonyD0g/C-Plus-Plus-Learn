<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateLazyValue extends Migration { public function up() { Schema::create('lazy_value', function (Blueprint $qNtCk) { $qNtCk->increments('id'); $qNtCk->timestamps(); $qNtCk->string('key', 50)->nullable()->comment(''); $qNtCk->string('param', 100)->nullable()->comment(''); $qNtCk->integer('expire')->nullable()->comment(''); $qNtCk->integer('lifeExpire')->nullable()->comment(''); $qNtCk->integer('cacheSeconds')->nullable()->comment(''); $qNtCk->text('value')->nullable()->comment(''); $qNtCk->unique(array('key', 'param')); $qNtCk->index(array('expire')); $qNtCk->index(array('lifeExpire')); }); } public function down() { } }