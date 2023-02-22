<?php
$conn = mysqli_connect("localhost", "root", "", "winpax");
if($conn->connect_error){
    die("Error de conexión: ".$conn->connect_error);
}
// echo "Conectado a DB"
?>