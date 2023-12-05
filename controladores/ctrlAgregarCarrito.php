<?php
require_once '../modelos/carrito.php';

//require_once '../modelos/mostrar.php';
require_once '../modelos/conexion.php';

$carrito = new carrito();
// Verifica si se ha enviado el ID del curso por la URL
if (isset($_GET['id']) && isset($_GET['cantidad'])) {
    // Recibe el ID del curso y la cantidad
    $producto = $_GET['id'];
    $cantidad = $_GET['cantidad'];
    $userID = 1;

 echo''.    $cantidad .'id='. $producto .'';

    // Resto del código para agregar el producto al carrito
   
      
       echo 'idProducto= '.$producto. ' user = '.$userID;
    $carrito->agregarCarrito($userID, $producto, $cantidad);
    }

?>