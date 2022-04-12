<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Util; use Illuminate\Support\Facades\Cache; use ModStart\Core\Dao\ModelUtil; use Module\Article\Type\ArticlePosition; class ArticleUtil { const CACHE_KEY_PREFIX = 'article:'; public static function get($DRfwW) { return ModelUtil::get('article', $DRfwW); } public static function getByAlias($PicHS) { return ModelUtil::get('article', array('alias' => $PicHS)); } public static function listByPosition($T_4Ez = 'home') { return ModelUtil::model('article')->where(array('position' => $T_4Ez))->orderBy('sort', 'asc')->get()->toArray(); } public static function listByPositionWithCache($T_4Ez = 'home', $zbPZ9 = 600) { return Cache::remember(self::CACHE_KEY_PREFIX . $T_4Ez, $zbPZ9, function () use($T_4Ez) { return self::listByPosition($T_4Ez); }); } public static function clearCache() { foreach (ArticlePosition::getList() as $Zc0iK => $nRAaS) { Cache::forget(self::CACHE_KEY_PREFIX . $Zc0iK); } } }