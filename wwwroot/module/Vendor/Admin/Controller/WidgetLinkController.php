<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Core\Dao\ModelManageUtil; use ModStart\Core\Dao\ModelUtil; use ModStart\Core\Util\TreeUtil; use ModStart\Module\ModuleManager; use Module\Vendor\Admin\Config\AdminWidgetLink; class WidgetLinkController extends Controller { public static $PermitMethodMap = array('*' => '*'); private function build($Kbszs, $Ra67r) { if (empty($Ra67r)) { return null; } return array('title' => $Kbszs, 'list' => array_filter(array_map(function ($KdsT8) { return $KdsT8 ? array('title' => $KdsT8[0], 'link' => $KdsT8[1]) : null; }, $Ra67r))); } public function select() { goto sXmdf; sXmdf: $VoVPx = array(); goto cvF4k; lcaI5: return view('modstart::admin.dialog.linkSelector', array('links' => array_filter($VoVPx))); goto nTnzG; swYQ4: $VoVPx = array_merge($VoVPx, AdminWidgetLink::get()); goto lcaI5; cvF4k: $VoVPx[] = $this->build('系统', array(array('首页', modstart_web_url('')))); goto swYQ4; nTnzG: } }