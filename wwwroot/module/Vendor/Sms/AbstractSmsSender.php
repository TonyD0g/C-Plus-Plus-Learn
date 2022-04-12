<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Sms; abstract class AbstractSmsSender { protected abstract function sendExecute($dEdul, $RJldp, $hoD52, $HAqS9 = array()); public function send($dEdul, $RJldp, $hoD52, $HAqS9 = array()) { return $this->sendExecute($dEdul, $RJldp, $hoD52, $HAqS9); } }