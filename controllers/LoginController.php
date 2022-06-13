<?php

namespace Controllers;

class LoginController{
    public static function login() {
        echo "Desde Login";

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
    }

    public static function logout() {
        echo "Desde Login";

    }

    public static function crear() {
        echo "Desde Crear";

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
    }

    public static function recuperar() {
        echo "Desde Recuperar";

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
    }

    public static function restablecer() {
        echo "Desde Restablecer";

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
    }

    public static function mensaje() {
        echo "Desde Mensaje";

    }

    public static function confirmar() {
        echo "Desde Confirmar";

        
    }
}