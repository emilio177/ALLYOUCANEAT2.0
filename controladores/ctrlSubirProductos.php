<?php
require_once '../modelos/carrito.php';
require_once '../modelos/conexion.php';

$subirPr = new carrito();
$subir = $subirPr->SubirProducto();

