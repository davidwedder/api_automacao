<?php
class Equip{
// dbection
private $db;
// Table
private $db_table = "equipamentos";
// Columns
public $id_equipamento;
public $nome;
public $modelo;
public $status;
public $id;



// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getEquip(){
$sqlQuery = "SELECT id_equipamento, nome, modelo, status, id FROM " . $this->db_table . "";
$this->result = $this->db->query($sqlQuery);
return $this->result;
}

// CREATE
public function createEquip(){
// sanitize
$this->nome=htmlspecialchars(strip_tags($this->nome));
$this->modelo=htmlspecialchars(strip_tags($this->modelo));
$this->status=htmlspecialchars(strip_tags($this->status));
$this->id=htmlspecialchars(strip_tags($this->id));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET nome = '".$this->nome."',
modelo = '".$this->modelo."',
status = '".$this->status."',
id = '".$this->id."'";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// GET ONE
public function getSingleEquip(){
$sqlQuery = "SELECT id_equipamento, nome, modelo, status, id FROM
". $this->db_table ." WHERE id_equipamento = ".$this->id_equipamento;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();
$this->id_equipamento = $dataRow['id_equipamento'];
$this->nome = $dataRow['nome'];
$this->modelo = $dataRow['modelo'];
$this->status = $dataRow['status'];
$this->id = $dataRow['id'];
}

// UPDATE
public function updateEquip(){
$this->id_equipamento=htmlspecialchars(strip_tags($this->id_equipamento));
$this->nome=htmlspecialchars(strip_tags($this->nome));
$this->modelo=htmlspecialchars(strip_tags($this->modelo));
$this->status=htmlspecialchars(strip_tags($this->status));
$this->id=htmlspecialchars(strip_tags($this->id));

$sqlQuery = "UPDATE ". $this->db_table ." SET nome = '".$this->nome."',
modelo = '".$this->modelo."',
status = '".$this->status."',
id = '".$this->id."'
WHERE id_equipamento = ".$this->id_equipamento;

$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deleteEquip(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id_equipamento = ".$this->id_equipamento;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}
}
?>