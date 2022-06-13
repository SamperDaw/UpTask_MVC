<div class="contenedor crear">
  <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

        <?php include_once __DIR__ .'/../templates/alertas.php';?>

        <form class="formulario" action="/crear" method="POST">

        <div class="campo">
                <label for="text">Nombre</label>
                <input  type="nombre" 
                        id="nombre" 
                        placeholder="Tu Nombre" 
                        name="nombre"
                        value="<?php echo $usuario->nombre; ?>"
                        />
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input  type="email" 
                        id="email"
                        placeholder="Tu Email"
                        name="email"
                        value="<?php echo $usuario->email; ?>"
                        />
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input  type="password"
                        id="password" 
                        placeholder="Tu password" 
                        name="password"                       
                        />
            </div>

            <div class="campo">
                <label for="password2">Repita su password</label>
                <input  type="password" 
                        id="password2" 
                        placeholder="Repite tu password"
                        name="password2"
                        />
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="acciones">
              <a href="/">¿Ya tienes cuenta? Iniciar Sesion.</a>  
              <a href="/recuperar">Recuperar Contraseña</a>
        </div>
    </div><!--,contenedor-sm-->
</div>