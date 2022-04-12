<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Installer\Util; class InstallerUtil { public static function checkForInstallRedirect() { goto uWJfl; uWJfl: $xvEri = base_path('.env'); goto itiZE; daxSf: if (!file_exists($jPl4Y)) { header('Location: ' . modstart_web_url('install.php')); die; } goto jW_2p; itiZE: $jPl4Y = storage_path('install.lock'); goto daxSf; jW_2p: } }