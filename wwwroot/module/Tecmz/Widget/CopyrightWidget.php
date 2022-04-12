<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Tecmz\Widget; use ModStart\Widget\AbstractWidget; class CopyrightWidget extends AbstractWidget { protected $view = 'module::Tecmz.View.widget.copyright'; protected function variables() { return array('attributes' => $this->formatAttributes()); } }