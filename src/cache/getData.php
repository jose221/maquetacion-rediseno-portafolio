<?php
header('Content-Type: application/json');
$postBody = file_get_contents("php://input");
$_POST = json_decode($postBody, true);

function getData($url){
    try {
        //widgets_manifest
        if (($data = @file_get_contents(realpath("")."/data/".base64_encode($url).".json")) === false) {
            $error = error_get_last();
            $data = [];
        } else {
            $data = ($data) ? json_decode($data,true)['response'] : [];
        }
        //$res = file_get_contents( "data/".base64_encode($url).".json");
        return $data;
    }catch (Exception $e){
        return [];
    }
}
$response = ['response'=>getData($_POST['url'])];
echo json_encode($response);