<?php
    class Util{
        public  var_json($info = '', $code = 10000, $data = array(), $location = '') {
            $out['code'] = $code ?: 0;
            $out['info'] = $info ?: ($out['code'] ? 'error' : 'success');
            $out['data'] = $data ?: array();
            $out['location'] = $location;
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($out, JSON_HEX_TAG);
            exit(0);
        }
    }

    $util = new Util();
?>