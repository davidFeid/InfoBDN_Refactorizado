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
        if(isset($_GET['codigo'])){
            include('funciones_sql.php');
            include('../conexion.php');
            include('funciones_header.php');
            $con = conectar();
            $lista_curso = obtener_curso($con,$_GET['codigo']);
            if(isset($lista_curso)){
            header_alumno($_SESSION['array_alumno']['nombre'],$_SESSION['array_alumno']['foto'],$_SESSION['array_alumno']['dni']);
            echo "<div class='banner_cursos'>";
                echo "<img src='".$lista_curso['foto']."' />";
                echo "<div class='centrado'>";
                    echo "<h3>Curso</h3>";
                    echo "<h1>".$lista_curso['nombre']."</h1>";
                    echo "<h4>Apuesta por el Futuro... Apuesta por INFOBDN!</h4>";
                    echo "<div class='boton_banner'>".comprobar_matricula($con,$_SESSION['array_alumno']['dni'],$lista_curso['codigo'])."</div>";
                echo "</div>";
            echo "</div>";
            echo "<div class='Info'>";
                echo "<div class='descripcion'>";
                    echo "<h1>Descripción</h1>";
                    echo "<p>".$lista_curso['descripcion']."</p>";
                echo "</div>";
                echo "<div class='boton'>";
                    echo comprobar_matricula1($con,$_SESSION['array_alumno']['dni'],$lista_curso['codigo']);
                echo "</div>";
            echo "</div>";
            echo "<div class='cuadrados'>";
                echo "<div>";
                    echo "<div class='fechas'>";
                        echo "<img src='../imagenes/fecha_icono.png' />";
                        echo "<p>Fecha Inicio: ".$lista_curso['fecha inicio']."</p>";
                        echo "<p>Fecha Final: ".$lista_curso['fecha final']."</p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='profesor'>";
                        $profesor = profesor_curso($con,$lista_curso['codigo']);
                        echo "<img class='profesor_foto' src='".$profesor['foto']."' />";
                        echo "<p><b>Profesor/a:</b></p>";
                        echo "<p><b>".$profesor['nombre']." ".$profesor['apellido']."</b></p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='formacion'>";
                        echo "<img class='formacion_online' src='../imagenes/icono_online.png' />";
                        echo "<p>Formacion Virtual tutorizada por expertos</p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='duracion'>";
                        echo "<img class='duracion_icono' src='../imagenes/icono_relog.png' />";
                        echo "<p>El curso se realizara en ".$lista_curso['horas']." Horas</p>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }else{
                echo "Curso esta Desactivado";
                echo "<meta http-equiv=REFRESH content=1,URL=alumnos_home.php>";
            }
    ?>
    
    <?php 
        }else{
            echo "No hay curso seleccionado";
            echo "<meta http-equiv=REFRESH content=1,URL=alumnos_home.php>";
        }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
