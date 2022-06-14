<div class="contenedor login">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>


        <form class="formulario" action="/" method="POST">
        <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email"/>
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password"/>
            </div>
            <input type="submit" class="boton" value="Iniciar Sesion">
        </form>

        <div class="acciones">
              <a href="/crear">Crear Cuenta</a>  
              <a href="/recuperar">Recuperar Contraseña</a>
        </div>
    </div><!--,contenedor-sm-->
</div>