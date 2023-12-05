<?php
require_once '../modelos/producto.php';
require_once '../modelos/conexion.php';
    $mostrar = new producto();
    $productos = $mostrar->mostrarTodosProductos(); // Obtiene la lista de cursos
?>