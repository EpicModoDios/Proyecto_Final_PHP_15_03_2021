<?php

    class Service_usuario implements Mensajes,Plantilla{
        static $serviceUsuario;
        public $plantilla;
        static public function getInstance(){
            if(!(self::$serviceUsuario instanceof self)){
                self::$serviceUsuario = new Service_usuario();
            }
            return self::$serviceUsuario; 
        }
        public function saludar(){
            $this->plantilla = <<<FIN
            <div class="container">
                <div class="row py-3 text-white">
                {join(" ", $this::service['usuarioSaludar'])}}
                </div>
            </div>
FIN;
            return $this->plantilla;
        } 
        // function __destruct() {
        //     self::$plantilla = null;
        // }
    }
?>