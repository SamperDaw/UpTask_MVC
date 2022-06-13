<div class="contenedor reestablecer">
    <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Introduzca tu nueva contraseña</p>


        <form class="formulario" action="/reestablecer" method="POST">           
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password"/>
            </div>
            <input type="submit" class="boton" value="Recuperar Contraseña">
        </form>

        <div class="acciones">
              <a href="/crear">Crear Cuenta</a>  
              <a href="/recuperar">Recuperar Contraseña</a>
        </div>
    </div><!--,contenedor-sm-->
</div>