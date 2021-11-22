<?php
class Outputs{
// dbection
private $db;
// Table
private $db_table = "Outputs";
// Columns
public $id;
public $name;
public $board;
public $gpio;
public $state;



// Db dbection
public function __construct($db){
$this->db = $db;
}

// GET ALL
public function getOutput(){
$sqlQuery = "SELECT id, name, board, gpio, state  FROM " . $this->db_table . "";
$this->result = $this->db->query($sqlQuery);
return $this->result;
}

// CREATE
public function createOutput(){
// sanitize
$this->name=htmlspecialchars(strip_tags($this->name));
$this->board=htmlspecialchars(strip_tags($this->board));
$this->gpio=htmlspecialchars(strip_tags($this->gpio));
$this->state=htmlspecialchars(strip_tags($this->state));
$sqlQuery = "INSERT INTO
". $this->db_table ." SET name = '".$this->name."',
board = '".$this->board."',
gpio = '".$this->gpio."',
state = '".$this->state."'";
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// GET ONE
public function getSingleOutput(){
$sqlQuery = "SELECT id, name, board, gpio, state FROM
". $this->db_table ." WHERE id = ".$this->id;
$record = $this->db->query($sqlQuery);
$dataRow=$record->fetch_assoc();
$this->id = $dataRow['id'];
$this->name = $dataRow['name'];
$this->board = $dataRow['board'];
$this->gpio = $dataRow['gpio'];
$this->state = $dataRow['state'];
}

// UPDATE
public function updateOutput(){
$this->id=htmlspecialchars(strip_tags($this->id));
$this->name=htmlspecialchars(strip_tags($this->name));
$this->board=htmlspecialchars(strip_tags($this->board));
$this->gpio=htmlspecialchars(strip_tags($this->gpio));
$this->state=htmlspecialchars(strip_tags($this->state));

$sqlQuery = "UPDATE ". $this->db_table ." SET name = '".$this->name."',
board = '".$this->board."',
gpio = '".$this->board."',
state = '".$this->state."'
WHERE id = ".$this->id;

$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}

// DELETE
function deleteOutput(){
$sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ".$this->id;
$this->db->query($sqlQuery);
if($this->db->affected_rows > 0){
return true;
}
return false;
}
}
?>