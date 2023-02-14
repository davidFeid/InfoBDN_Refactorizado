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
        $proximos_cursos = proximos_cursos_profesor($con,$_SESSION['array_profesor']['dni']);
    ?>
    <div class="todo_home">
        <div class="home">
            <a class="home" href="evaluaciones_profe.php"><h1>Evaluaciones</h1></a>
            <a class="home" href="evaluaciones_profe.php"><img class='mis_cursos' src='../imagenes/mis_cursos_profesor.png' /></a>
        </div>
        <div class="home">
            <a class="home" href="cursos_activos_profesor.php"><h1>Mis Cursos Activos</h1></a>
            <a class="home" href="cursos_activos_profesor.php"><img class='cursos_activos' src='../imagenes/cursos_activos_profesor.png' /></a>
        </div>
    </div>
    <?php
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
