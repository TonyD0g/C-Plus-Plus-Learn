<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\RichContent; use Illuminate\Support\Facades\View; use ModStart\Core\Util\HtmlUtil; use Module\Vendor\Html\HtmlConvertUtil; class UEditorRichContentProvider extends AbstractRichContentProvider { const NAME = 'htmlUEditor'; public function name() { return self::NAME; } public function title() { return 'UEditor富文本'; } public function render($Ut_Gf, $Xiug2, $HAqS9 = array()) { return View::make('module::Vendor.View.widget.richContent.htmlUeditor', array('name' => $Ut_Gf, 'value' => $Xiug2, 'param' => $HAqS9))->render(); } public function toHtml($Xiug2, $iaoPv = null) { $Xiug2 = HtmlUtil::filter2($Xiug2); return parent::toHtml($Xiug2, $iaoPv); } }