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
$item->nome = $_GET['nome'];
$item->modelo = $_GET['modelo'];
$item->status = $_GET['status'];
$item->id = $_GET['id'];

if($item->updateEquip()){
echo json_encode("Equipamento editado com sucesso.");
} else{
echo json_encode("Não foi possivel editar, Verifique suas permissões");
}
?>