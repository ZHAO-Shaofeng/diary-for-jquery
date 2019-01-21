<?php
/**
* 比较标准的接口输出函数
* @param string  $msg 消息
* @param integer $code 接口错误码，很关键的参数
* @param array   $data 附加数据
* @param string  $location 重定向
* @return array
*/

require("../utils/my_sql.php");
require("../model/visit.php");

function var_json($info = '', $code = 10000, $data = array(), $location = '') {
    $out['code'] = $code ?: 0;
    $out['msg'] = $info ?: ($out['code'] ? 'error' : 'success');
    $out['data'] = $data ?: array();
    $out['location'] = $location;
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($out, JSON_HEX_TAG);
    exit(0);
}

// 跨域请求
// header('Access-Control-Allow-Origin:http://localhost:8080');
header('Access-Control-Allow-Origin:*');

$result = $db->query("SELECT * FROM `visit` order by time desc");

// echo $result;
// $select = $db->select("user","where username='$username' and password='$password'");

if($result){
    $arr = array();
    while($array = $db->myArray($result)){
        $item = @new visitLogList();
        $item ->id = $array[0];
        $item ->uid = $array[1];
        $item ->url = $array[2];
        $item ->is_root = $array[3];
        $item ->time = $array[4];
        array_push($arr,$item);
    }
    var_json('success', 200, $arr);
}
?>