<div class="formulario">
        <form action="index.php?controller=Base&action=login" method="POST" enctype="multipart/form-data">
            <h1>Iniciar Sesión</h1>
            <div class="grupo">    
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" autocomplete="off" required></input>
            </div>
            <div class="grupo">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" autocomplete="off" required></input>
            </div>
            <div class="grupo_option">
                <label for="nada">Iniciar Sesion Como:</label>
                <input type="radio" id="alumno" name="opcion" value="alumno" required />
                <label for="alumno">Alumno</label>
                <input type="radio" id="profesor" name="opcion" value="profesor" />
                <label for="profesor">Profesor</label>
            </div>
            <div class="grupo_boton">
                <input type="Submit" value="Entrar" id="submit" class="submit_alumnos" />
            </div>
            <p>No estas registrado? <a href='index.php?controller=Alumno&action=registro' class='boron_registrarse'>Registrarse Aqui!</a></p><br>
            <p>Ingresar como Admin? <a href='index.php?controller=Admin&action=login' class='boton_admin'>Acceder Aqui!</a></p>
        </form>
    <!--</div>-->
</div>