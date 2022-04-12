<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Widget\Field; use ModStart\Field\Image; class MemberImage extends Image { protected $view = 'modstart::core.field.image'; protected function setup() { parent::setup(); $this->addVariables(array('server' => modstart_web_url('member_data/file_manager/image'))); } }