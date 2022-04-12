<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\IDManager; abstract class AbstractIDManager { public abstract function name(); public abstract function all(); public abstract function add($JBiwJ); public abstract function remove($JBiwJ); public abstract function total(); public abstract function paginate($ZcuyS, $iy20Z); public abstract function paginateRandom($ZcuyS, $iy20Z, $YcXMS = 'all', $MnwMt = 60); public abstract function forgetRandom($YcXMS = 'all'); }