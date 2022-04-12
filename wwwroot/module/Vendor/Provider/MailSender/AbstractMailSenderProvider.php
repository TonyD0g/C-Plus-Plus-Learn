<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\MailSender; abstract class AbstractMailSenderProvider { public abstract function name(); public abstract function send($plRSP, $kj_IW, $CTO0l, $HvAUu, $HAqS9 = array()); }