<?php
    
    class Base_datos{

        public $db_host;
        public $db_nombre;
        public $db_user;
        public $db_password;
        public $conexion;

        public function __construct() {
            //print("objeto creado\n");
            print("");

        }

        public function Conexion($db_hosp, $db_nombrep, $db_userp, $db_passwordp){

            $this->db_host=$db_hosp;
            $this->db_nombre=$db_nombrep;
            $this->db_user=$db_userp;
            $this->db_password=$db_passwordp;

            $this->conexion=mysqli_connect($db_hosp, $db_userp, $db_passwordp, $db_nombrep);
            if (mysqli_connect_errno()) {
                echo "error al conectar con la base de datos";
                exit();
            }
            //print('Conexion exitosa');
        }

        public function Mostrar_deudores($consultap){

            $resultado=mysqli_query($this->conexion, $consultap);

            while($fila=mysqli_fetch_row($resultado)){//cuadno la condición no está igualada a nada, se evalua que la condición sea igual a 0 
                //mientras la funcion fetch_row encuentre registros, se va a ejecutar el ciclo 
                print($fila[0]);
                print($fila[1]);
                echo "<br>";
            }
            mysqli_close($this->conexion);
            return $fila[0];            
        }

        public function Insertar($insert){
            if($resultado2=mysqli_query($this->conexion, $insert)){
                print("Deuda creada con éxito");
                return 1;
            }else{
                return 0;
            }
        }
        

        public function Insertar_cliente($consulp_costumer, $namep){
            $verificacion_existencia="SELECT*FROM cliente WHERE nombre='$namep'";
            $resul=mysqli_query($this->conexion, $verificacion_existencia);

            if($resul->num_rows>0){
                print("El cliente ya existe, busquelo para crear la deuda");
                return 0;
            }else{
                $insert=mysqli_query($this->conexion, $consulp_costumer);
                return 1;
            }
            
        }

        public function Comprobar_existencia($consultap){//SELECT*FROM cliente WHERE nombre='$customer desde abonar.php
            $busqueda=mysqli_query($this->conexion, $consultap);

            if($busqueda->num_rows>0){
                print("El cliente existe");
                return 1; //existe el cliente
            }else{
                print("El cliente no existe");
                return 0; //no existe el cliente 
            }    
        }

        public function Id_cliente($consultap){
            $consu=mysqli_query($this->conexion, $consultap);
            $fila=mysqli_fetch_row($consu);

            return $fila[0];
        }

        public function Borrar_deudas(){
            $query="DELETE FROM prestamo";
            $resul=mysqli_query($this->conexion, $query);
            print("prestamos borrados con exito");  
        }

        public function Deuda_existente($id_customerp){
            $query="SELECT id FROM prestamo WHERE id_cliente='$id_customerp'";
            $resul=mysqli_query($this->conexion, $query);
            $fila=mysqli_fetch_row($resul);

            if($resul->num_rows>0){
                return $fila[0];
                //print("Tiene deudas");
            }else{
                return 1;
                //print("No tiene deudas");
            }
        }

        public function Insertar_abono($fecha_abonop, $id_clientep, $id_prestamop, $monto_abonop){
            $abono_query="INSERT INTO abono (fecha_abono, id_cliente, id_prestamo, monto_abono) VALUES ('$fecha_abonop', '$id_clientep', '$id_prestamop', '$monto_abonop')";

            $resul=mysqli_query($this->conexion, $abono_query);
            //$fila=mysqli_fetch_row($resul);

            if($resul==false){
                print("Error al hacer abono o el cliente no tiene prestamos activos");
                return 0;
            }else{
                print("Abono hecho exitosamente");
                return 1;
            }

        }

        public function Restante_prestamo($id_clientep, $id_prestamo){//Devuelve la cantidad prestada del cliente
            $monto_prestado_query="SELECT monto_prestado FROM prestamo WHERE id_cliente='$id_clientep'";
            $monto_prestado=mysqli_query($this->conexion, $monto_prestado_query);
            $fila=mysqli_fetch_row($monto_prestado);

            return $fila[0];
        }

        public function Valor_abono($id_clientep, $id_prestamop){

            $abono_query="SELECT monto_abono FROM abono WHERE id_cliente='$id_clientep' AND id_prestamo='$id_prestamop'";
            $abono=mysqli_query($this->conexion, $abono_query);

            $fila=mysqli_fetch_row($abono);
            return $fila[0];
        }

        function Update_restante_prestamo($total_abono, $prestamop, $id_prestamop, $id_clienp){
            $resta=$prestamop-$total_abono;//Se calcula el restante

            $consul="UPDATE prestamo SET restante='$resta' WHERE id='$id_prestamop' AND id_cliente='$id_clienp'";
            $resul=mysqli_query($this->conexion, $consul);

            if($resul==true){
                print("Abono hecho exitosamente");
            }else{
                print("Error al hacer el abono");
            }

            if($resta<=0){
                $estado="pagado";
                $cambio_estado="UPDATE prestamo SET estado='$estado' WHERE id='$id_prestamop' AND id_cliente='$id_clienp'";
                $run=mysqli_query($this->conexion, $cambio_estado);
                if($run==true){
                    print("DEUDA PAGADA");
                }
            }
        }

        function Suma_abono($id_prestamop, $id_clienp){
            $total=0;
            $suma_abono="SELECT monto_abono FROM abono WHERE id_prestamo='$id_prestamop' AND id_cliente='$id_clienp'";
            $resul=mysqli_query($this->conexion, $suma_abono);

            while($fila=mysqli_fetch_row($resul)){//Se suman todos los abonos hechos a la deuda para saber cuanto le falta sobre la deuda total (osea que se calcula  el restante)
                //print($fila[0]);
                $suma=$fila[0] + $total_abono;
                $total_abono=$suma;
            }
           
            return $total_abono;
            //print("el total de abono es: ". $total_abono);
        }


        function Ver_abonos($id_clientep){

            $abo="SELECT*FROM abono WHERE id_cliente='$id_clientep'";
            $total_abono="SELECT SUM(monto_abono) FROM abono WHERE id_cliente='$id_clientep'";
            $resul2=mysqli_query($this->conexion, $total_abono);
            $tabono=mysqli_fetch_array($resul2);
            $resul=mysqli_query($this->conexion, $abo);
            
            if($resul->num_rows>0){
                while($fila=mysqli_fetch_row($resul)){
                    echo "<br></br>";
    
                    echo "<strong>Id abono: </strong>";
                    print($fila[0]);
                    echo " ";
    
                    echo "<strong>Monto abonado: </strong>";
                    print($fila[1]);
                    echo " ";
    
                    echo "<strong>Fecha de abono: </strong>";
                    print($fila[2]);
                    echo " ";
    
                    echo "<strong>Id cliente: </strong>";
                    print($fila[3]);
                    echo " ";
    
                    echo "<strong>Id prestamo: </strong>";
                    print($fila[4]);
                    echo " ";
                }
                echo "<br></br>";
                print("<strong>Total abonos:</strong> ".$tabono[0]);

            }else{
                print("El cliente no tiene abonos");
            }
        }

        function Id_clientex2($nombrep){
            $query="SELECT id FROM cliente WHERE nombre='$nombrep'";
            $consul=mysqli_query($this->conexion, $query);
            $fila=mysqli_fetch_row($consul);

            return $fila[0];
        }

        function Deudores($id_clien){
            $query="SELECT*FROM prestamo WHERE id_cliente='$id_clien'";
            $resul=mysqli_query($this->conexion, $query);
            //$fil=mysqli_fetch_row($resul);  

            /*
            if($resul->num_rows>0){

                echo "<strong>Fecha de prestamo: </strong>";
                print($fil[2]);
                echo " ";

                echo "<strong>Restante: </strong>";
                print($fil[5]);
                echo " ";

                echo "<strong>Monto prestado: </strong>";
                print($fil[1]);
                echo " ";

                echo "<strong>Estado: </strong>";
                print($fil[4]);
                echo " ";
                
            }else{
                print("El cliente no tiene deudas pendientes");
            }*/
            while($dato = $resul->fetch_object()){
                echo "<strong>Id deuda: </strong>";
                print($dato->id);
                echo " ";

                echo "<strong>Fecha de prestamo: </strong>";
                print($dato->fecha_prestamo);
                echo " ";

                echo "<strong>Restante: </strong>";
                print($dato->restante);
                echo " ";

                echo "<strong>Monto prestado: </strong>";
                print($dato->monto_prestado);
                echo " ";

                echo "<strong>Estado: </strong>";
                print($dato->estado);
                echo "<br></br>";

            }


        }

        public function enviarEmail($remitente){
            ini_set( 'display_errors', 1 );//La línea 1 y 2 permiten informar si el script no se ejecuta
            error_reporting( E_ALL );
            $from = "miguel@gestordeudas.online";//Correo desde el cual se va a enviar el mensaje
            $to = $remitente;//Destinatario del correo
            $subject = "Deuda creada";//Asunto del correo
            $message = "Su deuda fue creada con exito";//Se redacta el mensaje
            $headers = "From:" . $from;//Detalla la información vital, como la dirección del remitente, la ubicación de respuesta, etc.
            mail($to,$subject,$message, $headers);//Esta línea ejecuta la función 
            echo "El correo fue enviado con exito";
        }

    }
?>