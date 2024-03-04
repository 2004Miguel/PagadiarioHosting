<?php
include "db.php";

session_start();

$ob1= new Base_datos();
$ob1->Conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");

if(isset($_POST['btn_creacion'])){
    
    $name=$_POST["txb_name"];
    $_SESSION["search_name"]=$name;
    $añadir="INSERT INTO cliente (nombre) VALUES ('$name')";
    
    if($ob1->Insertar_cliente($añadir, $name) == 1){//significa que el cliente no existe y se puede crear
        header("Location:deuda.php");
    }
    
}

if(isset($_POST['btn_volver'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['btn_buscar'])){
    $cliente=$_POST["txb_buscarName"];
    $_SESSION["search_name"]=$cliente;
    $buscar="SELECT nombre FROM cliente where nombre='$cliente'";
    if($ob1->Comprobar_existencia($buscar)==1){// si el cliente ya existe en la base de datos se puede crear la deuda
        header("Location:deuda.php");
    }
}

//Con el atributo action de los forms podemos pasar variables entre diferentes archivos php. Las podemos invocar 
//usando $_POST/GET['variable']
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir</title>
</head>
<body>

    <h1>ELIJA O CREE EL CLIENTE</h1>
    <form action="" method="POST">
        <input type="submit" name="btn_volver" value="VOLVER">
    </form>

    <main>
        <form action="" method="post">
            <p>Si el cliente ya exite, busquelo: </p>
            <span>
                <input type="text" autocomplete="name" placeholder="Buscar el nombre del cliente" name="txb_buscarName">
                <input type="submit" value="BUSCAR" name="btn_buscar">
            </span>
        </form>
        <br></br>
        <br></br>

        <form action="" method="post">
            <p>Sino, creelo llenando el siguiente campo: </p>
            <span>
                Nombre:
                <input type="text" name="txb_name" placeholder="nombre">
            </span>
            <br></br>
            <input type="submit" name="btn_creacion" value="AÑADIR CLIENTE">
        </form>
    </main>
    
</body>
</html>