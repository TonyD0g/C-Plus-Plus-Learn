<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace App\Api\Controller; use ModStart\Core\Assets\AssetsUtil; use ModStart\Core\Input\Response; use Module\Member\Auth\MemberUser; use Module\Member\Auth\MemberVip; class ConfigController extends BaseController { public function constant() { goto P4pbg; GjG83: $anR44 = array(); goto Bs0Uc; zkQ88: return Response::raw(join('
', $anR44), array('Content-Type' => 'text/plain')); goto O_b0T; L6rHn: foreach ($pOc22 as $mKs1o => $spDBN) { $anR44[] = "export const {$mKs1o} = " . json_encode($spDBN, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . ';'; } goto zkQ88; Bs0Uc: $anR44[] = '// This file is created by ' . action('\\' . __CLASS__ . '@constant') . '
'; goto L6rHn; P4pbg: $pOc22 = array(); goto GjG83; O_b0T: } public function app() { goto sW2GN; fqYet: return Response::jsonSuccessData($iLjtx); goto lwbdX; sW2GN: $iLjtx = array(); goto l83H1; sva7j: if (MemberUser::id()) { goto gYeqR; gYeqR: $bZSTz = MemberUser::user(); goto BY31a; mi7MS: if (empty($iLjtx['user']['nickname'])) { $iLjtx['user']['nickname'] = $iLjtx['user']['username']; } goto ah8sE; ApmAs: $iLjtx['user']['emailVerified'] = !!$bZSTz['emailVerified']; goto Sl77n; LyJ2U: $iLjtx['user']['phoneVerified'] = !!$bZSTz['phoneVerified']; goto z6KMZ; Sl77n: $iLjtx['user']['vip'] = MemberVip::get(); goto sKPXU; tvpcR: $iLjtx['user']['avatarBig'] = AssetsUtil::fixFull($bZSTz['avatarBig'] ? $bZSTz['avatarBig'] : $iLjtx['user']['avatar']); goto mkk6V; z6KMZ: $iLjtx['user']['email'] = $bZSTz['email']; goto ApmAs; xp0b0: $iLjtx['user']['nickname'] = empty($bZSTz['nickname']) ? null : $bZSTz['nickname']; goto mi7MS; mkk6V: $iLjtx['user']['username'] = $bZSTz['username']; goto xp0b0; sKPXU: $iLjtx['user']['vipExpire'] = $bZSTz['vipExpire']; goto pW05Z; aXRUK: $iLjtx['user']['avatarMedium'] = AssetsUtil::fixFull($bZSTz['avatarMedium'] ? $bZSTz['avatarMedium'] : $iLjtx['user']['avatar']); goto tvpcR; BY31a: $iLjtx['user']['id'] = $bZSTz['id']; goto ffnEn; ah8sE: $iLjtx['user']['phone'] = $bZSTz['phone']; goto LyJ2U; ffnEn: $iLjtx['user']['avatar'] = AssetsUtil::fixFull($bZSTz['avatar'] ? $bZSTz['avatar'] : $iLjtx['user']['avatar']); goto aXRUK; pW05Z: } goto fqYet; Met5X: $iLjtx['hashLazyValue'] = array(); goto kdx0A; fzauC: $iLjtx['user'] = array('id' => 0, 'avatar' => AssetsUtil::fixFull('asset/image/avatar.png'), 'avatarMedium' => AssetsUtil::fixFull('asset/image/avatar.png'), 'avatarBig' => AssetsUtil::fixFull('asset/image/avatar.png'), 'nickname' => '', 'username' => '', 'phone' => '', 'phoneVerified' => false, 'email' => '', 'emailVerified' => false, 'vip' => null, 'vipExpire' => null); goto sva7j; O9xI3: $YASd6 = date('Ymd_His', filemtime($this->viewRealpath($AvHWy))); goto SQmRd; l83H1: list($AvHWy, $uJLGM) = $this->viewPaths('index'); goto O9xI3; SQmRd: $iLjtx['hashPC'] = 'v' . $YASd6; goto Met5X; kdx0A: $iLjtx['auth'] = array('rules' => array()); goto fzauC; lwbdX: } }