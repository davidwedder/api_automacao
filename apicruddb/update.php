<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'employees.php';

$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();
$item->nome = $_GET['nome'];
$item->usuario = $_GET['usuario'];
$item->senha_usuario = $_GET['senha_usuario'];
$item->privilegio = $_GET['privilegio'];
$item->created = date('Y-m-d H:i:s');
if($item->updateEmployee()){
echo json_encode("Usuario editado com sucesso.");
} else{
echo json_encode("Não foi possivel editar, Verifique suas permissões");
}
?>