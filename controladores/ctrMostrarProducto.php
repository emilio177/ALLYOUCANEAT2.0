<?php
require_once '../modelos/producto.php';
require_once '../modelos/conexion.php';
    $mostrar = new producto();
    $productos = $mostrar->mostrarProductos(); // Obtiene la lista de cursos
?>