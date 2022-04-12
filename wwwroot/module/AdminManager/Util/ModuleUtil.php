<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\AdminManager\Util; use ModStart\ModStart; use ModStart\Module\ModuleManager; class ModuleUtil { public static function modules() { goto zmQuC; iw0CK: $g7MAA[] = 'ModStart:' . ModStart::$version; goto z62q0; zmQuC: $g7MAA = array(); goto iw0CK; z62q0: foreach (ModuleManager::listAllEnabledModules() as $avQLM => $nRAaS) { $iNjgR = ModuleManager::getModuleBasic($avQLM); $g7MAA[] = "{$avQLM}:{$iNjgR['version']}"; } goto gscqE; gscqE: return $g7MAA; goto usgEH; usgEH: } }