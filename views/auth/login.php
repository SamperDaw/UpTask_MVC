<div class="contenedor login">
    <h1 class="uptask">UpTask</h1>
    <p class="tagline">Crea y Administras tus proyectos</p>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>


        <form class="formulario" action="/" method="POST">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email"/>
            </div>

            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password"/>
            </div>
            <input type="submit" class="boton" value="iniciar sesion">
        </form>

        <div class="acciones">
              <a href="/crear">Crear Cuenta</a>  
              <a href="/recuperar">Recuperar Contraseña</a>
        </div>
    </div><!--,contenedor-sm-->
</div>