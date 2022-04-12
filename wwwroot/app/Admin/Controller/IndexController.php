<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Admin\Controller; use Illuminate\Routing\Controller; use Module\Tecmz\Traits\AdminDashboardTrait; class IndexController extends Controller { use AdminDashboardTrait; public function index() { return $this->dashboard(); } }