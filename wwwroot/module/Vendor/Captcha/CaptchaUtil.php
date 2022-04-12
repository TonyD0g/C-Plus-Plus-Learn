<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Captcha; class CaptchaUtil { public static function get() { goto tPs52; Oiz2o: if (null === $tJxVf) { goto QUMlS; QUMlS: $pnvZA = config('CaptchaProviderDriver'); goto z9OgD; TDooe: $tJxVf = app($pnvZA); goto oaBuM; z9OgD: if (empty($pnvZA)) { $pnvZA = DefaultCaptchaProvider::class; } goto TDooe; oaBuM: } goto d04s_; d04s_: return $tJxVf; goto a85BB; tPs52: static $tJxVf = null; goto Oiz2o; a85BB: } }