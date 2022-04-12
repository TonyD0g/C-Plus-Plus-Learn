<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Article\Web\Controller; use ModStart\Core\Input\Response; use ModStart\Core\Util\ArrayUtil; use ModStart\Module\ModuleBaseController; use Module\Article\Util\ArticleUtil; class ArticleController extends ModuleBaseController { public function views($DRfwW) { goto JGp1y; g9lOK: return $this->view($vvDaY, array('article' => $bhzej)); goto zzqwR; o2y9D: if ($bhzej['position'] == 'page' || empty($bhzej['position'])) { $vvDaY = 'article.viewPage'; } goto g9lOK; JGp1y: if (is_numeric($DRfwW)) { $bhzej = ArticleUtil::get($DRfwW); } else { $bhzej = ArticleUtil::getByAlias($DRfwW); } goto qO4CU; kNH46: $vvDaY = 'article.view'; goto o2y9D; qO4CU: if (empty($bhzej)) { return Response::page404(); } goto kNH46; zzqwR: } }