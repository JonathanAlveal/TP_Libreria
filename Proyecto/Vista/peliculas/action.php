<?php

$ruta_base = "../";

$titulo = "";

include_once("../estructura/cabecera.php");

$resp = false;

$ambPeliculas = new AbmPelicula();

$ruta_mostrar_resultado = "";

if(!isset($datos)) {

    $datos = encapsulamientoEnvio();

    if(array_key_exists("rutaMostrarResultado",$datos)){       
        $ruta_mostrar_resultado = $datos["rutaMostrarResultado"];
    }
    
}  

if (isset($datos['accion'])){
    if($datos['accion']=='listar'){
        $pelis = convert_array($ambPeliculas->buscarpeli(null));
    } else {
        $resp = $ambPeliculas->Amb($datos);
        if($resp){
            $mensaje = true;
        }else {
            $mensaje = false;
        }
        
        if($ruta_mostrar_resultado == ""){
            echo("<script>location.href = 'index.php?msg=$mensaje';</script>");
        }else{
            echo("<script>location.href = '$ruta_mostrar_resultado?msg=$mensaje';</script>");
        }
      }
}
        
?>

