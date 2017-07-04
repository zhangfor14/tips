<?php

/** 
 * 计算$b相对于$a的相对路径 
 * @param string $a 
 * @param string $b 
 * @return string 
 * 例.
 * $a = '/a/b/c/d/e/f/g/h/e.php';
   $b = '/a/b/1/2/c.php';
   b相对于a:../../c/d/e/f/g/h
 */  
function getRelativePath($a, $b) {  
    $relativePath = "";  
    $pathA = explode('/', dirname($a));  
    $pathB = explode('/', dirname($b));  
    $n = 0;  
    //获得相对短的数组的数量
    $len = count($pathB) > count($pathA) ? count($pathA) : count($pathB);  
    //取出相同部分
    do {  
        if ( $n >= $len || $pathA[$n] != $pathB[$n] ) {  
            break;  
        }  
    } while (++$n); 
    //获取相对位置有几层
    $relativePath .= str_repeat('../', count($pathB) - $n + 1);  
    //字符串连接,相对位置后的a地址
    $relativePath .= implode('/', array_splice($pathA, $n)); 

    return $relativePath;  
}  
$res = getRelativePath($a, $b);  