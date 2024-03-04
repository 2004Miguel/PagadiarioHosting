<?php
include "db.php";

if(isset($_POST['btn_volver'])){
    header("Location: index.php");
    exit();
}
echo "<h1>Deudores</h1>";

$ob2 = new Base_datos();
$ob2->Conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");
$ver_deudores="SELECT*FROM cliente";

if(isset($_POST['btn_ver_deudores'])){
    $ob2->Mostrar_deudores($ver_deudores);
}

if(isset($_POST['btn_buscar'])){
    $nombre=$_POST['txt_name_deudor'];
    $id_cli=$ob2->Id_clientex2($nombre);
    $ob2->Deudores($id_cli);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deudores</title>
</head>
<body>
    <br></br>
    <form action="" method="POST">
        <input type="submit" name="btn_volver" value="VOLVER">
    </form>
    <br></br>
    
    <form action="" method="post">
        <label for="name">Buscar deudas de una persona</label>
        <input type="text" name="txt_name_deudor" placeholder="Nombre del deudor" id="name">
        <input type="submit" name="btn_buscar" value="BUSCAR DEUDAS">
    </form>

    <form action="" method="post">
        <input type="submit" value="VER TODOS LOS DEUDORES" name="btn_ver_deudores">
    </form>
</body>
</html>