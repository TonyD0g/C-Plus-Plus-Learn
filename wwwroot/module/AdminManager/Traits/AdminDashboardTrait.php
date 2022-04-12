<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\AdminManager\Traits; use ModStart\Admin\Layout\AdminPage; use ModStart\Admin\Widget\SecurityTooltipBox; use ModStart\Layout\Row; use Module\AdminManager\Widget\ServerInfoWidget; use Module\Vendor\Admin\Config\AdminWidgetDashboard; trait AdminDashboardTrait { public function dashboard() { goto pnc6e; yvXyF: return $ZcuyS; goto eJhDS; pnc6e: $ZcuyS = app(AdminPage::class); goto WIwTP; WIwTP: $ZcuyS->pageTitle(L('Dashboard'))->row(new SecurityTooltipBox())->append(new Row(function (Row $sfPWW) { AdminWidgetDashboard::callIcon($sfPWW); })); goto Iw_KM; UlRHk: $ZcuyS->append(new ServerInfoWidget()); goto yvXyF; Iw_KM: AdminWidgetDashboard::call($ZcuyS); goto UlRHk; eJhDS: } }