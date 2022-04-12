<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Tecmz\Traits; use ModStart\Admin\Layout\AdminPage; use ModStart\Admin\Widget\SecurityTooltipBox; use ModStart\Layout\Row; use Module\AdminManager\Widget\ServerInfoWidget; use Module\Tecmz\Widget\CopyrightWidget; use Module\Vendor\Admin\Config\AdminWidgetDashboard; trait AdminDashboardTrait { public function dashboard() { goto m8Aiq; mrAhD: $ZcuyS->pageTitle(L('Dashboard'))->row(new SecurityTooltipBox())->append(new Row(function (Row $sfPWW) { AdminWidgetDashboard::callTodo($sfPWW); }))->append(new Row(function (Row $sfPWW) { AdminWidgetDashboard::callIcon($sfPWW); })); goto hqFbr; ql0j4: $ZcuyS->append(new CopyrightWidget()); goto WQzZe; hqFbr: AdminWidgetDashboard::call($ZcuyS); goto ql0j4; PbQ2Z: return $ZcuyS; goto uC8sM; WQzZe: $ZcuyS->append(new ServerInfoWidget()); goto PbQ2Z; m8Aiq: $ZcuyS = app(AdminPage::class); goto mrAhD; uC8sM: } }