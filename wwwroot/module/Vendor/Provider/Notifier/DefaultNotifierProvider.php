<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\Notifier; use Illuminate\Support\Facades\Log; class DefaultNotifierProvider extends AbstractNotifierProvider { public function notify($HLJws, $IIIcx, $HvAUu, $HAqS9 = array()) { Log::info(sprintf('DefaultNotifierProvider - %s - %s - %s', $HLJws, $IIIcx, json_encode($HvAUu, JSON_UNESCAPED_UNICODE))); } }