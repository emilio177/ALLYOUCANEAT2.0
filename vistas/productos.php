<?php
include("../controladores/ctrMostrarProducto.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platillos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/js/carrito.js">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>
    <header>
        <!--Barra de Navegacion-->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="img_nav"><img src="../assets/images/Restlogocorr.png" height="60" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./vistas/productos.php">Platillos<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../vistas/crearProductos.html">subir<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../vistas/actualizar.php">MODIFICAR<span
                                class="sr-only">(current)</span></a>
                    </li>
                 
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Reservacion<span class="sr-only">(current)</span></a>
                    </li>
                    <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Más
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="./vistas/productos.php">Platillos</a>
              <a class="dropdown-item" href="#">Reservacion</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Para Llevar</a>
            </div>
          </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="./vistas/nosotros.html">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>

                <!-- Iconos -->
                <div class="icons">
                    <div>
                        <a class="nav-link" href="carrito.php" id="contador">
                            <img src="../assets/img/carrito.png" alt="" width="25px" height="auto">
                            <div class="carrito-container">
                                <a class="fa-solid fa-cart-shopping" id="carrito-btn" href="./carrito.php"><sup
                                        id="contador-value"></sup></a>
                            </div>
                        </a>
                    </div>
                    <!--<a class="fa-solid fa-user" id="user-btn"  href="./login.php"></a>-->

                </div>
                <!--<form class="form-inline my-2 my-lg-0">
          <div>
            <a href="./vistas/sign up.html" class="btn btn-outline-success">Sign Up</a>-->
                <!--Se cree un btn para que nos lleve a otra ventana-->
                <!--<a href="./vistas/login.php" class="btn btn-outline-success">Login</a>-->
                <!--Se cree un btn para que nos lleve a otra ventana-->
                <!-- </div> -->
                </form>
            </div>
        </nav>
    </header>
    <main>
        <div class="row">
            <?php
    // Asumiendo que $productos es un arreglo con información de productos
    /* ///select id_producto, producto, descripción, 
            //stock, imagen, precio, id_status from producto
            // where id_status=1; */
    foreach ($productos as $producto):
    ?>
            <div class="col-4">
                <hr>
                <h2><?= $producto['producto'] ?></h2>
                <p>Precio: <?= $producto['precio'] ?></p>
                <p>Unidades en Stock: <?= $producto['stock'] ?></p>
                <p>Sobre el platillo: <?= $producto['descripcion'] ?></p>
                <div class="photo">
                    <img src="../assets/images/<?php echo $producto['imagen']; ?>" alt="">
                </div>
                <!-- Botón para agregar al carrito, pasa el id del producto a la función agregarAlCarrito -->
                <a class="add-to-cart"
                    href="../controladores/ctrlAgregarCarrito.php?id=<?php echo $producto['id_producto']; ?>&cantidad="id="add-to-cart-link-<?php echo $producto['id_producto']; ?>">Add to cart</a>
                <div id="contador-<?php echo $producto['id_producto']; ?>">0</div>
                <button onclick="aumentarContador(<?php echo $producto['id_producto']; ?>)">+</button>
                <button onclick="disminuirContador(<?php echo $producto['id_producto']; ?>)">-</button>

            </div>
            <?php endforeach; ?>
        </div>

    </main>

</body>
<script>
$(document).ready(function() {
    $.ajax({
        url: "../controladores/contador_carrito.php", // Ruta al archivo de servidor
        type: "GET",
        success: function(data) {
            $("#contador-value").text("" + data); // Muestra el valor en la barra de navegación
        }
    });
});

function aumentarContador(idProducto) {
    var contador = document.getElementById('contador-' + idProducto);
    var valorActual = parseInt(contador.textContent);
    contador.textContent = valorActual + 1;
    actualizarURLCarrito(idProducto, valorActual + 1);
}

function disminuirContador(idProducto) {
    var contador = document.getElementById('contador-' + idProducto);
    var valorActual = parseInt(contador.textContent);
    if (valorActual > 0) {
        contador.textContent = valorActual - 1;
        actualizarURLCarrito(idProducto, valorActual - 1);
    }
}

function actualizarURLCarrito(idProducto, cantidad) {
    var link = document.getElementById('add-to-cart-link-' + idProducto);
    link.href = `../controladores/ctrlAgregarCarrito.php?id=${idProducto}&cantidad=${cantidad}`;
}
</script>
<footer>

</footer>

</html>