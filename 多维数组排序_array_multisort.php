<?php
/**
 * [array_sort 给二维数组排序]
 * @param  [type]  $data   [要排序的数组]
 * @param  [type]  $field1 [要排序的字段1]
 * @param  [type]  $field2 [要排序的字段2]
 * @param  boolean $desc   [是否倒序]
 * @return [type]          [description]
 */
function array_sort($data,$field1,$field2,$desc=false){
    //先排序title,time
    foreach ($data as $key => $row) {
        $arr1[$key] = $row[$field1];
        $arr2[$key] = $row[$field2];
    }
    array_multisort($arr1, SORT_ASC, SORT_REGULAR , $arr2, SORT_ASC, SORT_REGULAR ,$data);
    return $data;
}

#tips:
array_multisort函数可以像order by 字段1,字段2这样排序
array_multisort(array1,sorting order,sorting type,array2,array3...)
#参数	描述
array1	必需。规定数组。
sorting order	
#可选。规定排列顺序。可能的值：
SORT_ASC - 默认。按升序排列 (A-Z)。
SORT_DESC - 按降序排列 (Z-A)。
sorting type	
#可选。规定排序类型。可能的值：
SORT_REGULAR - 默认。把每一项按常规顺序排列（Standard ASCII，不改变类型）。
SORT_NUMERIC - 把每一项作为数字来处理。
SORT_STRING - 把每一项作为字符串来处理。
SORT_LOCALE_STRING - 把每一项作为字符串来处理，基于当前区域设置（可通过 setlocale() 进行更改）。
SORT_NATURAL - 把每一项作为字符串来处理，使用类似 natsort() 的自然排序。
SORT_FLAG_CASE - 可以结合（按位或）SORT_STRING 或 SORT_NATURAL 对字符串进行排序，不区分大小写。
array2	可选。规定数组。
array3	可选。规定数组。