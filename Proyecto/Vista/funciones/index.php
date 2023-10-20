<?php
$ruta_base = "../";
$titulo = "Funciones";
include_once("../estructura/cabecera.php");

$datos = encapsulamientoEnvio();
$datos["accion"] = "listar";

include_once("action.php")

?>

<div class="container">

  <div class="row mt-5">

    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center text-align-center">
            <h1 class="display-2">Funciones</h1>
        </div>
    </div>

    <hr class="mt-5">

      <?php 
        
        for($i = 0; $i < count($funciones); $i++){
          $objPeli = dismount($funciones[$i]["objpeli"]);
          echo
          '<div class="col-12 mt-5 p-5 border">
            <h3 class="display-5">Fecha funcion: '.$funciones[$i]["fecha"].'</h3>
            <h3 class="display-5">Hora funcion: '.$funciones[$i]["hora"].'</h3>
            <h3 class="display-5">Cantidad maxima: '.$funciones[$i]["cant_max"].'</h3>
            <h3 class="display-5">Cantidad actual: '.$funciones[$i]["cant_actual"].'</h3>
            <h3 class="display-5">Pelicula a mostrar: '.$objPeli["nombre"].'</h3>
            <h3 class="display-5">Precio de la pelicula: '.$objPeli["precio"].'</h3>
          </div>';
        }
      ?>
  </div>

</div>

<?php
include_once("../estructura/pie.php");
?>