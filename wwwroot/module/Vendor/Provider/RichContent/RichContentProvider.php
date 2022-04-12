<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Module\Vendor\Provider\RichContent\AbstractRichContentProvider; use Module\Vendor\Provider\RichContent\UEditorRichContentProvider; class RichContentProvider { private static $instances = array(UEditorRichContentProvider::class); public static function register($Y2SRS) { self::$instances[] = $Y2SRS; } public static function all() { foreach (self::$instances as $Zc0iK => $aEiYS) { if ($aEiYS instanceof \Closure) { self::$instances[$Zc0iK] = call_user_func($aEiYS); } else { if (is_string($aEiYS)) { self::$instances[$Zc0iK] = app($aEiYS); } } } return self::$instances; } public static function getByName($Ut_Gf) { foreach (self::all() as $tJxVf) { if ($tJxVf->name() == $Ut_Gf) { return $tJxVf; } } return null; } }