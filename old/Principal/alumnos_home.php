<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link href="estilos_alumnos.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['array_alumno'])){
        include('funciones_sql.php');
        include('../conexion.php');
        include('funciones_header.php');
        $con = conectar();
        header_alumno($_SESSION['array_alumno']['nombre'],$_SESSION['array_alumno']['foto'],$_SESSION['array_alumno']['dni']);
        $proximos_cursos = proximos_cursos($con,$_SESSION['array_alumno']['dni']);
    ?>
    <div class="banner">
        <div class="titulo">
            <h1>Cursos Informática</h1>
            <p class="banner">El futuro se escribe en código binario, ¿quieres ser parte de él? Desarrolla una carrera de éxito preparándote con cursos de Informática. Elige la especialidad que más encaje contigo. ¡Aprovecha las oportunidades que ofrece la revolución digital!</p>
        </div>
        <div class="imagen">
            <img src='../imagenes/banner_imagen.png' />
        </div>
    </div>
    <h1 class="cursos_empezar">Cursos Proximos a Empezar</h1>
    <div class="proximos_cursos">
        <?php 
            $lista = ['uno','dos','tres','cuatro'];
            foreach($proximos_cursos as $clave => $valor){
                echo "<div class='".$lista[$clave]."'>";
                    echo "<div class='foto'>";  
                        echo "<img src=".$valor['foto']." />";
                    echo "</div>";
                    echo "<div class='titulo'>";
                        echo "<h2>".$valor['nombre']."</h2>";
                        echo "<p>Fecha Inicio: ".cambiaf_a_espanol($valor['fecha inicio'])."<br>Fecha Final: ".cambiaf_a_espanol($valor['fecha final'])."</p>";
                    echo "</div>";
                    echo "<div class='botones'>";
                        echo "<a class='informate' href='alumnos_curso.php?codigo=".$valor['codigo']."'>Infórmate</a>";
                        echo "<a class='plaza' href='matricular.php?accion=1&curso=".$valor['codigo']."&dni=".$_SESSION['array_alumno']['dni']."'>Obtener Plaza</a>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
    <?php }else{
        include('funciones_sql.php');
        include('../conexion.php');
        include('funciones_header.php');
        $con = conectar();
        header_general();
        $proximos_cursos = proximos_cursos_general($con);
        ?>
        <div class="banner">
        <div class="titulo">
            <h1>Cursos Informática</h1>
            <p class="banner">El futuro se escribe en código binario, ¿quieres ser parte de él? Desarrolla una carrera de éxito preparándote con cursos de Informática. Elige la especialidad que más encaje contigo. ¡Aprovecha las oportunidades que ofrece la revolución digital!</p>
        </div>
        <div class="imagen">
            <img src='../imagenes/banner_imagen.png' />
        </div>
    </div>
    <h1 class="cursos_empezar">Cursos Proximos a Empezar</h1>
        <div class="proximos_cursos">
        <?php 
            $lista = ['uno','dos','tres','cuatro'];
            foreach($proximos_cursos as $clave => $valor){
                echo "<div class='".$lista[$clave]."'>";
                    echo "<div class='foto'>";  
                        echo "<img src=".$valor['foto']." />";
                    echo "</div>";
                    echo "<div class='titulo'>";
                        echo "<h2>".$valor['nombre']."</h2>";
                        echo "<p>Fecha Inicio: ".cambiaf_a_espanol($valor['fecha inicio'])."<br>Fecha Final: ".cambiaf_a_espanol($valor['fecha final'])."</p>";
                    echo "</div>";
                    echo "<div class='botones'>";
                        echo "<a class='informate' href='alumnos_curso.php'>Infórmate</a>";
                        echo "<a class='plaza' href='matricular.php'>Obtener Plaza</a>";
                    echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <?php
    } ?>
</body>
</html>
