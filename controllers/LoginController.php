<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;


class LoginController{

    public static function login(Router $router) {      
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //verificar usuario existe
                $usuario = Usuario::where('email',$usuario->email);

                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');

                }else{
                    //existe Usuario
                    if(password_verify($_POST['password'], $usuario->password)){
                      //iniciar la sesion
                      session_start();
                      $_SESSION['id']=$usuario->id;
                      $_SESSION['nombre']=$usuario->nombre;
                      $_SESSION['email']=$usuario->email;
                      $_SESSION['login']=true;
                     
                      //redireccionar
                      header('Location: /dashboard');
                    }else{
                        Usuario::setAlerta('error','Password incorrecto');
                    }

                }
              
            }
        }

        $alertas =  Usuario::getAlertas();
        //Render a la vista
        $router->render('auth/login', [
            'titulo'=>'Iniciar Sesion',
            'alertas'=>$alertas
        ]);
    }

    public static function logout() {
        echo "Desde logogut";

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
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();
            if(empty($alertas)){
                //buscar usuario
                $usuario = Usuario::where('email',$usuario->email);

                if($usuario && $usuario->confirmado){

                    //generar nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);
                    //Actualizar usuario
                    $usuario->guardar();
                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimi la laerta
                    Usuario::setAlerta('exito','Hemos enviado las instrucciones al correo');
                }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                    
                }             
            }
            
        }

        $alertas = Usuario::getAlertas();

        //Muestra la vista
        $router->render('auth/recuperar',[
            'titulo'=>'Olvide mis Password',
            'alertas'=>$alertas
        ]);
    }

    public static function reestablecer(Router $router) {
        $token = s($_GET['token']);
        $mostrar  = true;

        
        if(!$token) header('Location : /');
    
        //identificar usuario con el token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error','Token no valido');
            $mostrar=false;
        }

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            //añadir nuevo password
            $usuario->sincronizar($_POST);

            //Validar password
            $alertas = $usuario->validarPassword();
          
            if(empty($alertas)){
                //hasear el nuevo password
                $usuario->hashPassword();
                //Eliminar token
                $usuario->token = null;
                //guardar usuario
                $resultado = $usuario->guardar();
                //redireccion
                if($resultado){
                    header('Location: /');
                }
                
            }
            
        }
        $alertas=Usuario::getAlertas();
        //Muestra la vista
        $router->render('auth/reestablecer',[
            'titulo'=>'Restablecer Password',
            'alertas'=>$alertas,
            'mostrar'=> $mostrar
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