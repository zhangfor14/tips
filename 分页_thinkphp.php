<?php
/**
 * 分页
 *
 * @param array $count ： 总记录条数
 * @param array $listRows ： 单页显示数据数
 * @param array $parameter ： 分页跳转的参数
 */
function get_page($count,$listRows = '',$parameter = array())
{
	if(! $listRows)
	{
		$listRows = C('PER_PAGE_NUMBER') ? C('PER_PAGE_NUMBER') : 10;
	}
    $page = new \Tools\Page($count, $listRows ,$parameter);
    // 设置样式
    $page->lastSuffix = false;//最后一页是否显示总页数
    $page->setConfig('prev', '<span aria-hidden="true">上一页</span>');
    $page->setConfig('next', '<span aria-hidden="true">下一页</span>');
    $page->setConfig('first', '<span aria-hidden="true">第一页</span>');
    $page->setConfig('last', '<span aria-hidden="true">最后一页</span>');
    $page->setConfig('theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%页  共%TOTAL_ROW%条记录 每页%LIST_ROWS%条记录</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    // 生成翻页字符串，这个字符串要在页面中显示出来
    return array(
    		'pageString'  =>	$page->show(),
    		'firstRow'    =>	$page->firstRow < 0 ? 0 : $page->firstRow,//page类有问题,出现firstRow为-5情况,特此判断
    		'listRows'    =>	$page->listRows,
    	);
}



// $pageData['firstRow']       //起始行数
// $pageData['listRows']       //每页记录数
// $pageData['pageString']     //获取分页字符串

// 取某一页的数据
/***********排序条件********************************/
$order=I('order',NULL) ? I('order',NULL) : 'twc_id desc';
/**********查询条件开始*************************/
$where_package=where_package(I('',NULL),array('twc_workingstage','like'=>'createdby'));
$where=$where_package['where'];
$parameter=$where_package['parameter'];
$where['isdeleted']=0;
$parameter['isdeleted']=0;
/*********get_page函数获取分页*********************/
$count = $this->where($where)->count();
$pageData = get_page($count,'',$parameter);
/************ 取某一页的数据 ********************/
$listData =$this
->where($where)
->limit($pageData['firstRow'] .','. $pageData['listRows'])
->order($order)
->select();

return array(
        'listData' => $listData,
        'pageString' => $pageData['pageString'],
    );

?>
//html页面中
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_full_numbers" id="table_server_paginate">
            <ul class="pagination">{$pageString}</ul>
        </div>
    </div>
</div>