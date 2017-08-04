//中文分词，传入title， 分割段数
function get_tags($title,$num){
    import("Vendor.Pscws.pscws4");
    $pscws = new \PSCWS4('utf8');
    $pscws->set_dict(CONF_PATH . 'etc/dict.utf8.xdb');
    $pscws->set_rule(CONF_PATH . 'etc/rules.utf8.ini');
    $pscws->set_ignore(true);
    $pscws->send_text($title);
    $words = $pscws->get_tops($num);
    $pscws->close();

    $tags = array();
    foreach ($words as $val) {
        $tags[] = $val['word'];
    }

    return implode(',', $tags);
}