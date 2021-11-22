<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);
$_SESSION['msg'] = "<p class='alert alert-success' style='color: green'>Deslogado com sucesso!</p>";

header("Location: index.php");