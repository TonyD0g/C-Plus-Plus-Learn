<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RandomImage; class RandomImageProvider { public static function get() { goto g_y4y; L5F5r: return $tJxVf; goto OlIST; g_y4y: static $tJxVf = null; goto LDkXH; LDkXH: if (null === $tJxVf) { goto LU8Em; r3iNx: $tJxVf = app($pnvZA); goto LhEe1; LU8Em: $pnvZA = config('RandomImageProvider'); goto n0d4n; n0d4n: if (empty($pnvZA)) { $pnvZA = DefaultRandomImageProvider::class; } goto r3iNx; LhEe1: } goto L5F5r; OlIST: } public static function getImage($HLJws = '', $HAqS9 = array()) { return self::get()->get(array_merge(array('biz' => $HLJws), $HAqS9)); } }