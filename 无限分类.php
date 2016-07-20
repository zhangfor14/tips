你还在用浪费时间又浪费内存的递归遍历无限极分类吗，看了该篇文章，我觉得你应该换换了。
这是我在OSChina上看到的一段非常精简的PHP无限极分类生成树方法，巧在引用，整理分享了。

function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}
$items = array(
    1 => array('id' => 1, 'pid' => 0, 'name' => '安徽省'),
    2 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
    3 => array('id' => 3, 'pid' => 1, 'name' => '合肥市'),
    4 => array('id' => 4, 'pid' => 3, 'name' => '长丰县'),
    5 => array('id' => 5, 'pid' => 1, 'name' => '安庆市'),
);
print_r(generateTree($items));

Array
(
    [0] => Array
        (
            [id] => 1
            [pid] => 0
            [name] => 安徽省
            [son] => Array
                (
                    [0] => Array
                        (
                            [id] => 3
                            [pid] => 1
                            [name] => 合肥市
                            [son] => Array
                                (
                                    [0] => Array
                                        (
                                            [id] => 4
                                            [pid] => 3
                                            [name] => 长丰县
                                        )
 
                                )
 
                        )
 
                    [1] => Array
                        (
                            [id] => 5
                            [pid] => 1
                            [name] => 安庆市
                        )
 
                )
 
        )
 
    [1] => Array
        (
            [id] => 2
            [pid] => 0
            [name] => 浙江省
        )
 
)

上面生成树方法还可以精简到5行：
function generateTree($items){
    foreach($items as $item)
        $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];
    return isset($items[0]['son']) ? $items[0]['son'] : array();
}

上面这种无限极分类数据树形结构化的方法值得借鉴。但是我觉得这段代码实际用途并不明显啊，你想取出格式化的树形数据还是要递归啊：
/**
 * 如何取数据格式化的树形数据
 * @blog<http://www.phpddt.com>
 */
$tree = generateTree($items);
function getTreeData($tree){
    foreach($tree as $t){
        echo $t['name'].'<br>';
        if(isset($t['son'])){
            getTreeData($t['son']);
        }
    }
}
getTreeData($tree);