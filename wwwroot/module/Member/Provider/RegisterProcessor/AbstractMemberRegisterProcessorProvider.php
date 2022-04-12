<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Provider\RegisterProcessor; abstract class AbstractMemberRegisterProcessorProvider { public abstract function name(); public abstract function title(); public abstract function render(); public abstract function preCheck(); public abstract function postProcess($H7GUl); }