<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Log; class Logger { private static function write($JJGcw, $nKLrL, $CAe7G, $mgOoi) { goto bH2uv; vTuZh: @file_put_contents(storage_path("logs/{$JJGcw}_{$nKLrL}_" . date('Ymd') . '.log'), $cjNAq . '
', FILE_APPEND); goto y6zMo; y6zMo: return $cjNAq; goto X8Lwg; zobZp: $cjNAq = '[' . sprintf('%05d', getmypid()) . '] ' . date('Y-m-d H:i:s') . " - {$CAe7G}" . ($mgOoi ? " - {$mgOoi}" : ''); goto vTuZh; bH2uv: if (!is_string($mgOoi)) { $mgOoi = json_encode($mgOoi, JSON_UNESCAPED_UNICODE); } goto zobZp; X8Lwg: } public static function info($JJGcw, $CAe7G, $mgOoi = '') { return self::write($JJGcw, 'info', $CAe7G, $mgOoi); } public static function error($JJGcw, $CAe7G, $mgOoi = '') { return self::write($JJGcw, 'error', $CAe7G, $mgOoi); } }