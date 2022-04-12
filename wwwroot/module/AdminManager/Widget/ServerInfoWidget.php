<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\AdminManager\Widget; use ModStart\Widget\AbstractWidget; use Module\AdminManager\Util\ModuleUtil; class ServerInfoWidget extends AbstractWidget { protected $view = 'module::AdminManager.View.widget.serverInfo'; protected function variables() { $iAHW2 = get_loaded_extensions(); return array('modules' => ModuleUtil::modules(), 'attributes' => $this->formatAttributes(), 'phpExtensions' => $iAHW2); } }