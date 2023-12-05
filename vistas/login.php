<?php
require_once '../assets/adodb5/adodb.inc.php';
require_once '../modelos/conexion.php';
//require_once '../modelos/Ctrlogin.php'

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    
</body>
<main>
    <div id="login-overlay" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Inicia Sesion</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="well">
                            <form id="loginForm" method="POST" action="login.php?action=login" novalidate="novalidate">
                                <div class="form-group">
                                    <label for="username" class="control-label">Username</label>
                                    <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                    <span class="help-block"></span>
                                </div>
                                <?php
                                include("../controladores/Ctrlogin.php");
                                ?>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                    <span class="help-block"></span>
                                </div>
                                <div id="loginErrorMsg" class="alert alert-error hide">Wrong username or password</div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" id="remember"> Remember login
                                    </label>
                                    <p class="help-block">(if this is a private computer)</p>
                                </div>
                                <button type="submit" class="btn btn-success btn-block" name="btningresar">INGRESAR</button>
                                <a href="../index.html" class="btn btn-default btn-block">Atras</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <p class="lead"><span class="text-success"></span></p>
                        <ul class="list-unstyled" style="line-height: 2">
                            <li><span class="fa fa-check text-success"></span> See all your orders</li>
                            <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                            <li><span class="fa fa-check text-success"></span> Save your favorites</li>
                            <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                            <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                            <!--<li><a href="/read-more/"><u>Read more</u></a></li>-->
                        </ul>
                        <!--<p><a href="/new-customer/" class="btn btn-info btn-block">Yes please, register now!</a></p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>

</footer>
</html>