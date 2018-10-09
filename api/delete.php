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

$id = $_GET['id'];

$result = $db->query("DELETE FROM `test`.`info` WHERE `info`.`id` = $id");

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

if($result){
    var_json('success', 200);
}
    var_json('错误', 400);
?>