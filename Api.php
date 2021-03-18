<?php
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: GET, POST");
    header("Access-Control-Allow-Headers: * Access-Control-Request-Method");
    include_once("Token/Service_key.php");
    class servicioApi implements Mensajes{
        static $ServicioApi;
        private $respuesta;
        protected $validarEncabezados;
        public function __construct(){
            $this->validarEncabezados = (array) [
                "POST" => (array) [
                    "HTTPS_CLASE_MARCA" => null,
                    "HTTPS_CLASE" => null,
                    "HTTPS_METODO_MARCA" => null,
                    "HTTPS_METODO" => null
                ],
                "GET" => (array) [
                    "HTTPS_ARCHIVO" => null,
                    "HTTPS_METODO" => null,
                ],
            ];
        }
        static public function getInstance(){
            if(!(self::$ServicioApi instanceof self)){
                self::$ServicioApi = new servicioApi();
            }else{
                // call_user_func_array(array(self::$ServicioApi, "setnombre"), [$p1]);
            }
            return self::$ServicioApi;
        }
        public function token($Clase, $Metodos){
            $mardaAgua = (string) $_SERVER["REQUEST_TIME"];
            $Token = (array) ["Clase" => crypt($mardaAgua, $Clase), "Metodos" => crypt($mardaAgua, $Metodos)];
            $cadena = (array) [];
            $i = array_keys($Token);
            ciclo:
            if(count($i)){
                $opciones = [
                    'cost' => rand(9,13),
                ];
                $key = array_shift($i);
                $cadena[$key] = (array) ["Marca" =>$Token[$key], "Token" => password_hash($Token[$key], PASSWORD_BCRYPT , $opciones)];
                goto ciclo;
            }
            return $cadena;
        }
        public function setRespuesta($_DATA){
            $this->verificarToken($_DATA);
        }
        public function getRespuesta(){
            return $this->respuesta;
        }
        private function verificarToken($_DATA){
            if (password_verify($this->validarEncabezados[$_DATA]["HTTPS_CLASE_MARCA"], $this->validarEncabezados[$_DATA]["HTTPS_CLASE"]) && password_verify($this->validarEncabezados[$_DATA]["HTTPS_METODO_MARCA"], $this->validarEncabezados[$_DATA]["HTTPS_METODO"])) {
                include_once("Token/Service_token.php");
                $this->respuesta = serviceToken::getInstance($this->validarEncabezados[$_DATA]["HTTPS_CLASE"],$this->validarEncabezados[$_DATA]["HTTPS_METODO"]);
            } else {
                $this->respuesta = self::informacion["tokenApi"];
            }
        }
        public function setAcceso($_DATA){
            $this->validarEncabezados[$_DATA] = array_merge($this->validarEncabezados[$_DATA], $_REQUEST);
            if(!count(array_keys($this->validarEncabezados[$_DATA], null))){
                return $this->acceso($_DATA);
            }else{
                return self::informacion["headresApi"][0].join(",",array_keys($this->validarEncabezados[$_DATA], null)).self::informacion["headresApi"][1].$_DATA;
            }
        }
        private function acceso($_DATA){
            switch ($_DATA) {
                case 'POST':
                    call_user_func_array(array(servicioApi::getInstance(), "setRespuesta"), [$_DATA]);
                    return call_user_func_array(array(servicioApi::getInstance(), "getRespuesta"), [null]);
                break;
                case 'GET':
                    return call_user_func_array(array(servicioApi::getInstance(), "token"), [$_REQUEST["HTTPS_ARCHIVO"],  $_REQUEST["HTTPS_METODO"]]);
                    break;
            }
            
        }
        function __destruct() {
            $this->respuesta = null;
        }
    }
    print_r(servicioApi::getInstance()->setAcceso($_SERVER['REQUEST_METHOD']));

?>