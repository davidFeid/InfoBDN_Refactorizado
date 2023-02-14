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
            $lista_cursos = cursos_disponibles($con,$_SESSION['array_alumno']['dni']);
            ?>
            <h1 class='nuestros_cursos'>Todos Nuestros Cursos</h1>
            <div class="todos_cursos">    
            <?php 
                foreach($lista_cursos as $clave => $valor){
                    echo "<div class='s".$clave."'>";
                        echo "<div class='foto'>";  
                            echo "<img src=".$valor['foto']." />";
                        echo "</div>";
                        echo "<div class='cuerpo'>";
                            echo "<div class='titulo'>";
                                echo "<h2>".$valor['nombre']."</h2>";
                                echo "<p>Fecha Inicio: ".cambiaf_a_espanol($valor['fecha inicio'])."<br>Fecha Final: ".cambiaf_a_espanol($valor['fecha final'])."</p>";
                            echo "</div>";
                            echo "<div class='botones'>";
                                echo "<a class='informate' href='alumnos_curso.php?codigo=".$valor['codigo']."'>Infórmate</a>";
                                echo "<a class='plaza' href='matricular.php?accion=1&curso=".$valor['codigo']."&dni=".$_SESSION['array_alumno']['dni']."'>Obtener Plaza</a>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
        <?php
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
