<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LiveStream; abstract class AbstractLiveStreamProvider { public abstract function name(); public abstract function title(); public abstract function getPushUrl($kmyjr, $y3kQX, $HAqS9 = array()); public abstract function getPlayUrl($kmyjr, $y3kQX, $HAqS9 = array()); }