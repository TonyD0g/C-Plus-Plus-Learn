<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Oauth; use ModStart\Core\Input\Response; use Module\Member\Util\MemberUtil; abstract class AbstractOauth { public function hasRender() { return true; } public function isSupport() { return true; } public function title() { return $this->name(); } public abstract function name(); public abstract function render(); public abstract function processRedirect($HAqS9); public abstract function processLogin($HAqS9); public function processTryLogin($HAqS9) { goto JNms2; JNms2: $Z1qO5 = $HAqS9['userInfo']; goto CC9jO; CC9jO: $pot3B = $Z1qO5['openid']; goto qLo8E; PUHJH: return Response::generateSuccessData(array('memberUserId' => 0)); goto MGQFQ; qLo8E: $H7GUl = MemberUtil::getIdByOauthAndCheck($this->name(), $pot3B); goto e43Nc; e43Nc: if ($H7GUl) { return Response::generateSuccessData(array('memberUserId' => $H7GUl)); } goto PUHJH; MGQFQ: } public function processBindToUser($HAqS9) { goto utQva; f8t_W: MemberUtil::putOauth($H7GUl, $this->name(), $Z1qO5['openid'], $iNjgR); goto NdTej; utQva: $H7GUl = $HAqS9['memberUserId']; goto ni1UX; I4hSe: $DRfwW = MemberUtil::getIdByOauthAndCheck($this->name(), $Z1qO5['openid']); goto Jdp3p; sctXG: if (!empty($Z1qO5['avatar'])) { $iNjgR['infoAvatar'] = $Z1qO5['avatar']; } goto f8t_W; ni1UX: $Z1qO5 = $HAqS9['userInfo']; goto I4hSe; Jdp3p: if ($DRfwW && $H7GUl != $DRfwW) { MemberUtil::forgetOauth($this->name(), $Z1qO5['openid']); } goto soHZB; Mm10C: if (!empty($Z1qO5['username'])) { $iNjgR['infoUsername'] = $Z1qO5['username']; } goto sctXG; soHZB: $iNjgR = array(); goto Mm10C; NdTej: return Response::generateSuccess(); goto PoYMV; PoYMV: } }