<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;


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
        $alertas =[];
        $usuario = new Usuario;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuenta();
            

            if(empty($alertas)){
                $existeusuario = Usuario::where('email', $usuario->email);
                
                if($existeusuario){
                    Usuario::setAlerta('error','El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashear el password
                    $usuario->hashPassword();
                
                    //Eliminar password2
                    unset($usuario->password2);

                    //Generar token
                    $usuario->crearToken();

                    //Crear un nuevo usuario
                   $resultado = $usuario->guardar();

                   //enviar email
                   $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                   $email->enviarConfirmacion();
                   
                 
                   if($resultado){
                    header('Location: /mensaje');
                   }

                }
            }
        }

        //render a la vista
        $router->render('auth/crear',[
            'titulo'=>'Crea tu cuenta en upTask',
            'usuario'=>$usuario,
            'alertas'=>$alertas
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

    public static function mensaje(Router $router) {
        
        $router->render('auth/mensaje',[
            'titulo'=>'Cuenta Creada Satisfactoriamente'
        ]);

    }

    public static function confirmar(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        //Encontrar al usuario con el token
        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)){
            //No se encontro el usaurio
            Usuario::setAlerta('error', 'Token no valido'); 
        }else{
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($password2);
            
            //guardar en la BD
            $usuario->guardar();
            
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente'); 

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar',[
            'titulo'=>'Confirma tu cuenta',
            'alertas'=>$alertas

        ]);
        
    }
}