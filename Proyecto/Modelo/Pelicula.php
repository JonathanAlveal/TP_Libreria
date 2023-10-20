<?php

    class Pelicula{

        private $id_peli;
        private $nombre;
        private $precio;
        private $trailer;
        private $imagen;
        
        private $mensajeOperacion;

        public function __construct()
        {
            $this->id_peli = "";            
            $this->nombre = "";
            $this->precio = "";
            $this->trailer = "";
            $this->imagen = "";
            $this->mensajeOperacion = "";
        }

    //metodos get de la clase persona...

        public function get_id_peli(){
            return $this->id_peli;
        }

        public function get_nombre(){
            return $this->nombre;
        }

        public function get_precio(){
            return $this->precio;
        }

        public function get_trailer(){
            return $this->trailer;
        }

        public function get_imagen(){
            return $this->imagen;
        }

        public function get_mensajeOperacion(){
            return $this->mensajeOperacion;
        }

    //metodos set de la clase persona...

        public function set_id_peli($peli){
            $this->id_peli = $peli;
        }

        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }

        public function set_precio($precio){
            $this->precio = $precio;
        }

        public function set_trailer($trailer){
            $this->trailer = $trailer;
        }

        public function set_imagen($imagen){
            $this->imagen = $imagen;
        }

        public function set_mensajeOperacion($mensajeOperacion){
            $this->mensajeOperacion = $mensajeOperacion;
        }

    /**********************************************************************/

        public function cargarpelicula($id_peli,$nombre,$precio,$trailer,$imagen){

            $this->set_id_peli($id_peli);
            $this->set_nombre($nombre);
            $this->set_precio($precio);
            $this->set_trailer($trailer);
            $this->set_imagen($imagen);

        }

    /**********************************************************************/

        /**
         * funcion que selecciona a una persona dentro de la base de datos
         * 
         */
        public function seleccionarpelicula(){
            
            $resp = false;
            
            $bd=new BaseDatos();
            
            $consultaSelect = "SELECT * FROM peliculas WHERE id_peli = ".$this->get_id_peli();
            
            if($bd->Iniciar()){
                $res = $bd->Ejecutar($consultaSelect);
                if($res > -1){
                    if( $res > 0 ){
                        $row = $bd->Registro();
                        $this->cargarpelicula($row["id_peli"], $row["nombre"], $row["precio"], $row["trailer"], $row["imagen"]);
                        $resp = true;
                    }
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }
            return $resp;
        }

        /**
         * funcion que inserta a una persona dentro de la base de datos
         */
        public function insertarpelicula(){

            $resultado = false;//bandera
            $bd = new BaseDatos();//objeto base de datos
            $consultaInsert = "INSERT INTO pelicual(id_peli,nombre,precio,trailer,imagen) VALUES ('".$this->get_id_peli()."','".$this->get_nombre()."','".$this->get_precio()."','".$this->get_trailer()."','".$this->get_imagen()."');";

            if ($bd->Iniciar()){
                if($elId = $bd->Ejecutar($consultaInsert)){//$bd->Ejecutar retorna el id que se asigno
                    $resultado = true;
                }else{
                    $this->set_mensajeOperacion($bd->getError());
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }

            return $resultado;
        }


        /**
         * actualiza los datos de una persona en la base de datos
         */
        public function actualizarpelicula(){

            $bd = new BaseDatos();
            $resultado = false;
            $consultaUpdate = "UPDATE peliculas SET 
            nombre = '".$this->get_nombre()."',precio = '".$this->get_precio()."',trailer = '".$this->get_trailer()."',imagen = '".$this->get_imagen()." '
            WHERE id_peli = '".$this->get_id_peli()."'";

            if($bd->Iniciar()){
                if($bd->Ejecutar($consultaUpdate)){
                    $resultado = true;
                }else{
                    $this->set_mensajeOperacion($bd->getError());
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }

            return $resultado;

        }


        /**
         * elimina los datos de una persona en la base de datos
         */
        public function eliminarpelicula(){

            $bd = new BaseDatos();
            $resultado = false;
            $consultaDelete = "DELETE FROM peliculas WHERE id_peli = ".$this->get_id_peli();

            if($bd->Iniciar()){
                if($bd->Ejecutar($consultaDelete)){
                    $resultado = true;
                }else{
                    $this->set_mensajeOperacion($bd->getError());
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }

            return $resultado;

        }

        public static function listarpelicula($condicion = ""){
            
            $arregloLista = array();
            $bd = new BaseDatos();
            $consultaListar = "SELECT * FROM peliculas"; 

            if($condicion != ""){
                $consultaListar = $consultaListar." WHERE".$condicion;
            }

            $resultadoEjecucion = $bd->Ejecutar($consultaListar);

            if($resultadoEjecucion > -1 ){
                if($resultadoEjecucion > 0){
                    while($row = $bd->Registro()){
                        $objpeliculaListar = new Pelicula();
                        $objpeliculaListar->cargarpelicula($row["id_peli"], $row["nombre"], $row["precio"], $row["trailer"], $row["imagen"]);
                        $arregloLista[]=$objpeliculaListar;                    
                    }
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }
            return $arregloLista;
        }
    }
?>