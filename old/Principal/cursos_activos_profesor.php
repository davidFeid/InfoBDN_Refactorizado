<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link href="estilos_profesores.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['array_profesor'])){
        include('funciones_sql.php');
        include('../conexion.php');
        include('funciones_header.php');
        $con = conectar();
        header_profesor($_SESSION['array_profesor']['nombre'],$_SESSION['array_profesor']['foto']);
        $profesor_cursos = profesor_cursos($con,$_SESSION['array_profesor']['dni']);
        echo "<div class='todos'>";
        if($profesor_cursos != false){
        foreach($profesor_cursos as $clave => $valor){
            echo "<div class='curso'>";
                echo "<div class='fotos_curso'>";
                    echo "<a><img class='foto_curso' src='".$valor['foto']."' /></a>";
                echo "</div>";
                echo "<div class='contenido'>";
                    echo "<h1>".$valor['nombre']."</h1>";
                    echo "<h3>Fecha Finalizacion: ".cambiaf_a_espanol($valor['fecha final'])."</h3>";
                    echo "<a class='boton_curso' href='profesor_curso.php?curso=".$valor['codigo']."'>Acceder</a>";
                echo "</div>";
            echo "</div>";
        }
    }else{
        echo "No hay cursos";
    }
        echo "</div>";
        /*echo "<table>";
                echo "<tr>";
                foreach($profesor_cursos[0] as $clave => $valor){
                    echo "<td>".$clave."</td>";
                }
                echo "<td>Acceder</td>";
                echo "</tr>";
                foreach($profesor_cursos as $clave => $valor){
                    echo "<tr>";
                    foreach($valor as $clave1 => $valor1){
                        //if($clave1 == 'foto'){
                            //echo "<td><img src='".$valor1."' /></td>";
                        //}else{
                            echo "<td>".$valor1."</td>";
                        //}
                    }
                    echo "<td><a href='profesor_curso.php?curso=".$valor['codigo']."'>Acceder</a></td>";
                    echo "</tr>";
                }
            echo "</table>";*/
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
