<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Sms; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\Response; use Module\Vendor\Provider\SmsSender\SmsSenderProvider; use Module\Vendor\SoftApi\SoftApi; class SmsUtil { public static function calcNumber($HvAUu) { return ceil(mb_strlen($HvAUu) / 67); } public static function parseContent($RJldp, $pF7ZJ = array()) { goto dZrcx; pi6zv: foreach ($pF7ZJ as $Zc0iK => $aEiYS) { $dQC49[] = '{' . $Zc0iK . '}'; $yMLOx[] = $aEiYS; } goto abt9j; EWbos: $yMLOx = array(); goto pi6zv; abt9j: return str_replace($dQC49, $yMLOx, $RJldp); goto O_28p; dZrcx: $dQC49 = array(); goto EWbos; O_28p: } public static function parseTemplateParam($RJldp) { preg_match_all('/\\{(.*?)\\}/', $RJldp, $pov6U); return $pov6U[1]; } public static function replaceTemplate($RJldp, $DoySS = '#') { goto h6rqN; h6rqN: $HAqS9 = self::parseTemplateParam($RJldp); goto dJaUX; dJaUX: foreach ($HAqS9 as $aEiYS) { if (is_string($DoySS)) { $RJldp = str_replace('{' . $aEiYS . '}', $DoySS . $aEiYS . $DoySS, $RJldp); } else { $RJldp = str_replace('{' . $aEiYS . '}', call_user_func($DoySS, $aEiYS), $RJldp); } } goto Ito9Y; Ito9Y: return $RJldp; goto ENFv3; ENFv3: } public static function templates() { $vrBJm = array(array('name' => 'verify', 'title' => '验证码', 'desc' => '验证码模板变量为 code')); return $vrBJm; } public static function send($dEdul, $RJldp, $hoD52 = array()) { goto UWTHM; QhBXL: return Response::generateSuccess(); goto atYZs; UWTHM: $Y2SRS = app()->config->get('SmsSenderProvider'); goto MI2nG; zmGMF: BizException::throwsIfResponseError($mW7Vi); goto QhBXL; MI2nG: BizException::throwsIfEmpty('短信发送未配置', $Y2SRS); goto imw4g; imw4g: $mW7Vi = SmsSenderProvider::get($Y2SRS)->send($dEdul, $RJldp, $hoD52); goto zmGMF; atYZs: } }