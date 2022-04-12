<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ goto h7Boj; UwzZ4: function shell_throws_if($mgOoi, $Ybj2d) { if ($Ybj2d) { shell_echo_error($mgOoi); die(-1); } } goto UBdrO; aygm2: include __DIR__ . '/../../../vendor/modstart/modstart/src/Core/Util/ReUtil.php'; goto r36Rt; X5hXy: function shell_echo_info($mgOoi) { echo "[36m>>>>> INFO  : {$mgOoi} [0m\n"; } goto UwzZ4; UBdrO: function shell_command_check($OWM9v) { @exec($OWM9v, $BZpIf, $mW7Vi); return $mW7Vi === 0; } goto VrP6q; r36Rt: function shell_module_base() { return realpath(__DIR__ . '/../..'); } goto o41Bg; VrlSo: function shell_echo_block($mgOoi) { goto b0eOC; QdOE7: echo ' ' . str_repeat('-', 80) . '
'; goto rW1kI; Ct7dt: echo sprintf('| %-79s|', $mgOoi) . '
'; goto QdOE7; b0eOC: echo '
[33m'; goto GHN0U; GHN0U: echo ' ' . str_repeat('-', 80) . '
'; goto Ct7dt; rW1kI: echo '[0m'; goto HfxBx; HfxBx: } goto JrrFq; ehA2L: function shell_ensure_dir($sBxtO) { if (!file_exists($sBxtO)) { mkdir($sBxtO, 493, true); } } goto VrlSo; UfSLz: function shell_echo_success($mgOoi) { echo "[32m>>>>> INFO  : {$mgOoi} [0m\n"; } goto X5hXy; o41Bg: function shell_module_path($VLCiR, $qlLI1) { return join('/', array(rtrim(shell_module_base(), '/'), $VLCiR, $qlLI1)); } goto ehA2L; h7Boj: include __DIR__ . '/../../../vendor/modstart/modstart/src/Core/Util/PlatformUtil.php'; goto aygm2; JrrFq: function shell_echo_error($mgOoi) { echo "[31m>>>>> ERROR : {$mgOoi} [0m\n"; } goto UfSLz; VrP6q: function shell_file_write($Jcilr, $HvAUu) { goto vX1ST; sjkis: if (!file_exists($sBxtO)) { mkdir($sBxtO, 493, true); } goto xazy_; xazy_: file_put_contents($Jcilr, $HvAUu); goto DWBDb; vX1ST: $sBxtO = dirname($Jcilr); goto sjkis; DWBDb: }