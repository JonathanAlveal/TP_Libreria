<?php
$titulo = "Comprar";
$ruta_base = "../";
include_once("../estructura/cabecera.php");

$pelis = new AbmPelicula();

?>


<div class="container d-flex justify-content-center">

    <form id="formulario" action="accionComprar.php" method="post" class="needs-validation" novalidate>

        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center text-align-center">
                <h1 class="display-5">Comprar entradas</h1>               
            </div>
        </div>

        <hr>

        <div class="row mt-5">

            <div class="col-6">
                <label class="mb-2" for="id_peli">Seleccione la pelicula a ver:</label>
                <select class="form-select" name="id_peli" id="id_peli" required>
                    <option value=""></option>
                    <?php 
                        $peliculas = convert_array($pelis->buscarpeli(null));
                        for($i = 0; $i < count($peliculas); $i++){    
                            echo '<option value="'.$peliculas[$i]["id_peli"].'">'.$peliculas[$i]["nombre"].'</option>';
                        }
                    ?>
                </select>
                <div id="peliculano" class="invalid-feedback"></div>
                <div id="peliculasi" class="valid-feedback"></div>
        
            </div>

            <div class="col-6">
                <input type="hidden" name="cantidad_bd" id="cantidad_bd" value="">
                <label class="mb-2" for="cantidad">Cantidad de entradas:</label>
                <input class="form-control" name="cantidad" id="cantidad" type="number" required>
                <div id="cantidadno" class="invalid-feedback"></div>
                <div id="cantidadsi" class="valid-feedback"></div>
                
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12">
                <input class="btn btn-success" id="enviar" type="submit" value="Continuar">
                <input class="btn btn-secondary" type="reset" value="Reiniciar">
            </div>
        </div>
        
        <hr class="mt-5">

    </form>

    

</div>

<script src="../js/validacionNro1.js"></script>

<?php
include_once("../estructura/pie.php");
?>