<section>
    <div class="formulario">
        <!--<div class="form">-->
            <form action="index.php?controller=Alumno&action=registro" method="POST" enctype="multipart/form-data">
                <label class="titulo_registro"><h1>Registro Alumno</h1></label>
                <div class="grupo">    
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" autocomplete="off" required></input>
                </div>
                <div class="grupo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" autocomplete="off" required></input>
                </div>
                <div class="grupo">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" autocomplete="off" required></input>
                </div>
                <div class="grupo">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" autocomplete="off" required></input>
                </div>
                <div class="grupo">
                    <label for="mail">Mail</label>
                    <input type="email" id="mail" name="mail" autocomplete="off" required></input>
                </div>
                <div class="grupo_foto">
                    <label for="foto" class="label">Foto</label>
                    <input type="file" id="foto" name="foto" class="foto" autocomplete="off"  value="" required></input>
                </div>
                
                <div class="grupo">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" autocomplete="off" required></input>
                </div>
                <div class="grupo_boton">
                    <input type="Submit" value="Registrar" id="submit" class="submit_alumnos" />
                </div>
                <p>Ya estas registrado? <a href='alumnos_login.php' class='boton_registrarse'>Login Aqui!</a></p>
            </form>
        <!--</div>-->
    </div>
</section>