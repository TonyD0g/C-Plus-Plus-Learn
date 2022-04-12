<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Util; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\Request; use ModStart\Core\Util\RandomUtil; class NoneLoginOperateUtil { public static function generateUrl($K2Mwf, $HAqS9 = array()) { goto YKo0Q; apeP5: return Request::domainUrl() . modstart_web_url($K2Mwf, $Puxct); goto eRBpk; YKo0Q: $Puxct = array(); goto ylWAB; ylWAB: $Puxct['timestamp'] = time(); goto uo7th; TkA06: $Puxct['param'] = json_encode($HAqS9); goto BZhNg; uo7th: $Puxct['nonce'] = RandomUtil::string(10); goto TkA06; BZhNg: $Puxct['sign'] = self::sign($K2Mwf, $Puxct['nonce'], $Puxct['timestamp'], $Puxct['param']); goto apeP5; eRBpk: } public static function sign($K2Mwf, $NN5ns, $dVL9O, $HAqS9) { goto wvCS5; wvCS5: $MC61s = config('env.APP_KEY'); goto CG0hj; CG0hj: BizException::throwsIfEmpty('APP_KEY为空', $MC61s); goto jti8A; jti8A: return md5($K2Mwf . ':' . $MC61s . ':' . $NN5ns . ':' . $dVL9O . ':' . $HAqS9); goto IpmMK; IpmMK: } }