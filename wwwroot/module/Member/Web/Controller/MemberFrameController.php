<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use Illuminate\Support\Facades\View; use ModStart\Module\ModuleBaseController; class MemberFrameController extends ModuleBaseController { protected $viewMemberFrame; public function __construct() { list($this->viewMemberFrame, $nRAaS) = $this->viewPaths('member.frame'); View::share('_viewMemberFrame', $this->viewMemberFrame); } }