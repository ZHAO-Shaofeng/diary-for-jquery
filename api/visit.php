<?php

require("../utils/my_sql.php");

function var_json($info = '', $code = 10000, $data = array(), $location = '') {
    $out['code'] = $code ?: 0;
    $out['msg'] = $info ?: ($out['code'] ? 'error' : 'success');
    $out['data'] = $data ?: array();
    $out['location'] = $location;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);
}

header('Access-Control-Allow-Origin:*');

$uid = $_POST['uid'];
$url = $_POST['url'];

$result = $db->query("insert into visit(uid, url) values('$uid', '$url')");

if($result){
    class visitList{};
    $item = @new visitList();
    $item ->uid = $uid;
    var_json('success', 200, $item);
}
    var_json('错误', 400);

?>