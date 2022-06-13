<div class="contenedor recuperar">
  <?php include_once __DIR__ .'/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu Contraseña</p>


        <form class="formulario" action="/recuperar" method="POST">
       
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email"/>
            </div>

            <input type="submit" class="boton" value="Recuperar Contraseña">
        </form>

        <div class="acciones">
              <a href="/">¿Ya tienes cuenta? Iniciar Sesion.</a>  
              <a href="/recuperar"></a>
        </div>
    </div><!--,contenedor-sm-->
</div>