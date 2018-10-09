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

date_default_timezone_set('PRC');	// 设置时区
$detail = htmlspecialchars($_POST['info'], ENT_QUOTES);
$time = date("Y-m-d");
// $img = $_POST['img'];
$dir = "images/info/";
$img_path = '';

if (isset($_POST['img'])) {
	$img = $_POST['img'];
}else{
	$img = '';
}

function upload_base64_img_comm($file,$dir,$root='D:/Data/hello/',$number='970530'){
  if (!file_exists($root.$dir)){			// 目录文件是否存在，不存在就创建并给权限
    mkdir ($root.$dir,0777,true);
  }
  $file_path = date('YmdHis').'-'.rand(1,10000).'-'.$number.'.jpg';	// 文件名为 时间+随机数+数字.jpg
  $paths = $dir.$file_path;		// 文件存储路径
  $file = substr(strstr($file, ','), 1);	// 截取base64逗号后面的值
  if (!base64_decode($file)) {
    echo '解析失败';
  }
  $result = file_put_contents($root.$paths, base64_decode($file));	// 往指定路径塞入解码的图片
  if ($result) {
    return $paths;
  }else{
    echo '图片上传失败';
  }
}

if (empty($img)) {
	
}else{
	foreach($img as $base64_image){
		$img_path .= upload_base64_img_comm($base64_image, $dir).',';
	}
}

$result = $db->query("insert into info(detail, img, date) values('$detail', '$img_path', '$time')");

if($result){
    var_json('success', 200);
}
    var_json('错误', 400);
?>