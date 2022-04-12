<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\HomePage; abstract class AbstractHomePageProvider { const TYPE_PC = 'pc'; const TYPE_MOBILE = 'mobile'; public function type() { return self::TYPE_PC; } public abstract function title(); public abstract function action(); }