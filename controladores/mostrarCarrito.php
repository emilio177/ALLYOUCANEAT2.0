<?php
// ocupamos llamar perfil y autor
require_once '../modelos/carrito.php';
require_once '../modelos/conexion.php';

$carrito= new carrito();
$userID=1;
    // mandamos llamar la clase de obtener de la variable perfil que es la clase perfil
    $productos = $carrito->obtenerCarrito($userID);
    //<h3>TOTAL A PAGAR: $<?php echo $total['total']; 
    

