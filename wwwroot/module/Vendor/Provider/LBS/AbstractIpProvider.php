<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\LBS; abstract class AbstractIpProvider { public abstract function name(); public abstract function title(); public abstract function getLocation($GHiFq, $HAqS9 = array()); }