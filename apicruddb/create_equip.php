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


$item->nome = $_GET['nome'];
$item->modelo = $_GET['modelo'];
$item->status = $_GET['status'];
$item->id = $_GET['id'];

if($item->createEquip()){
echo 'Equipamento criado com sucesso!!.';
} else{
echo 'Employee could not be created.';
}
?>