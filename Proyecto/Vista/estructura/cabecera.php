
<?php

include_once($ruta_base."../configuraciones.php");

include_once($ruta_base."../Util/class/Captcha-master/vendor/autoload.php");

include_once($ruta_base."../Util/class/spout/vendor/autoload.php");

include_once($ruta_base."../Util/class/phpqrcode/qrlib.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo $ruta_base; ?>estructura/bootstrap-5.1.3-dist/css/bootstrap.min.css">

    <script src="<?php echo $ruta_base; ?>estructura/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo $ruta_base; ?>css/style.css">

    <link rel="stylesheet" href="<?php echo $ruta_base; ?>css/estructura.css">

    <title><?php echo $titulo; ?></title>

</head>

<body>

    <header>

        <div class="cabecera row">
            
            <div class="logo col-4">

                <h1 class="display-1">Cinema</h1>

            </div>

            <div class="menu col-8">
                <a class="links" href="<?php echo $ruta_base; ?>home/index.php"><div class="contenedor-links"><h2>Home</h2></div></a>
                <!--<a class="links" href="<?php echo $ruta_base; ?>peliculas/index.php"><div class="contenedor-links"><h2>Peliculas</h2></div></a>
                <a class="links" href="<?php echo $ruta_base; ?>funciones/index.php"><div class="contenedor-links"><h2>Funciones</h2></div></a>-->
                <a class="links" href="<?php echo $ruta_base; ?>comprar/comprarEntrada.php"><div class="contenedor-links"><h2>Compra</h2></div></a>
                <a class="links" href="<?php echo $ruta_base; ?>calendario/calendarioDeFunciones.php"><div class="contenedor-links"><h2>Calendario</h2></div></a>            
            </div>  
        </div>

    </header>

    
