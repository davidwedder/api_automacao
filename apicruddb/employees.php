<?php
class Employee{
// dbection
private $db;
// Table
private $db_table = "usuarios";
// Columns
public $id;
public $nome;
public $usuario;
public $senha_usuario;
public $recuperar_senha;
public $privilegio;
public $created;


// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getEmployees(){
$sqlQuery = "SELECT id, nome, usuario, senha_usuario, privilegio, created FROM " . $this->db_table . "";
$this->result = $this->db->query($sqlQuery);
return $this->result;
}

// CREATE
public function createEmployee(){
// sanitize
$this->nome=htmlspecialchars(strip_tags($this->nome));
$this->usuario=htmlspecialchars(strip_tags($this->usuario));
$this->senha_usuario=htmlspecialchars(strip_tags($this->senha_usuario));
$this->privilegio=htmlspecialchars(strip_tags($this->privilegio));
$this->created=htmlspecialchars(strip_tags($this->created));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET nome = '".$this->nome."',
usuario = '".$this->usuario."',
senha_usuario = '".$this->senha_usuario."',
privilegio = '".$this->privilegio."',
created = '".$this->created."'";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// UPDATE
public function getSingleEmployee(){
$sqlQuery = "SELECT id, nome, usuario, privilegio, created FROM
". $this->db_table ." WHERE id = ".$this->id;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();
$this->nome = $dataRow['nome'];
$this->usuario = $dataRow['usuario'];
$this->privilegio = $dataRow['privilegio'];
$this->created = $dataRow['created'];
}

// UPDATE
public function updateEmployee(){
$this->nome=htmlspecialchars(strip_tags($this->nome));
$this->usuario=htmlspecialchars(strip_tags($this->usuario));
$this->privilegio=htmlspecialchars(strip_tags($this->privilegio));
$this->created=htmlspecialchars(strip_tags($this->created));
$this->id=htmlspecialchars(strip_tags($this->id));

$sqlQuery = "UPDATE ". $this->db_table ." SET nome = '".$this->nome."',
usuario = '".$this->usuario."',
privilegio = '".$this->privilegio."',created = '".$this->created."'
WHERE id = ".$this->id;

$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deleteEmployee(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}
}





?>