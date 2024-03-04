<?php
include "db.php";
session_start();

//echo "<h1>Abonos</<h1>";

$pagos=new Base_datos();
$pagos->Conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");


if(isset($_POST['btn_back'])){
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tablestyle.css">
    <title>Abonos</title>
</head>
<body>
    <br></br>

    <form action="" method="post">
        <label for="deudor">Nombre del deudor</label>
        <input type="text" name="txt_name" placeholder="Nombre del deudor" id="deudor">
        <input type="submit" name="btn_back" value="VOLVER">
        <br></br>
        <input type="submit" value="BUSCAR ABONOS" name="btn_ver_abonos">
    </form>
    <!--Esta etiqueta PHP se puso acá para que la info aparezca bajo el encabezado -->
    
    <?php
    
        if(isset($_POST['btn_ver_abonos'])){
            $nombre=$_POST['txt_name'];
    
            $id_cliente=$pagos->Id_clientex2($nombre);
            $pagos->Ver_abonos($id_cliente);
        }
        
    ?>
    <!--
    <br></br>
    <form action="" method="post">
        <input type="submit" name="btn_back" value="VOLVER">
    </form>
    <br>
    <!--tr=table row    td=table data   th=table header -->

    <?php
    /*
        echo "
            <table>
                <tr>
                    <th>ID ABONO</th>
                    <th>MONTO ABONADO</th>
                    <th>FECHA DE ABONO</th>
                    <th>ID CLIENTE</th>
                    <th>ID PRESTAMO</th>
                </tr>
                <tr>
                    <td>una celda</td>
                    <td>una celda</td>
                    <td>una celda</td>
                    <td>una celda</td>
                </tr>

            </table>
        
        
        "
        */

    ?>
</body>
</html>