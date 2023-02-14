<div class="header">
<!--Contenido antes de las olas-->
    <div class="inner-header flex">
         <div class="fromGenerico">
            <!-- Creamos el formulario donde su action será pasar los datos al model/loginAdmin y su función validar -->
            <form action="index.php?controller=Admin&action=validar" method="POST">
                    
                <label for="nombre">Usuario:</label>
                <input type="text"  placeholder="Usuario" name="nombre" id="nombre" autofocus>

                <label for="password">Contraseña:</label>
                <input type="password" placeholder="Password" name="password" id="password">
                
                <div class="buttonSubmit">
                    <input type="submit" value="Iniciar sesión" class="rainbowButton" >
                </div>

                <a href= 'index.php?controller=Base&action=login' class='enlaceMenuAdmin'>Cliente Login</a>

            </form>
        </div>
    </div>