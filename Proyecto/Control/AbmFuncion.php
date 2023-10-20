<?php

    class AbmFuncion{

        //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto

        public function Amb($datos){

            $resp = false;

            if($datos["accion"] == "actualizar"){
                if($this->modificarfuncion($datos)){
                    $resp = true;
                }

            }

            if($datos["accion"] =="borrar"){
                if($this->eliminarfunci($datos)){
                    $resp = true;
                }
            }

            if($datos["accion"] == "nuevo"){
                if($this->insertarfuncion($datos)){
                    $resp = true;
                }
            }

            return $resp;

        }

        /**
         * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
         * @param array $param
         * @return funcion
         */

        private function cargarObjetofuncion($param){

            $objfuncion = null;
            if(array_key_exists("id_funcion",$param) && array_key_exists("id_peli",$param) && array_key_exists("fecha",$param) && array_key_exists("hora",$param)&& array_key_exists("cant_max",$param)&& array_key_exists("cant_actual",$param)){
                $objfuncion = new Funcion();
                $objpeli = new Pelicula();
                $objpeli->set_id_peli($param["id_peli"]);
                $objpeli->seleccionarpelicula();
                $objfuncion->cargarfuncion($param["id_funcion"],$objpeli,$param["fecha"],$param["hora"],$param["cant_max"],$param["cant_actual"]);
            }
            return $objfuncion;
        }

        /**
         * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
         * @param array $param
         * @return funcion
         */
        private function cargarObjfuncionClave($param){
            $objfuncion = null;
            if(isset($param["id_funcion"])){
                $objfuncion = new Funcion();
                $objfuncion->cargarfuncion($param["id_funcion"],null,null,null,null,null);
            }
            return $objfuncion;
        }

        /**
         * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
         * @param array $param
         * @return boolean
         */
        private function seteadosCamposClave($param){
            $resultado = false;
            if(isset($param["id_funcion"])){
                $resultado = true;
            }
            return $resultado;
        }


        /**
         * permite inserta un objeto auto
         * @param array $param
         */
        function insertarfuncion($param){
            $resultado = false;
            //$param["Patente"] = null;
            $objfuncion = $this->cargarObjetofuncion($param);
            if($objfuncion != null && $objfuncion->insertarfuncion()){
                $resultado = true;
            }
            return $resultado;
        }

        /**
         * permite eliminar un objeto funcion
         * @param array $param
         * @return boolean
         */
        public function eliminarfunci($param){
            $resultado = false;
            if($this->seteadosCamposClave($param)){
                $objfuncion = $this->cargarObjfuncionClave($param);
                if($objfuncion != null && $objfuncion->eliminarfuncion()){
                    $resultado = true;
                }
            }
            return $resultado;
        }

        /**
         * permite modificar un objeto funcion
         * @param array $param
         * @return boolean
         */
        public function modificarfuncion($param){
            $resultado = false;
            if($this->seteadosCamposClave($param)){
                $objAuto = $this->cargarObjetofuncion($param);
                if($objAuto != null && $objAuto->actualizarfuncion()){
                    $resultado = true;
                }
            }
            return $resultado;
        }

        /**
         * permite buscar un objeto funcion
         * @param array $param
         * @return array
         */
        public function buscarfuncion($param){
            $condicionWhere = " true ";
            if($param <> null){
                if(isset($param["id_funcion"])){
                    $condicionWhere = $condicionWhere . " and id_funcion = '".$param["id_funcion"]."'";
                }
                if(isset($param["id_peli"])){
                    $condicionWhere = $condicionWhere . " and id_peli = '".$param["id_peli"]."'";
                }
                if(isset($paren["fecha"])){
                    $condicionWhere = $condicionWhere . " and fecha = '".$paren["fecha"]."'";
                }
                if(isset($param["hora"])){
                    $condicionWhere = $condicionWhere . " and hora = '".$param["hora"]."'";
                }
                if(isset($param["cant_max"])){
                    $condicionWhere = $condicionWhere . " and cant_max = '".$param["cant_max"]."'";
                }
                if(isset($param["cant_actual"])){
                    $condicionWhere = $condicionWhere . " and cant_actual = '".$param["cant_actual"]."'";
                }
            }
            $arregloBuscar = Funcion::listarfunciones($condicionWhere);
            return $arregloBuscar;
        }
    }

?>