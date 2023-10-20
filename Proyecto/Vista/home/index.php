
<?php

  $titulo = "Home";
  $ruta_base = "../"; 
  include_once("../estructura/cabecera.php"); 

  $peliculas = new AbmPelicula();
  
  $ambFunciones = new AbmFuncion();

  $pelis = convert_array($peliculas->buscarpeli(null));

  $funciones = convert_array($ambFunciones->buscarfuncion(null));

  //$datos["accion"] = "listar";

  //include_once("../peliculas/action.php");

  

?>

<div class="container-fluid ">

  <div class="row">
      <div class="col-12 d-flex justify-content-center text-align-center">
        <h1 class="display-2">PELICULAS</h1>
      </div>
  </div>

  <hr class="mt-5 mb-5">

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">

      <?php
        $e = 1;
        $active = true;
        for($i = 0; $i < count($pelis); $i++){
          if($active){
            $active = false;
            echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="'.$i.'" class="active" aria-current="true" aria-label="Slide '.$e+$i.'"></button>';
          }else{
            echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="'.$i.'" aria-label="Slide '.$e+$i.'"></button>';
          }
        }

      ?>

    </div>

    <div class="carousel-inner">

        <?php

          $activeCarrusel = true;
          for($i = 0; $i < count($pelis); $i++){   

            $dir = "temp/";
            
            if(!file_exists($dir)){
              mkdir($dir);
            }else{
              $nombreArchivo = $dir."qr_".$pelis[$i]["nombre"].".png";

              $tamanio = 4.5;//tamaño de la imagen que le daremos al qr, 33 * 10 = 330px, donde 10 es $tamanio, osea, 33 * $tamanio = qrpx
              $level = "Q";// calidad del qr, L,M,Q,H
              $framSize = 3;// margen que le daremos al qr
              $contenido = $pelis[$i]["trailer"];// contenido que mostrara nuestro qr

              QRcode::png($contenido, $nombreArchivo, $level, $tamanio, $framSize);

            }    
            

            if($activeCarrusel){
              $activeCarrusel = false;
              echo
              '<div class="carousel-item active">
              <img src="'.$pelis[$i]["imagen"].'" class="d-block w-100 peliculas" alt="peli1">
                <div class="cartel carousel-caption d-none d-md-block">
                  <h1 class="mb-3 display-6">"'.$pelis[$i]["nombre"].'"</h1>
                  <h4 class="mb-3">PRECIO ENTRADA: $'.$pelis[$i]["precio"].'</h4>
                  <div class="col-12">
                      <h5>Mira el trailer aqui</h5>
                      <img class="qr" src="'.$nombreArchivo.'" alt="qr">
                  </div>
                </div>
              </div>';
            }else{
              echo
              '<div class="carousel-item">
                <img src="'.$pelis[$i]["imagen"].'" class="d-block w-100 peliculas" alt="peli">
                  <div class="cartel carousel-caption d-none d-md-block">
                    <h1 class="mb-3 display-6">'.$pelis[$i]["nombre"].'</h1>
                    <h4 class="mb-3">PRECIO ENTRADA: $'.$pelis[$i]["precio"].'</h4>
                    <div class="col-12">
                      <h5>Mira el trailer aqui</h5>
                      <img class="qr" src="'.$nombreArchivo.'" alt="qr">
                    </div>
                  </div>
              </div>';
            }
          }

        ?>
      
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>

  </div>

  <hr class="mt-5">
  
</div>

<?php
    include_once("../estructura/pie.php"); 
?>