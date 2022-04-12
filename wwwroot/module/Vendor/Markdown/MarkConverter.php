<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Markdown; use League\CommonMark\CommonMarkConverter; use League\CommonMark\Environment; use Webuni\CommonMark\TableExtension\TableExtension; class MarkConverter extends CommonMarkConverter { public function __construct(array $tu0B0 = array(), Environment $lY3DB = null) { goto f1oei; k99JA: parent::__construct($tu0B0, $lY3DB); goto nvWQq; h6BMv: $lY3DB->addExtension(new TableExtension()); goto k99JA; f1oei: $lY3DB = Environment::createCommonMarkEnvironment(); goto h6BMv; nvWQq: } }