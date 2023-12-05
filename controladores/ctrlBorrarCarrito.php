<?php

require_once '../modelos/carrito.php';
require_once '../modelos/conexion.php';



// Verifica si se ha enviado el ID del curso por la URL
if (isset($_GET['id'])) 
    // Recibe el ID del curso
    $cursoID = $_GET['id'];
$userID=1;

   
        $carrito=new carrito();
        $carrito->eliminarElementoDelCarrito($userID,$cursoID);

?>