<?php include '../controladores/mostrarCarrito.php'  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/carrito.css">
</head>

<body>
	<a href=""></a>
    <div class="container">
        <div class="row">
            <div class="col-xs-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="btn btn-primary btn-sm btn-block"
                                        href="./productos.php">
                                        <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" >
                    <?php foreach ($productos as $producto) { ?>
                    
                        <div class="row">
                            <?php   ?>
                            <div class="col-xs-2"><img src="../assets/images/<?=$producto['imagen']?>">
                            </div>
                            <div class="col-xs-4">
                                <p><?php echo $producto['id_producto']; ?>

                            </div>
                            <div class="col-xs-6">
                                <div class="col-xs-6 text-right">
                                    <p>producto: <?= $producto['producto'] ?></p>
                                    <p>Precio: <?= $producto['precio'] ?></p>
									<p>Cantidad: <?= $producto['cantidad'] ?></p>
                                    <p>SUBTOTAL $ <?php echo $producto['subtotal']; ?></p>
                                </div>
                                <div>
                                    <a class="glyphicon glyphicon-trash" style="text-decoration:none"
                                        href="../controladores/ctrlBorrarCarrito.php?id=<?php echo $producto['id_producto']; ?>"></a>

                                </div>

                            </div>
                            <hr>
                            <hr>
                            <?php } ?>
                        </div>
                        <div class="panel-footer">
                            <div class="row text-center">
                                <a class="Comprar" href="../controladores/ComprasCarrito.php"><img
                                        src="../assets/img/tarjeta-de-debito.png" alt=""> COMPRAR </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>