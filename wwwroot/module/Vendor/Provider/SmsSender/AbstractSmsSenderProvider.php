<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SmsSender; abstract class AbstractSmsSenderProvider { public abstract function name(); public abstract function send($dEdul, $RJldp, $hoD52, $HAqS9 = array()); }