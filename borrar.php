<?php
include "db.php";
session_start();

$ob4=new Base_datos();
$ob4->conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar deuda</title>
</head>
<body>
    <h1>Borrar deuda</h1>
    <form action="" method="POST">
        <input type="submit" value="BORRAR DEUDAS" name="delete">
    </form>
</body>
</html>