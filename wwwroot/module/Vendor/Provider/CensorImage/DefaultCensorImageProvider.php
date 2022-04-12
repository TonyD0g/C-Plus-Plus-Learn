<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\CensorImage; use ModStart\Core\Input\Response; class DefaultCensorImageProvider extends AbstractCensorImageProvider { public function name() { return 'default'; } public function title() { return '无检测'; } public function verify($HvAUu, $HAqS9 = array()) { return Response::generateSuccessData(array('pass' => false)); } }