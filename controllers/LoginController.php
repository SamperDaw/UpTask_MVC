<?php

namespace Controllers;

use MVC\Router;

class LoginController{

    public static function login(Router $router) {      
        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }


        //Render a la vista
        $router->render('auth/login', [
            'titulo'=>'Iniciar Sesion'
        ]);
    }

    public static function logout() {
        echo "Desde Login";

    }

    public static function crear(Router $router) {
        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }

        //render a la vista
        $router->render('auth/crear',[
            'titulo'=>'Crea tu cuenta en upTask'

        ]);
    }

    public static function recuperar(Router $router) {
        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
        //Muestra la vista
        $router->render('auth/recuperar',[
            'titulo'=>'Olvide mis Password'
        ]);
    }

    public static function reestablecer(Router $router) {
        if($_SERVER['REQUEST_METHOD']=== 'POST'){

        }
        //Muestra la vista
        $router->render('auth/reestablecer',[
            'titulo'=>'Restablecer Password'
        ]);
    }

    public static function mensaje() {
        echo "Desde Mensaje";

    }

    public static function confirmar() {
        echo "Desde Confirmar";

        
    }
}