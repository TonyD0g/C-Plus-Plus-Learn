<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use ModStart\Module\ModuleBaseController; class PageController extends ModuleBaseController { public function agreement() { return $this->view('member.page', array('pageTitle' => modstart_config('Member_AgreementTitle'), 'pageContent' => modstart_config('Member_AgreementContent'))); } public function privacy() { return $this->view('member.page', array('pageTitle' => modstart_config('Member_PrivacyTitle'), 'pageContent' => modstart_config('Member_PrivacyContent'))); } }