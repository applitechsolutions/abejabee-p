<?php
	include_once '../funciones/bd_conexion.php';
	header("Content-Type: application/json; charset=UTF-8");

    $result = $conn->query("SELECT * FROM village");
    $outp = array();
    $outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
?>