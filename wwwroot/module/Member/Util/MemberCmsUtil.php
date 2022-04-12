<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Util; use ModStart\Core\Assets\AssetsUtil; use ModStart\Core\Dao\ModelUtil; use ModStart\Field\AutoRenderedFieldValue; class MemberCmsUtil { public static function showFromId($H7GUl) { goto AECkC; AECkC: if (!$H7GUl) { return AutoRenderedFieldValue::make('<span class="ub-text-muted">-</span>'); } goto tNlAA; tNlAA: $qe8fj = ModelUtil::getWithCache('member_user', array('id' => $H7GUl)); goto J79Vx; J79Vx: return self::show($qe8fj); goto DpKmD; DpKmD: } public static function show($qe8fj) { if (!empty($qe8fj)) { return AutoRenderedFieldValue::make('<a href="javascript:;" class="ub-icon-text" data-dialog-request="' . action('\\Module\\Member\\Admin\\Controller\\MemberController@show', array('_id' => $qe8fj['id'])) . '">
            <img class="icon" src="' . AssetsUtil::fixOrDefault($qe8fj['avatar'], 'asset/image/avatar.png') . '" />
            <span class="text">' . htmlspecialchars($qe8fj['username']) . '</span></a>'); } return AutoRenderedFieldValue::make(''); } }