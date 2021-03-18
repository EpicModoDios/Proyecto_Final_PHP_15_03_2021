<?php

    interface Clases{
        const token_class = array(
            "Service_usuario" => '$2y$10$IZWalCdInZzIilt2dG0/3.B4enMRTHGH1vAZkw1ATlfNpbAhtAMpO'
        );
    }
    interface Metodos extends Clases{
        const token_metodos = array(
            "saludar" => '$2y$12$e/FuS0461cTjQ1DU9XqEmerkOWF0oziDrjQwE8U/9SBou86M9ka2m'
        );
    }
    interface Plantilla{
        const service = array(
            "usuarioSaludar" => array(
                '<div class="col-xl bg-primary">Miguel</div>',
                '<div class="col-xl bg-success">Angel</div>',
                '<div class="col-xl bg-danger">Castro</div>'
            )
        );
    }
    interface Mensajes{
        const informacion = array(
            "archivo" => "El token del archivo a solicitar no se encuentra en uso en este momento",
            "claseToken" => "El token enviado no coincide con ningun archivo",
            "metodoToken" => "El token enviado no coincide con ningun metodo a ejecutar",
            "tokenApi" => "La clase o el metodo no coincide",
            "headresApi" => array ("Los encabezados que te faltan son: ", " por el metodo "),
        );
    }

?>