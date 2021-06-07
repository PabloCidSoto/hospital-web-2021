<main class="form-signin">  
  <form action="../login/login.php?action=save_pass" method="POST">    
    <h1 class="h3 mb-3 fw-normal">Nueva Contraseña</h1>
    <div class="form-floating">
      <input type="password" name="contrasena" class="form-control" id="floatingInput" placeholder="password">
      <label for="floatingInput">Nueva Contraseña</label>
    </div>
    <input type="hidden" name="correo" value="<?php echo $correo; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">      
    <input class="w-100 btn btn-lg btn-primary" type="submit" name="enviar" value="Reestablecer Contraseña">    
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>