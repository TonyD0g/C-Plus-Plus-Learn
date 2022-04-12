<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Provider\ContentVerify; use ModStart\Core\Job\BaseJob; class ContentVerifyJob extends BaseJob { public $name; public $title; public $body; public $param; public static function create($Ut_Gf, $HAqS9, $IIIcx, $gKSAy = null) { goto XL8I0; PBkCd: $FRS1x->name = $Ut_Gf; goto hwOHa; oYM3e: $FRS1x->title = $IIIcx; goto DNRYt; hwOHa: $FRS1x->param = $HAqS9; goto oYM3e; XL8I0: $FRS1x = new static(); goto PBkCd; DNRYt: $FRS1x->body = $gKSAy; goto Fm2qj; Fm2qj: app('Illuminate\\Contracts\\Bus\\Dispatcher')->dispatch($FRS1x); goto gZs1x; gZs1x: } public function handle() { $Y2SRS = ContentVerifyProvider::get($this->name); $Y2SRS->run($this->param, $this->title, $this->body); } }