<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\SiteTemplate; abstract class AbstractSiteTemplateProvider { public abstract function name(); public abstract function title(); public function root() { return null; } }