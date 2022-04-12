<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Web\Controller; use Illuminate\Routing\Controller; use Illuminate\Support\Facades\Response; use Intervention\Image\Facades\Image; class PlaceholderController extends Controller { public function index($a_wkR, $TCXu1) { goto ljM6d; JJe9F: return Response::make($HpEV4->encode('png'))->header('Content-Type', 'image/png'); goto tOl2l; jMUnY: $HpEV4->text($a_wkR . 'x' . $TCXu1, $a_wkR / 2, $TCXu1 / 2, function ($exsV2) use($a_wkR, $TCXu1) { $Gm0r1 = min($a_wkR, $TCXu1) / 10; $exsV2->size($Gm0r1); $exsV2->color('#666666'); $exsV2->align('center'); $exsV2->valign('center'); }); goto JJe9F; ljM6d: $a_wkR = min($a_wkR, 2000); goto h_E2e; U_QfW: $TCXu1 = max($TCXu1, 10); goto IXnkt; IXnkt: $HpEV4 = Image::canvas($a_wkR, $TCXu1, '#CCC'); goto jMUnY; h_E2e: $a_wkR = max($a_wkR, 10); goto VYQo8; VYQo8: $TCXu1 = min($TCXu1, 2000); goto U_QfW; tOl2l: } }