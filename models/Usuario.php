<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB=['id', 'nombre', 'email', 'password', 'token',
    'confirmado'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validacion de creacion de cuentas
    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del usuario es obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El email del usuario es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'El password no puede ir vacio';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        }

        if($this->password !== $this->password2){
            self::$alertas['error'][] = 'Los passwords no coinciden';
        }

        return self::$alertas;
  }

  //validar el email
  public function validarEmail(){
    if(!$this->email){
        self::$alertas['error'][] = 'El email es olbigatorio';
    }
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        self::$alertas['error'][] = 'Email no valido';
    }

    return self::$alertas;
  }

  //Validapassword
  public function validarPassword(){
    if(!$this->password){
        self::$alertas['error'][] = 'El password no puede ir vacio';
    }

    if(strlen($this->password) < 6) {
        self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
        return self::$alertas;
    }
  }
  //hasea el password
  public function hashPassword(){
    $this->password = password_hash($this->password,PASSWORD_BCRYPT);
  }
  //Generar un token
  public function crearToken(){
    $this->token = md5(uniqid());
  }
}