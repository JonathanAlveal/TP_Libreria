<?php 

    class Funcion{

        private $id_funcion;
        private $fecha;
        private $hora;
        private $objpeli;
        private $cant_max;
        private $cant_actual;
        private $mensajeOperacion;

        public function __construct()
        {
            $this->id_funcion = "";
            $this->fecha = "";
            $this->hora = "";
            $this->objpeli = null;
            $this->cant_max= "";
            $this->cant_actual="";
            $this->mensajeOperacion = "";
        }

        //metodos get de la clase automovil

        public function get_id_funcion(){
            return $this->id_funcion;
        }

        public function get_fecha(){
            return $this->fecha;
        }

        public function get_hora(){
            return $this->hora;
        }

        public function get_objpeli(){
            return $this->objpeli;
        }
        public function get_cant_max(){
            return $this->cant_max;
        }
        public function get_cant_actual(){
            return $this->cant_actual;
        }

        public function get_mensajeOperacion(){
            return $this->mensajeOperacion;
        }

        //metodos set de la clase automovil

        public function set_id_funcion($funcion){
            $this->id_funcion = $funcion;
        }

        public function set_fecha($fecha){
            $this->fecha = $fecha;
        }

        public function set_hora($hora){
            $this->hora = $hora;
        }

        public function set_objpeli($peli){
            $this->objpeli = $peli;
        }
        public function set_cant_max($max){
            $this->cant_max=$max;
        }
        public function set_cant_actual($actual){
            $this->cant_actual=$actual;
        }

        public function set_mensajeOperacion($mensajeOperacion){
            $this->mensajeOperacion = $mensajeOperacion;
        }

    /*****************************************************************/

        function cargarfuncion($id_funcion,$peli,$fecha,$hora,$max,$actual){

            $this->set_id_funcion($id_funcion);
            $this->set_fecha($fecha);
            $this->set_hora($hora);
            $this->set_objpeli($peli);
            $this->set_cant_actual($actual);
            $this->set_cant_max($max);

        }

    /*****************************************************************/

        /**
         * funcion para insertar un automovil en la base de datos
         */
        public function insertarFuncion(){
            
            $resultado = false;//bandera
            $objpeli = $this->get_objpeli();
            $bd = new BaseDatos();//iniciamos la base de datos

            $consultaInsert = "INSERT INTO funciones (id_funcion,id_peli,fecha,hora,cant_max,cant_actual) VALUES ('". $this->get_id_funcion()."','".$objpeli->get_id_peli()."','". $this->get_fecha()."','".$this->get_hora()."','".$this->get_cant_actual()."','".$this->get_cant_max()."')";//consulta de insertar

            if ($bd->Iniciar()){
                if($idInsert = $bd->Ejecutar($consultaInsert)){
                    
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
         * 
         */

        function seleccionarfuncion(){

            $resultado = false; //bandera

            $bd = new BaseDatos();//base de datas

            $consultaSelect = "SELECT * FROM funciones WHERE id_funcion = ".$this->get_id_funcion().";";//condicion select

            if($bd->Iniciar()){//iniciamos la base de datos
                $resultadoConsulta = $bd->Ejecutar($consultaSelect);//realizamos la consulta
                if($resultadoConsulta > -1){
                    if($resultadoConsulta > 0){

                        $row = $bd->Registro();//coleccion datos
                        $objpeli = new pelicula();//obj peli
                        $objpeli->set_id_peli($row["id_peli"]);//seteo el nro dni para poder buscar al duenio del auto
                        $objpeli->seleccionarpelicula();
                        $this->cargarfuncion($row["id_funcion"],$objpeli,$row["fecha"],$row["hora"],$row["cant_max"],$row["cant_actual"]);
                        $resultado = true;
                    }
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }
        }


        /**
         * 
         */
        
        public function actualizarfuncion(){

            $resultado = false;
            $bd = new BaseDatos();
            $objpeli = $this->get_objpeli();

            $consultaUpdate = "UPDATE funciones SET 
             id_peli = '".$objpeli->get_id_peli()."', fecha = '".$this->get_fecha()."', hora = '".$this->get_hora()."', cant_max = '".$this->get_cant_max()."', cant_actual = '".$this->get_cant_actual().
             "' WHERE id_funcion = '".$this->get_id_funcion()."'";

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
         * 
         */

        public function eliminarfuncion(){

            $resultado = false;
            $bd = new BaseDatos();
            $consultaDelete = "DELETE FROM funciones WHERE id_funcion = ".$this->get_id_funcion();

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


        /**
         * 
         */

        public static function listarfunciones($condicion = ""){

            $i = 0;
            $arregloLista = array();
            $bd = new BaseDatos();
            $consultaLista = "SELECT * FROM funciones";

            if($condicion != ""){
                $consultaLista = $consultaLista." WHERE ".$condicion;
            }

            $resultadoConsulta = $bd->Ejecutar($consultaLista);

            if($resultadoConsulta > -1){
                if($resultadoConsulta > 0){     
                    while($row = $bd->Registro()){
                        $objfuncion = new Funcion();
                        $objpeli = new Pelicula();
                        $objpeli->set_id_peli($row["id_peli"]);
                        $objpeli->seleccionarpelicula();
                        $objfuncion->cargarfuncion($row["id_funcion"],$objpeli,$row["fecha"],$row["hora"],$row["cant_max"],$row["cant_actual"]);
                        $arregloLista[] = $objfuncion;
                    }
                }
            }else{
                $this->set_mensajeOperacion($bd->getError());
            }

            return $arregloLista;

        }

    /*******************************************************************************/

    }

?>