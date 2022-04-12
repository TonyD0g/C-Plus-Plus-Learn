<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Nav\Type; class NavLink { public static function generate($Ciba6, $HAqS9 = array()) { goto RPnL1; RPnL1: if (empty($Ciba6)) { return ''; } goto EBc4B; tD117: if (!empty($HAqS9)) { $WGpnh = array_map(function ($KdsT8) { return '{' . $KdsT8 . '}'; }, array_keys($HAqS9)); $Ciba6 = str_replace($WGpnh, array_values($HAqS9), $Ciba6); } goto zX7Nv; EBc4B: if (is_array($Ciba6)) { $Ciba6 = isset($Ciba6['link']) ? $Ciba6['link'] : null; } goto tD117; zX7Nv: return $Ciba6; goto xMfO1; xMfO1: } }