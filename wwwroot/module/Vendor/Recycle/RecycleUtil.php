<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Recycle; use ModStart\Core\Dao\ModelUtil; class RecycleUtil { public static function tableAdd($qNtCk, $Lu2Y9, $hRWBB) { ModelUtil::insert('recycle_table', array('table' => $qNtCk, 'tableId' => $Lu2Y9, 'content' => json_encode($hRWBB))); } }