<?php
// ocupamos llamar perfil y autor
require_once '../modelos/carrito.php';

require_once '../modelos/conexion.php';

$carrito= new carrito();
$userID=1;
   $carritoComprado=$carrito->comprarCarrito($userID);
    //$usuariosCarrito = $carrito->obtenerCursosCarrito($userID);

