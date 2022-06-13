<?php
	/**
    * @author Harrison Olvera Calleja
    * @date 13-06-2022
    */
	$host = "localhost"; 
    $username = "root"; 
    $password = "h1h2l3b4b5"; 
    $db= "pruebatecnica"; 

    $con = new mysqli($host, $username, $password, $db);

    
    if ($con->connect_error) {
      echo "Error conectando a la BD: " . $con->connect_error; 
      exit;
    }
	
?>