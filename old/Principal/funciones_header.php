<?php 
    function header_alumno($nombre,$foto,$dni){
        echo "<header>";
            echo "<section>";
                echo "<div class='Logo'><a href='alumnos_home.php' class='inicio'><img src='../logo/logo1.jpg' class='Logo'></a></div>";
                echo "<div class='titulo'>";
                    echo "<div class='buscador'>";
                        echo "<h1 class='bienvenido'>Bienvenido $nombre</h1>";
                        echo "<form action='profesores_admin.php' method='POST'>";
                            echo "<input type='text' id='busqueda' name='busqueda' placeholder='Busqueda' autocomplete='off' class='busqueda'></input>";
                            echo "<!--<input type='submit' id='submit' value='Buscar' class='buscar'></input>-->";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='inicio'><a href='alumnos_home.php' class='inicio'>Inicio</a></div>";
                echo "<div class='boton_mis_cursos'><a href='mis_cursos.php' class='boton_mis_cursos'>Mis Cursos</a></div>";
                echo "<div class='alumnos_cursos'><a href='alumnos_cursos.php' class='alumnos_cursos'>Cursos</a></div>";
                echo "<div class='imagen_usuario'>";
                    echo "<ul class='nav'>";
                        echo "<li><img class='imagen_usuario' src='$foto' />";
                            echo "<ul class='adentro'>";
                                echo "<li><a href='editar_perfil.php?dni=$dni'>Editar Perfil</a></li>";
                                echo "<li><a href='cerrar_sesion.php'>Cerrar Sesion</a></li>";
                            echo "</ul>";
                        echo "</li>";
                    echo "</ul>"; 
                echo "</div>";
            echo "</section>";
        echo "</header>";
    }


    function header_profesor($nombre,$foto){
        echo "<header>";
            echo "<section>";
                echo "<div class='Logo'><a href='profesores_home.php'><img src='../logo/logo1.jpg' class='Logo'></a></div>";
                echo "<div class='titulo'>";
                    echo "<div class='buscador'>";
                        echo "<h1 class='bienvenido'>Bienvenido $nombre</h1>";
                        echo "<form action='profesores_admin.php' method='POST'>";
                            echo "<input type='text' id='busqueda' name='busqueda' placeholder='Busqueda' autocomplete='off' class='busqueda'></input>";
                            echo "<!--<input type='submit' id='submit' value='Buscar' class='buscar'></input>-->";
                        echo "</form>";
                    echo "</div>";
                echo "</div>";
                echo "<div class='inicio'><a href='profesores_home.php' class='inicio'>Inicio</a></div>";
                echo "<div class='Boton_evaluaciones_profe'><a href='evaluaciones_profe.php' class='Boton_evaluaciones_profe'>Evaluaciones</a></div>";
                echo "<div class='Boton_cursos_activos'><a href='cursos_activos_profesor.php' class='Boton_cursos_activos'>Cursos Activos</a></div>";
                echo "<div class='imagen_usuario'>";
                    echo "<img src='$foto' class='imagen_usuario'>";
                    echo "<a class='cerrar_sesion' href='cerrar_sesion.php'>Cerrar Sesion</a>";    
                echo "</div>";
            echo "</section>";
        echo "</header>";
    }

    function header_general(){
        echo "<header>";
            echo "<section>";
                echo "<div class='Logo'><a href='profesores_home.php'><img src='../logo/logo1.jpg' class='Logo'></a></div>";
                echo "<div class='titulo'>";
                    echo "<h1 class='bienvenido'>Bienvenidos</h1>";
                echo "</div>";
                echo "<div class='inicio'><a href='alumnos_login.php' class='inicio'>Iniciar Sesion</a></div>";
                echo "<div class='boton_mis_cursos'><a href='registro.php' class='boton_mis_cursos'>Registrarse</a></div>";
            echo "</section>";
        echo "</header>";
    }
?>