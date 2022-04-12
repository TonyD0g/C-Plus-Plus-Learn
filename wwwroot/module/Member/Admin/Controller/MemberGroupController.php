<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Concern\HasAdminQuickCRUD; use ModStart\Admin\Layout\AdminCRUDBuilder; use ModStart\Form\Form; use ModStart\Grid\GridFilter; use ModStart\Support\Concern\HasFields; use Module\Member\Util\MemberGroupUtil; class MemberGroupController extends Controller { use HasAdminQuickCRUD; protected function crud(AdminCRUDBuilder $bhaAK) { $bhaAK->init('member_group')->field(function ($bhaAK) { $bhaAK->id('id', 'ID')->editable(true)->addable(true); $bhaAK->text('title', '名称'); $bhaAK->text('description', '描述'); $bhaAK->switch('isDefault', '默认')->optionsYesNo()->help(''); $bhaAK->switch('showFront', '前台显示')->optionsYesNo()->help(''); $bhaAK->display('created_at', L('Created At'))->listable(false); $bhaAK->display('updated_at', L('Updated At'))->listable(false); })->gridFilter(function (GridFilter $P2EU9) { $P2EU9->like('title', '名称'); })->enablePagination(false)->defaultOrder(array('id', 'asc'))->canSort(true)->title('会员分组')->dialogSizeSmall()->hookSaved(function (Form $mUGak) { MemberGroupUtil::clearCache(); }); $bhaAK->repository()->setSortColumn('id'); } }