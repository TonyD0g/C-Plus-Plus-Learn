<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RandomImage; use ModStart\Core\Assets\AssetsUtil; class DefaultRandomImageProvider extends AbstractRandomImageProvider { public function get($HAqS9 = array()) { return array('url' => AssetsUtil::fix('asset/image/none.png'), 'width' => 400, 'height' => 400); } }