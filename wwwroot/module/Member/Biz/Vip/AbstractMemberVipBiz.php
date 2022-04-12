<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Biz\Vip; use ModStart\Support\Concern\HasFields; abstract class AbstractMemberVipBiz { public abstract function name(); public abstract function title(); public function vipField($bhaAK) { } }