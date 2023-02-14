<?php
echo "<header>";
    echo "<section style='display:flex; flex-direction:row;'>";
        echo "<div class='Logo'><a href='index.php?controller=Profesor&action=home'><img src='../logo/logo1.jpg' class='Logo'></a></div>";
        echo "<div class='titulo'>";
            echo "<div class='buscador'>";
                echo "<h1 class='bienvenido'>Bienvenido ".$_SESSION['Profesor']->nombre."</h1>";
            echo "</div>";
        echo "</div>";
        echo "<div class='inicio'><a href='index.php?controller=Profesor&action=home' class='inicio'>Inicio</a></div>";
        echo "<div class='Boton_evaluaciones_profe'><a href='index.php?controller=Profesor&action=evaluaciones' class='Boton_evaluaciones_profe'>Evaluaciones</a></div>";
        echo "<div class='Boton_cursos_activos'><a href='index.php?controller=Profesor&action=cursosactivos' class='Boton_cursos_activos'>Cursos Activos</a></div>";
        echo "<div class='imagen_usuario'>";
            echo "<img src='".$_SESSION['Profesor']->foto."' class='imagen_usuario' style='width:50px'>";
            echo "<a class='cerrar_sesion' href='index.php?controller=Base&action=salir'>Cerrar Sesion</a>";    
        echo "</div>";
    echo "</section>";
echo "</header>";

?>