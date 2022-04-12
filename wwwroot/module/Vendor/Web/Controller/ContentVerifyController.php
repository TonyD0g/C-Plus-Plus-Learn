<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Web\Controller; use Illuminate\Routing\Controller; use ModStart\App\Web\Layout\WebPage; use ModStart\Core\Exception\BizException; use ModStart\Core\Input\InputPackage; use ModStart\Form\Form; use Module\Vendor\Provider\ContentVerify\ContentVerifyProvider; class ContentVerifyController extends Controller { public function index(WebPage $ZcuyS, $Ut_Gf) { goto FSN_Y; ZrgR1: return view('module::Vendor.View.contentVerify.index', array('content' => $mUGak->render(), 'pageTitle' => '审核 · ' . $Y2SRS->title())); goto bvTws; uio23: $HAqS9 = InputPackage::buildFromInputJson('param')->all(); goto p6iRJ; p6iRJ: $mUGak = Form::make(''); goto xSq0j; ezh_m: BizException::throwsIfEmpty('数据异常', $Y2SRS); goto uio23; xSq0j: $mW7Vi = $Y2SRS->buildForm($mUGak, $HAqS9); goto UN7Ed; UN7Ed: if (null !== $mW7Vi) { return $mW7Vi; } goto ZrgR1; FSN_Y: $Y2SRS = ContentVerifyProvider::get($Ut_Gf); goto ezh_m; bvTws: } }