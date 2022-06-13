<?php 
    /**
    * @author Harrison Olvera Calleja
    * @date 13-06-2022
    */

    switch (isset($_POST)) {
        case isset($_POST["reg"]):
            registro();
            break;
        case isset($_POST["log"]):
            login();
            break;  

        default:
            print json_encode(array("success"=>false, "msg"=>"404 Método no valido"));  
        break;
    }

    function registro(){
        require_once ("../model/conexion.php");

        $email = $_POST["email"];
        $password = $_POST["password"];
        $color = $_POST["color"];

        if ($email != '' && $password != '' && ($color != '' || $color != 0) ){

            $buscar = "SELECT email from usuarios where email = '$email';";

            $busqueda = $con->query($buscar);
            $row = $busqueda->fetch_assoc();
            $email_registrado = $row['email'];

            if ($email != $email_registrado) {
                switch ($color) {
                    case '1':
                        $color = 'Azul';
                    break;
                    case '2':
                        $color = 'Amarillo';
                    break;
                    case '3':
                        $color = 'Rojo';
                    break;
                }

                $sql = "INSERT INTO usuarios (email, password, color) VALUES ('$email', '$password', '$color');";

                $execute = $con->query($sql);

                if ($execute) {
                    print json_encode(array("success"=>true, "msg"=>"Registrado con éxito."));
                }else{
                    print json_encode(array("success"=>false, "msg"=>"Error al intentar registrar, intente más tarde."));
                }
            }else{
                print json_encode(array("success"=>false, "msg"=>"El correo ingresado ya fue registrado, ingrese otro por favor."));
            }
            
        }else{
            print json_encode(array("success"=>false, "msg"=>"Error al intentar registrar, intente más tarde."));
        }
        
    }

    function login(){
        require_once ("../model/conexion.php");

        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($email != '' && $password != '' ){

            $buscar = "SELECT * from usuarios where email = '$email' AND password = '$password';";
            $busqueda = $con->query($buscar);
            $row = $busqueda->fetch_assoc();

            if ($row != 0) {
                $id_usuario = $row['id_usuario'];
                $email = $row['email'];
                $password = $row['password'];
                $color = $row['color'];
                // start a session
                session_start();
                 
                // initialize session variables
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['color'] = $color;

                print json_encode(array("success"=>true, "msg"=>"Iniciando sesión..."));
            }else{
                print json_encode(array("success"=>false, "msg"=>"Usuario o contraseña incorrectos, intente de nuevo."));
            }
            
        }else{
            print json_encode(array("success"=>false, "msg"=>"Error al intentar iniciar sesión, intente más tarde."));
        }
    }
?>
