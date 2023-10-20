<?php

    class AbmPelicula{

        //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
        public function Amb($datos){

            $resp = false;

            if($datos["accion"] == "actualizar"){
                if($this->modificarpeli($datos)){
                    $resp = true;
                }

            }

            if($datos["accion"] =="borrar"){
                if($this->eliminarpeli($datos)){
                    $resp = true;
                }
            }

            if($datos["accion"] == "nuevo"){
                if($this->insertarPers($datos)){
                    $resp = true;
                }
            }

            return $resp;

        }

        /**
         * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
         * @param array $param
         * @return pelicula
         */
        private function cargarObjetopelicula($param){
            $objpeli = null;
            if(array_key_exists("id_peli",$param) && array_key_exists("nombre",$param) && array_key_exists("precio",$param)&& array_key_exists("trailer",$param)&& array_key_exists("imagen",$param)){
                $objpeli = new Pelicula();
                $objpeli->cargarpelicula($param["id_peli"],$param["nombre"],$param["precio"],$param["trailer"],$param["imagen"]);
            }
            return $objpeli;
        }

        /**
         * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
         * @param array $param
         * @return pelicula
         */
        private function CargarObjpeliculaClave($param){
            $objpeli = null;
            if(isset($param["id_peli"])){
                $objpeli = new Pelicula();
                $objpeli->cargarpelicula($param["id_peli"],null,null,null,null);
            }
            return $objpeli;
        }

        /**
         * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
         * @param array $param
         * @return boolean
         */
        private function seteadosCamposClaves($param){
            $resultado = false;
            if (isset($param["id_peli"])){
                $resultado = true;
            }
            return $resultado;
        }

        /**
         * permite inserta un objeto pelicula
         * @param array $param
         */
        public function insertarPers($param){
            $resultado = false;
            //$param["id_peli"] = null;
            $objpeli = $this->cargarObjetopelicula($param);
            if($objpeli != null && $objpeli->insertarpelicula()){
                $resultado = true;
            }
            return $resultado;
        }

        /**
         * permite eliminar un objeto pelicula
         * @param array $param
         * @return boolean
         */
        public function eliminarpeli($param){
            $resultado = false;
            if($this->seteadosCamposClaves($param)){
                $objpeli = $this->CargarObjpeliculaClave($param);
                if($objpeli != null && $objpeli->eliminarpelicula()){
                    $resultado = true;
                }
            }
            return $resultado;
        }

        /**
         * permite modificar un objeto pelicula
         * @param array $param
         * @return boolean
         */
        public function modificarpeli($param){
            $resultado = false;
            if($this->seteadosCamposClaves($param)){
                $objpeli = $this->cargarObjetopelicula($param);
                if($objpeli != null && $objpeli->actualizarpelicula()){
                    $resultado = true;
                }
            }
            return $resultado;
        }

        /**
         * permite buscar un objeto pelicula
         * @param array $param
         * @return array
         */
        public function buscarpeli($param){
            $condicionWhere = " true ";
            if($param <> null){
                if(isset($param["id_peli"])){
                    $condicionWhere = $condicionWhere. " and id_peli = '".$param["id_peli"]."'";
                }
                if(isset($param["nombre"])){
                    $condicionWhere = $condicionWhere. " and nombre = '".$param["nombre"]."'";
                }
                if(isset($param["precio"])){
                    $condicionWhere = $condicionWhere. " and precio = '".$param["precio"]."'";
                }
                if(isset($param["trailer"])){
                    $condicionWhere = $condicionWhere. " and trailer = '".$param["trailer"]."'";
                }
                if(isset($param["imagen"])){
                    $condicionWhere = $condicionWhere. " and imagen = '".$param["imagen"]."'";
                }
                
            }
            $arregloBuscar = pelicula::listarpelicula($condicionWhere);
            return $arregloBuscar;
        } 
    }

?>