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
require("../model/list.php");

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

$page = $_GET['page'];
$pagesize = $_GET['pagesize'];
$startrow = ($page - 1)*$pagesize;

$result = $db->query("SELECT * FROM `info` order by time desc limit $startrow, $pagesize");

// echo $result;
// $select = $db->select("user","where username='$username' and password='$password'");

if($result){
   $arr = array();
   while($array = $db->myArray($result)){
       $item = @new dataList();
        $item ->id = $array[0];
        $item ->info = $array[1];
        $item ->img = array_filter(explode(",",$array[2]));
        $item ->time = $array[3];
        $item ->date = $array[4];
       array_push($arr,$item);
   }
   var_json('success', 200, $arr);
}

// if($row = $db->assoc($result)){
//     $item = @new dataList();
//     $item ->id = $row[0];
//     $item ->time = $row[2];
//     $item ->info = $row[1];
//     var_json('success', 200, $item);
// }
    var_json('错误', 400);
?>