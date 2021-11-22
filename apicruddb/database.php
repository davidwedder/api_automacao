<?php
class Database {
public $db;
public function getConnection(){
$this->db = null;
try{
$this->db = new mysqli('mysql796.umbler.com','root-gwr','bnzie4e6','gwrdatabase');
}catch(Exception $e){
echo "Database could not be connected: " . $e->getMessage();
}
return $this->db;
}
}