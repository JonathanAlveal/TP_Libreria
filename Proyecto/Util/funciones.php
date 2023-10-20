<?php

    function encapsulamientoEnvio(){

        $arrayDatos = array();

        if(!empty($_GET)){
            $arrayDatos = $_GET;
        }
        if(!empty($_POST)){
            $arrayDatos = $_POST;
        }

        if(count($arrayDatos)){
            foreach($arrayDatos as $indice => $valor) {
                if($valor == ""){
                    $arrayDatos[$indice] = 'null';
                }
            }
        }

        return $arrayDatos;

    }

    /**
     * Imprime el contenido de la variable $e respetando su estructura con los tag <pre> de html
    */
    function verEstructura($e){
        echo "<pre>";
            print_r($e);
        echo "</pre>"; 
    }

    function dismount($object) {
        $reflectionClass = new ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
    
    function convert_array($param) {
        $_AAux= array();
        if (!empty($param)) {
            if (count($param)){
                foreach($param as $obj) {
                    array_push($_AAux,dismount($obj));    
                }
            }
        }
        
        return $_AAux;
    }

    spl_autoload_register(function($class_name){
        $directorys = array(
            $_SESSION['ROOT'].'Modelo/',
            $_SESSION['ROOT'].'Modelo/conector/',
            $_SESSION['ROOT'].'Control/',
            $GLOBALS['ROOT'].'Util/',
        );
        //print_object($directorys) ;
        foreach($directorys as $directory){
            if(file_exists($directory.$class_name . '.php')){
                // echo "se incluyo".$directory.$class_name . '.php';
                require_once($directory.$class_name . '.php');
                return;
            }
        }  
    })

    

?>