<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Site\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Layout\AdminConfigBuilder; use Module\Vendor\Provider\SiteTemplate\SiteTemplateProvider; class ConfigController extends Controller { public function setting(AdminConfigBuilder $bhaAK) { goto kI5P5; HH7MZ: $bhaAK->image('siteFavIco', '网站ICO'); goto h4bqk; i719N: $bhaAK->text('siteBeian', '备案编号'); goto HH7MZ; E5yMp: $bhaAK->text('siteName', '网站名称'); goto Dhe2e; kI5P5: $bhaAK->pageTitle('基础设置'); goto RTJao; K4LpF: $bhaAK->text('siteDomain', '网站域名'); goto lxE_l; QqH8b: $bhaAK->select('siteTemplate', '网站模板')->options(SiteTemplateProvider::map()); goto NBG4g; Dhe2e: $bhaAK->text('siteSlogan', '网站副标题'); goto K4LpF; Jho3d: $bhaAK->textarea('siteDescription', '网站描述'); goto i719N; h4bqk: $bhaAK->color('sitePrimaryColor', '网站主色调'); goto QqH8b; NBG4g: return $bhaAK->perform(); goto dkkjk; lxE_l: $bhaAK->text('siteKeywords', '网站关键词'); goto Jho3d; RTJao: $bhaAK->image('siteLogo', '网站Logo'); goto E5yMp; dkkjk: } }