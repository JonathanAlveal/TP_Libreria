<?php
$titulo = "comprar";
$ruta_base = "../";
include_once("../estructura/cabecera.php");

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;


$datos = encapsulamientoEnvio();
$buscar["id_peli"] = $datos["id_peli"];

$ambPeliculas = new AbmPelicula();
$ambFunciones = new AbmFuncion();

$funciones = convert_array($ambFunciones->buscarfuncion($buscar));

$captchaNumber = new PhraseBuilder(5,'0123456789');

$builder = new CaptchaBuilder(null,$captchaNumber);

$font = "../../Util/class/Captcha-master/src/Gregwar/Captcha/Font/captcha1.ttf";

//decoraciones 
//$builder->setBackgroundColor(0, 0, 0);
//$builder->setTextColor(255,255,255);
//$builder->setMaxBehindLines(2);
//$builder->setMaxFrontLines(2);
//$builder->setDistortion(false);

$builder->build(300,70,$font);

//$builder->save("ruta_especificada",calidad);

$catchaValid = $builder->getPhrase();

?>


<div class="container d-flex justify-content-center">

    <form id="formulario" action="../funciones/action.php" method="post" class="needs-validation" novalidate >

        <input type="hidden" name="accion" id="accion" value="actualizar">
        <input type="hidden" name="id_peli" id="id_peli" value="<?php echo $datos["id_peli"]; ?>">
        <input type="hidden" name="hora" id="hora" value="">
        <input type="hidden" name="fecha" id="fecha" value="">
        <input type="hidden" name="cant_max" id="cant_max" value="">
        <input type="hidden" name="cant_actual" id="cant_actual" value="">
        <input type="hidden" name="rutaMostrarResultado" id="rutaMostrarResultado" value="../comprar/finalizacion.php">
        
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center text-align-center">
                <h1 class="display-5"> Finalizar compra. </h1>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center text-align-center">
                    <?php
                        $respuestaCant = 0;
                        $id_funcion_mal = null;
                        if(count($funciones) == 0){
                            echo '<h1 class="display-5 p-2 text-danger border border-danger"> Por desgracia, no hay fechas disponibres.</h1> <br> 
                            ';
                            $respuestaCant = 0;
                        }

                        if(count($funciones) > 0){

                            for($i = 0; $i < count($funciones); $i++){
                                if($datos["cantidad"] <= ($funciones[$i]["cant_max"] - $funciones[$i]["cant_actual"])){
                                    $respuestaCant = $respuestaCant + 1;
                                }else{
                                    $id_funcion_mal = $funciones[$i]["id_funcion"];
                                }
                            }
                        }

                        if($respuestaCant == 0){
                            echo '<h1 class="display-5 p-2 text-danger border border-danger">Por desgracia no hay entradas suficientes para realizar la compra</h1>';
                            $desabilitar = "disabled";
                        }
                    ?>
                          
            </div>
        </div>

        <hr>

        <div class="row mt-5">

            <div class="col-12">
                <label class="mb-2" for="id_funcion">Dia y Hora de la funcion:</label>
                <select class="form-select" name="id_funcion" id="id_funcion" <?php if($respuestaCant == 0){ echo $desabilitar;}?> required>
                    <option value=""></option>
                    <?php
                        $datosModificar = array();
                        for($i = 0; $i < count($funciones); $i++){
                            $diaFuncion = $funciones[$i]["fecha"];
                            $horaFuncion = $funciones[$i]["hora"];
                            $desabilitar = "";
                            $mensajeDeDesabilitar = "";
                            if($id_funcion_mal == $funciones[$i]["id_funcion"]){ $desabilitar = "disabled";$mensajeDeDesabilitar = " | Entradas agotadas";}
                            echo 
                            '<option value="'.$funciones[$i]["id_funcion"].'" '.$desabilitar.' >'.$diaFuncion.' | '.$horaFuncion.''.$mensajeDeDesabilitar.'</option>';
                            $datosModificar[$i]["cantMax"] = $funciones[$i]["cant_max"];
                            $datosModificar[$i]["cantActual"] = $funciones[$i]["cant_actual"];
                            $datosModificar[$i]["hora"] = $horaFuncion;
                            $datosModificar[$i]["fecha"] = $diaFuncion;
                        }
                    ?>
                </select>  

                    <?php
                        for($i = 0; $i < count($datosModificar); $i++){
                            echo '<input type="hidden" id="hora'.$funciones[$i]["id_funcion"].'" value="'.$datosModificar[$i]["hora"].'">
                            <input type="hidden" id="fecha'.$funciones[$i]["id_funcion"].'" value="'.$datosModificar[$i]["fecha"].'">
                            <input type="hidden" id="cantMax'.$funciones[$i]["id_funcion"].'" value="'.$datosModificar[$i]["cantMax"].'">
                            <input type="hidden" id="cantActual'.$funciones[$i]["id_funcion"].'" value="'.$datosModificar[$i]["cantActual"] + $datos["cantidad"].'">';

                        }
                    ?>
                        
                <div id="fechaYhoraNo" class="invalid-feedback"></div>
                <div id="fechaYhoraSi" class="valid-feedback"></div>
            </div>

        </div>

        <div class="row mt-5">

            <div class="col-6">
                <label class="mb-2" for="catcha">Valide que no es un robot:</label>
                <input type="hidden" name="catcha-value" id="catcha-value" value="<?php echo $catchaValid; ?>" >
                <img id="catcha-img" src="<?php echo $builder->inline(); ?>" />
                <input type="text" id="catcha" name="catcha" class="form-control" <?php if($respuestaCant == 0){ echo $desabilitar;}?> required>
                <div id="catchano" class="invalid-feedback"></div>
                <div id="catchasi" class="valid-feedback"></div>
            </div>
            
        </div>

        <div class="row mt-5">
            <div class="col-12">
                    <h3 class="display-3">
                        
                        <?php
                            $buscarPeli["id_peli"] = $datos["id_peli"]; 
                            $pelicula = convert_array($ambPeliculas->buscarpeli($buscarPeli));
                            $precio = $pelicula[0]["precio"] * $datos["cantidad"];
                            echo" Total a pagar: $".$precio;
                        ?>
                    </h3>
            </div>
        </div>
        

        <div class="row mt-5">
            <div class="col-12">
                <input class="btn btn-success" type="submit" value="finalizar" <?php if($respuestaCant == 0){ echo $desabilitar;}?> >
                <input class="btn btn-secondary" type="reset" value="Reiniciar" <?php if($respuestaCant == 0){ echo $desabilitar;}?> >
            </div>
            <div class="col-12 mt-5">
                <input type="button" class="mt-1 btn btn-primary" onclick="javascript: history.go(-1)" value="Volver"></input>
            </div>
        </div>
            
        <hr class="mt-5">

    </form>

</div>

<script src="../js/datosInsert.js"></script>
<script src="../js/validacionNro2.js"></script>

<?php
include_once("../estructura/pie.php");
?>