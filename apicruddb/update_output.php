<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'output.php';

$database = new Database();
$db = $database->getConnection();
$item = new Outputs($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->name = $_GET['name'];
$item->board = $_GET['board'];
$item->gpio = $_GET['gpio'];
$item->state = $_GET['state'];

if($item->updateOutput()){
echo json_encode("Output editado com sucesso.");
} else{
echo json_encode("Não foi possivel editar, Verifique suas permissões");
}
?>