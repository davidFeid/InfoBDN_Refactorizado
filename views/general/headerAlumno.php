<?php
    echo "<header>";
    echo "<section>";
        echo "<div class='Logo'><a href='index.php?controller=Alumno&action=home' class='inicio'><img src='../logo/logo1.jpg' class='Logo'></a></div>";
        echo "<div class='titulo'>";
            echo "<div class='buscador'>";
                echo "<h1 class='bienvenido'>Bienvenido ".$_SESSION['Alumno']->nombre."</h1>";
            echo "</div>";
        echo "</div>";
        echo "<div class='inicio'><a href='index.php?controller=Alumno&action=home' class='inicio'>Inicio</a></div>";
        echo "<div class='boton_mis_cursos'><a href='index.php?controller=Alumno&action=misCursos' class='boton_mis_cursos'>Mis Cursos</a></div>";
        echo "<div class='alumnos_cursos'><a href='index.php?controller=Alumno&action=cursosDisponibles' class='alumnos_cursos'>Cursos</a></div>";
        echo "<div class='imagen_usuario'>";
            echo "<ul class='nav'>";
                echo "<li><img class='imagen_usuario' src='".$_SESSION['Alumno']->foto."' />";
                    echo "<ul class='adentro'>";
                        echo "<li><a href='index.php?controller=Base&action=salir'>Cerrar Sesion</a></li>";
                    echo "</ul>";
                echo "</li>";
            echo "</ul>"; 
        echo "</div>";
    echo "</section>";
    echo "</header>";
?>