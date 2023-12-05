<?php
// ocupamos llamar perfil y autor
require_once '../modelos/carrito.php';

require_once '../modelos/conexion.php';


$carrito = new Carrito(); // Asegúrate de que la clase se llama Carrito (con mayúscula inicial)

    $userID = 1;

    // Llamamos a la función carritosContador de la clase Carrito
    $totalCarritos = $carrito->carritosContador($userID);
    echo "" . $totalCarritos;
?>