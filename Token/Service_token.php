<?php

    class serviceToken implements Metodos,Mensajes{
        static $ServiceToken;
        private $archivo;
        private $metodo;
        static public function getInstance($Clase, $Metodo){
            if(!(self::$ServiceToken instanceof self)){
                self::$ServiceToken = new serviceToken();
                self::$ServiceToken->setArchivo($Clase);
                self::$ServiceToken->setMetodo($Metodo);
                if(array_key_exists(0,self::$ServiceToken->getArchivo())){
                    define("path", "Entidades/".self::$ServiceToken->getArchivo()[0].".php");
                    if(file_exists(path)){
                        include_once(path);
                        if(array_key_exists(0,self::$ServiceToken->getMetodo())){
                            return call_user_func_array(array(self::$ServiceToken->getArchivo()[0]::getInstance(), self::$ServiceToken->getMetodo()[0]), [null]);
                        }else{
                            return self::informacion["metodoToken"];
                        }
                    }else{
                        return self::informacion["archivo"];
                    }
                }else{
                    return self::informacion["claseToken"];
                }    
            }
        }
        function __destruct() {
            self::$ServiceToken=null;
        }
        public function getArchivo(){
            return $this->archivo;
        }
        public function setArchivo($token){
            return $this->Archivo($token);
        }
        private function Archivo($token){
            $this->archivo = array_keys(self::token_class, $token);
            return $this->archivo;
        }
        public function getMetodo(){
            return $this->metodo;
        }
        public function setMetodo($token){
            return $this->Metodo($token);
        }
        private function Metodo($token){
            $this->metodo = array_keys(self::token_metodos, $token);
            return $this->metodo;
        }
        
        
    }

?>