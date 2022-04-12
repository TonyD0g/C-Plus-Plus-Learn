<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Web\Controller; use ModStart\Admin\Widget\DashboardItemA; use ModStart\App\Web\Layout\WebPage; use ModStart\Layout\Row; use ModStart\Widget\Box; use Module\Member\Config\MemberHomeIcon; use Module\Member\Support\MemberLoginCheck; class MemberController extends MemberFrameController implements MemberLoginCheck { public function index(WebPage $ZcuyS) { goto ofwxl; ofwxl: $ZcuyS->view('module::Member.View.pc.member.index'); goto m9dbT; Szy3r: return $ZcuyS; goto KRZxE; dXvNc: $ZcuyS->pageTitle('我的'); goto Szy3r; m9dbT: foreach (MemberHomeIcon::get() as $VfQYR) { $ZcuyS->append(Box::make(new Row(function (Row $sfPWW) use($VfQYR) { foreach ($VfQYR['children'] as $aKA5T) { $sfPWW->column(array('md' => 2, '' => 4), DashboardItemA::makeIconTitleLink($aKA5T['icon'], $aKA5T['title'], $aKA5T['url'])); } }), $VfQYR['title'], 'transparent')); } goto dXvNc; KRZxE: } }