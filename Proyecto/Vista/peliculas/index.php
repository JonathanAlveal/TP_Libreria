<?php

$ruta_base = "../";
$titulo = "Peliculas";
include_once("../estructura/cabecera.php");

$datos = encapsulamientoEnvio();
$datos["accion"] = "listar";

include_once("action.php");

?>
<div class="container">

  <div class="row">
      <div class="col-12 d-flex justify-content-center text-align-center">
        <h1 class="display-2">PELICULAS</h1>
      </div>
  </div>

  <hr class="mt-5 mb-5">

  <div class="row mt-5">

      <?php 
        
        for($i = 0; $i < count($pelis); $i++){
          echo
          '<div class="col-12 mt-5 p-5 border">
            <h3 class="display-5">Nombre: '.$pelis[$i]["nombre"].'</h3>
            <h3 class="display-5">Precio: '.$pelis[$i]["precio"].'</h3>
          </div>';
        }
      ?>
  </div>

</div>

<?php
include_once("../estructura/pie.php");
?>