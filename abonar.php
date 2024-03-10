<?php
include "db.php";
session_start();

$ob5=new Base_datos();
$ob5->conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");

if(isset($_POST['btn_volver'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['btn_pagar'])){
    $customer=$_POST['txb_customer_pay'];
    //nombre del cliente

    $value_pay=$_POST['txb_value_pay'];
    //valor que va a pagar

    $query_customer="SELECT*FROM cliente WHERE nombre='$customer'";
    //consulta para saber si el cliente existe 

    if($ob5->Comprobar_existencia($query_customer)==1){
        //En caso de que la función devulva 1 es porque el cliente existe

        $id_customer="SELECT id FROM cliente WHERE nombre='$customer'";
        //Consulta para seleccionar el id que pertenece al nombre del cliente

        $id_clien=$ob5->Id_cliente($id_customer);
        //el id del cliente se almacena en la variable

        $id_deuda=$_POST["id_deudap"];//$ob5->Deuda_existente($id_clien);
        //si el cliente tiene una deuda, la función va a devolver el id de esa deuda

        $fecha_abono= date("Y-m-d");
        //la fecha en la que se hace el abono 
        //print($id_clien. $id_deuda. $fecha_abono);

        if($id_deuda != 0){// El cliente tiene deudas asociadas. La condición es que el Id del prestamo sea diferente de 0. SE PUEDE MEJORAR LA CONDICIÓN 
            $abono_resul=$ob5->Insertar_abono($fecha_abono, $id_clien, $id_deuda, $value_pay);//La función devuelve 1 si se hizo el abono exitosamente

            if($abono_resul==1){

                $tot_abon=$ob5->Suma_abono($id_deuda, $id_clien);
                $restante=$ob5->Restante_prestamo($id_clien);//Se obtiene el valor que se prestó

                $ob5->Update_restante_prestamo($tot_abon, $restante, $id_deuda, $id_clien);
            }
        }
    }else{
        print("El cliente no existe");
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonar</title>
</head>
<body>
    <h1>PANTALLA ABONAR</h1>
    <form action="" method="POST">
        <input type="submit" name="btn_volver" value="VOLVER">
    </form>
    <br></br>
    <br></br>

    <form action="" method="post">        
        <p>Ingrese el nombre de la persona que tiene un prestamo y va a abonar</p>
        <label for="txb_customer_pay">Cliente</label>
        <input id="txb_customer_pay" type="text" name="txb_customer_pay" placeholder="Nombre">
        <br></br>
        <p>Ingrese el id de la deuda que quiere pagar</p>
        <label for="id_deudap">Id deuda</label>
        <input type="number" id="id_deudap" name="id_deudap">
        <label for="value_pay">Valor a pagar</label>
        <input id="value_pay" type="number" placeholder="Cantidad" name="txb_value_pay">
        <br></br>
        <input type="submit" value="PAGAR" name="btn_pagar">
    </form>

    
</body>
</html>