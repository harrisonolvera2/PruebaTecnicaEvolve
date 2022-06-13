<?php 
    /**
    * @author Harrison Olvera Calleja
    * @date 13-06-2022
    */

    switch (isset($_POST)) {
        case isset($_POST["table"]):
            consulta();
            break;

        default:
            print json_encode(array("success"=>false, "msg"=>"404 Método no valido"));  
        break;
    }

    function consulta(){
        require_once ("../model/conexion.php");

        $id_usuario = $_POST["id_usuario"];
        $email = '';
        $color = '';

        if ($id_usuario != '' || $id_usuario != 0){

            $buscar = "SELECT * from usuarios;";

            $busqueda = $con->query($buscar);
            $tabla = '<table class="table table-dark table-striped">
                        <tr>
                            <th>#</th>
                            <th>Correo</th>
                            <th>Color</th>
                        </tr>';
            $count = 0;

            while ($row = $busqueda->fetch_assoc() ) {
                $count++;
                $email = $row["email"];
                $color = $row["color"];

                $tabla .='<tr>
                            <td>'.$count.'</td>
                            <td>'.$email.'</td>
                            <td>'.$color.'</td>
                        </tr>';
            }

            $tabla .= '</table';

            $azul_sql = "SELECT COUNT(id_usuario) as azules from usuarios where color = 'Azul';";
            $busqueda_azul = $con->query($azul_sql);
            $row1 = $busqueda_azul->fetch_assoc();
            $azules = $row1['azules'];

            $amarillo_sql = "SELECT COUNT(id_usuario) as amarillos from usuarios where color = 'Amarillo';";
            $busqueda_amarillo = $con->query($amarillo_sql);
            $row2 = $busqueda_amarillo->fetch_assoc();
            $amarillos = $row2['amarillos'];

            $rojo_sql = "SELECT COUNT(id_usuario) as rojos from usuarios where color = 'Rojo';";
            $busqueda_rojo = $con->query($rojo_sql);
            $row3 = $busqueda_rojo->fetch_assoc();
            $rojos = $row3['rojos'];
            
            print json_encode(array("success"=>true, "msg"=>"Consulta correcta.", "tabla" => $tabla, "azules" => $azules,"amarillos" => $amarillos,"rojos" => $rojos ));
            
        }else{
            print json_encode(array("success"=>false, "msg"=>"Error al intentar registrar, intente más tarde."));
        }
        
    }

?>