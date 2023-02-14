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
        echo "<div class='tablas'>";
            tabla_activos(mis_cursos_activos($con,$_SESSION['array_alumno']['dni']));
            tabla_Proximos(mis_cursos_proximos($con,$_SESSION['array_alumno']['dni']));
            tabla_finalizados(mis_cursos_finalizados($con,$_SESSION['array_alumno']['dni']));
        echo "</div>";
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
