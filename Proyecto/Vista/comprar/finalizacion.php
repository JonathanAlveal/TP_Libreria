
<?php

$titulo = "Compra";

$ruta_base = "../";

include_once("../estructura/cabecera.php");

$datos = encapsulamientoEnvio();

?>

<div class="container">

    <div class="row mt-5">
        <div class="col-12">
            
            <h1 class="display-1"><?php if($datos["msg"]){echo "La compra se realizo con exito!";}else{echo "Ocurrio un error durante la compra";}  ?></h1>

            <hr class="mt-5">

        </div>
    </div>

</div>

<?php
include_once("../estructura/pie.php");
?>