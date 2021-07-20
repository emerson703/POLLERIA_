<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Login Polleria</title>
</head>

<body background="imagen/fondo02.jpg">

    <div class="container">


        <div class="row">
            <div class="col-md-4 mx-auto">
                <img src="imagen/logo04.png" height="300px" width="100%" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto"  style="background-color:rgba(100, 100, 100, 0.5)">

                <form id="login" autocomplete="off">
                    <br>                                    
                    <div class="mt-2">
                        <input type="text" class="form-control" placeholder="ingrese el usuario" name="txtUsuario">
                    </div>
                    <div class="mt-2">
                        <input type="password" class="form-control" placeholder="ingrese la contraseña"
                            name="txtPassword">
                    </div>
                    <div class="mt-2">
                        <button id="btnIngresar" class="btn-primary btn">Ingresar</button>
                    </div>
                    <br>

                    <div id="mensajes">

                    </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js">
    </script>
    <script src="js/login.js"></script>
</body>

</html>