<?php
header('Content-Type: application/json');
$postBody = file_get_contents("php://input");
$_POST = json_decode($postBody, true);
function createArchive($nombre, $body){
    $array = Array (
        "0" => Array (
            "id" => "01",
            "name" => "Olivia Mason",
            "designation" => "System Architect"
        ),
        "1" => Array (
            "id" => "02",
            "name" => "Jennifer Laurence",
            "designation" => "Senior Programmer"
        ),
        "2" => Array (
            "id" => "03",
            "name" => "Medona Oliver",
            "designation" => "Office Manager"
        ),
        "3" => Array (
        "id" => "04",
        "name" => "Medona Oliver",
        "designation" => "Office Manager"
    )
    );

// encode array to json
    $json = json_encode($body);
    $bytes = file_put_contents("data/".base64_encode($nombre).".json", $json);
}
createArchive($_POST['url'], $_POST);
$response = [
    'code'=>'201',
    'status'=>'Success',
    'message' => "Guardado correctamente",
    'response'=>$_POST
];
echo json_encode($response);