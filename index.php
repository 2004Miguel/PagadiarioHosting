<?php
session_start();

if(isset($_POST["btn_añadir"])){
    header("Location:anadir.php");
    exit();
}

if(isset($_POST["btn_abonar"])){
    header("Location: abonar.php");
}

if(isset($_POST['btn_deudor'])){
    header("Location: deudores.php");
    exit();
}

if(isset($_POST['btn_borrar'])){
    $_SESSION["num_1"]=1;
    header("Location: borrar.php");
}

if(isset($_POST['ver_abonos'])){
    header("Location: abonos.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <head>
        <H1>ELIJA QUE HACER</H1>
    </head>
    <main>
        <form action="" method="POST">
            <p>Aprete un botón para hacer lo que necesite</p>
            <br>
            <h3>AÑADIR</h3>
            <input type="submit" value="AÑADIR" name="btn_añadir">
            <p>Este botón es para crear nuevas deudas</p>

        </form>
       
        <form action="" method="POST">
            <br>
            <h3>ABONAR</h3>
            <input type="submit" name="btn_abonar" value="AÑADIR">
            <p>Esta opción es para añadir abonos de los deudores</p>
            <br>
        </form>

        <form action="" method="POST">
            <h3>VER DEUDORES</h3>
            <p>Aprete el siguiente botón para ver las personas con saldos pendientes</p>
            <input type="submit" name="btn_deudor" value="VER DEUDORES">
        </form>
        <br></br>

        <form action="" method="post">
            <h3>Borrar deudas</h3>
            <p>Si desea eliminar alguna deuda, de click en el siguiente botón</p>
            <input type="submit" name="btn_borrar" value="BORRAR">
        </form>
        <br></br>


        <form action="" method="post">
            <h3>Ver abonos</h3>
            <p>Si quiere ver todos los abonos, de click en el botón</p>
            <input type="submit" name="ver_abonos" value="VER ABONOS">
        </form>

        
    </main>
    
</body>
</html>