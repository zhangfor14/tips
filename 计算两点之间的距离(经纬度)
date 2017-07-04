//计算经纬度两点之间的距离
 function nearby_distance($lat1, $lon1, $lat2, $lon2) {
    $EARTH_RADIUS = 6378.137;
    $radLat1 = rad($lat1);
    $radLat2 = rad($lat2);
    $a = $radLat1 - $radLat2;
    $b = rad($lon1) - rad($lon2);
    $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
    $s1 = $s * $EARTH_RADIUS;
    $s2 = round($s1 * 10000) / 10000;
    return $s2;
    //print_r($s2);
}

function rad($d) {
    return $d * 3.1415926535898 / 180.0;
}
