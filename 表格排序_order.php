<table class="table table-striped table-hover " id="tab">
    <thead>
        <tr>
            <th style="width: 1px">
                <input type="checkbox" onclick="SelectAll()" />
            </th>
            <!------------------------给要排序的字段添加field属性------------------------>
            <th field="team_id">ID</th>
            <!------------------------给要排序的字段添加field属性------------------------>
            <!--order-排序-->
            <input type="hidden" value="{$order}" name="order" id="order">
            <!--order-排序-->         
        </tr>
    </thead>
    <tbody>
        <volist  name="listData" id="vo">
        <tr>
            <td style="width: 4px" class="TdTitleStyle">
                <input type="checkbox" value='{$vo.team_id}' />
            </td>
            <td>{$vo.team_id|default=""}</td>
        </tr>
        </volist>
    </tbody>
</table>
<script>
    //初始化排序
    $(document).ready(function(){
        //设置加载的排序图标样式
        $('th[field]').append(' <li class="fa fa-sort"></li>');//为每个要排序的字段设置样式
        var order=$('#order').val();//获取排序字段及方式
        order=order.split(' ');//切割为数组,[0]为字段,[1]为排序方式
        if(order[1] == 'desc'){
            //设置排序图标为降序
            $('th[field="'+order[0]+'"]').find('li').attr('class','fa fa-sort-desc');
        }else if(order[1] == 'asc'){
            ////设置排序图标为升序
            $('th[field="'+order[0]+'"]').find('li').attr('class','fa fa-sort-asc');
        }else{
            //设置为无序
            $('th:has("li")').attr('class','fa fa-sort');
        }
        //点击所有含field属性的th标签事件
        $('th[field]').on('click',order_by);
    });
    //手动排序
    function order_by(){
        var field=$(this).attr('field');//获取要排序的字段
        var order=$(this).find('li').attr('class');//获取要排序之前的排序方式
        if(order == 'fa fa-sort' || order == 'fa fa-sort-asc'){
            $('#order').val(field+' desc');
        }else if(order == 'fa fa-sort-desc'){
            $('#order').val(field+' asc');
        }
        //提交表单
        form_submit();
    }
    //提交表单
    function form_submit(){
        $('.form-horizontal').submit();
    }
</script>
<?php
/**
 * [search 获取带翻页的队数据]
 * @return [type] [DESCription]
 */
public function search(){
    /***********排序条件********************************/
    $order=I('order',NULL) ? I('order',NULL) : 'team_id desc';
    /**********查询条件开始*************************/
    $where_package=where_package(I('',NULL),array('village_id','like'=>'team_name,team_linkman,team_telephone,createdby'));
    $where=$where_package['where'];
    $parameter=$where_package['parameter'];
    $where['isdeleted']=0;
    $parameter['isdeleted']=0;
    if(I('createat_start',NULL)){
        $where['createat']=array('gt',I('createat_start'));
        $parameter['createat_start']=I('createat_start');
    }
    if(I('createat_end',NULL)){
        $where['createat']=array('lt',I('createat_end'));
        $parameter['createat_end']=I('createat_end');
    }
    //本公司的人不能查看其它公司的数据
    $user=S('user_'.session('user_id'));
    $where['company_id']=$user['company_id'];//查询人员所在公司id,缓存获取
    $parameter['company_id']=$user['company_id'];
    /*********get_page函数获取分页*********************/
    $count = $this->where($where)->count();
    $pageData = get_page($count,'',$parameter);
    /************ 取某一页的数据 ********************/
    $field="team_id,team_name,team_linkman,team_telephone,team_charge,productionunit_id,village_id,isdeleted,createdby,createat,deletedat,deletedby,lastupdateat,lastupdateby,company_id,department_id";
    $listData =$this
    ->fielD($field)
    ->where($where)
    ->limit($pageData['firstRow'] .','. $pageData['listRows'])
    ->order($order)
    ->select();
    //get_name_by_id();由数组$listData中的'productionunit_id',获取productionunit_name,并添加到数组$listData中
    $listData=get_name_by_id($listData,array('village_id','productionunit_id','company_id','department_id','createdby','lastupdateby'));


    return array(
        'listData'      => $listData,
        'pageString'    => $pageData['pageString'],
        'parameter'     => $parameter,
        'order'         => $order,
    );
}
?>