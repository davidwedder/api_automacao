<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once 'database.php';
include_once 'equipamento.php';
$database = new Database();
$db = $database->getConnection();
$item = new Equip($db);
$item->id_equipamento = isset($_GET['id_equipamento']) ? $_GET['id_equipamento'] : die();
$item->getSingleEquip();
if($item->nome != null){

// create array
$emp_arr = array(
"id_equipamento" => $item->id_equipamento,
"nome" => $item->nome,
"modelo" => $item->modelo,
"status" => $item->status,
"id" => $item->id
);

http_response_code(200);
echo json_encode($emp_arr);
}
else{
http_response_code(404);
echo json_encode("Equipamento não encontrado");
}
?>