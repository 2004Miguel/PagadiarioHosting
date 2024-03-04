<?php
include "db.php";
session_start();

$ob3=new Base_datos();
$ob3->Conexion("localhost", "u627259369_pagadiarios", "u627259369_miguesalas2004", "8DEL2Del2004@");

if(isset($_POST['btn_volver_anadir'])){
    header("Location: anadir.php");
    exit();
}

if(isset($_POST['btn_crear_deuda'])){
    $monto_prestar=$_POST['txt_prestamo'];
    $name=$_SESSION['search_name'];//Esta variable viene de anadir.php
    $id_cliente_query="SELECT id FROM cliente WHERE nombre='$name'";
    $id_cliente=$ob3->Id_cliente($id_cliente_query);
    
    $restante=$_POST['txt_prestamo'];
    $fecha_prestamo= date("Y-m-d");//aaaa-mm-dd
    
    
    $prestamo_query="INSERT INTO prestamo (fecha_prestamo, id_cliente, monto_prestado, restante, estado) VALUES ('$fecha_prestamo', '$id_cliente', '$monto_prestar', '$restante', 'pendiente')";
    $ob3->Insertar($prestamo_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deuda</title>
</head>
<body>
    <header>
        <h1>Deuda</h1>
        <form action="" method="post">
            <input type="submit" value="VOLVER" name="btn_volver_anadir">
            <br></br>
            <br></br>
            <span>
                Nombre del cliente:
                <input readonly type="text" value="<?php echo $_SESSION['search_name'] ?>" >
            </span>
            <br></br>
            <br></br>
            <span>
                Monto a prestar:
                <input type="number" name="txt_prestamo">
            </span>
            <br></br>
            <br></br>
            <input type="submit" value="CREAR DEUDA" name="btn_crear_deuda">
        </form>
    </header>
    
</body>
</html>