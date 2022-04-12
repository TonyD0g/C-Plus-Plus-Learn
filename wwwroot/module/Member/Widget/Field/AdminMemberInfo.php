<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Widget\Field; use ModStart\Field\AbstractField; use ModStart\Field\Text; use ModStart\Field\Type\FieldRenderMode; use Module\Member\Util\MemberCmsUtil; class AdminMemberInfo extends Text { protected $view = 'modstart::core.field.text'; protected $editable = false; public function renderView(AbstractField $sfBE1, $KdsT8, $D01Cg = 0) { switch ($sfBE1->renderMode()) { case FieldRenderMode::GRID: case FieldRenderMode::DETAIL: $this->hookRendering(function (AbstractField $sfBE1, $KdsT8, $D01Cg) { $iVzc5 = $sfBE1->column(); return MemberCmsUtil::showFromId($KdsT8->{$iVzc5}); }); } return parent::renderView($sfBE1, $KdsT8, $D01Cg); } }