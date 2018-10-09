<?php

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

header('Access-Control-Allow-Origin:*');

$id = $_GET['id'];

$result = $db->query("SELECT * FROM `info` where id=$id");

// if($result){
//   $arr = array();
//   while($array = $db->myArray($result)){
//     $item = @new dataList();
//     $item ->id = $array[0];
//     $item ->info = $array[1];
//     $item ->time = $array[2];
//     $item ->date = $array[3];
//     array_push($arr,$item);
//   }
//   var_json('success', 200, $arr);
// }

if($row = $db->rows($result)){
    $item = @new dataList();
    $item ->id = $row[0];
    $item ->info = $row[1];
    $item ->img = array_filter(explode(",",$row[2]));
    $item ->time = $row[3];
    $item ->date = $row[4];
    var_json('success', 200, $item);
}
    var_json('错误', 400);
?>