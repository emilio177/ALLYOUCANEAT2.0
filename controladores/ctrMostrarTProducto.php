<?php
require_once '../modelos/productos_model.php';
require_once '../modelos/conexion.php';
    $mostrar = new mostrar();
    $productos = $mostrar->mostrarTodosProductos(); // Obtiene la lista de cursos
?>