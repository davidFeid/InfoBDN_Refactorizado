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
        if(isset($_GET['accion']) && isset($_GET['curso']) && isset($_GET['dni'])){
            include('funciones_sql.php');
            include('../conexion.php');
            include('funciones_header.php');
            $con = conectar();
            if($_GET['accion'] == 1){
                $sql = "SELECT * FROM `cursos` WHERE codigo = ".$_GET['curso']." and activo = 1 and `cursos`.`fecha inicio` >= curdate(); ";
                if($resultado = $con->query($sql)){
                    $row = $resultado->fetch_assoc();
                    if(isset($row)){
                        $sql1 = "INSERT INTO matricula (dni_alumno,curso) VALUES ('".$_GET['dni']."',".$_GET['curso'].")";
                        if($resultado1 = $con->query($sql1)){
                            echo "<meta http-equiv=REFRESH content=0,URL=alumnos_curso.php?codigo=".$_GET['curso'].">";
                        }else{
                            echo "Query no funciona".$sql1;
                        }
                    }else{
                        echo "Curso Finalizado o inactivo";
                        echo "<meta http-equiv=REFRESH content=2,URL=alumnos_home.php>";
                    }
                }else{
                    echo "Query no funciona".$sql;
                }  
            }else if($_GET['accion'] == 0){
                $sql = "SELECT * FROM `cursos` WHERE codigo = ".$_GET['curso']." and activo = 1 and `cursos`.`fecha final` >= curdate(); ";
                if($resultado = $con->query($sql)){
                    $row = $resultado->fetch_assoc();
                    if(isset($row)){
                        $sql1 = "DELETE FROM `matricula` WHERE `matricula`.`dni_alumno` = '".$_GET['dni']."' AND `matricula`.`curso` = ".$_GET['curso']."";
                        if($resultado1 = $con->query($sql1)){
                            echo "<meta http-equiv=REFRESH content=0,URL=alumnos_curso.php?codigo=".$_GET['curso'].">";
                        }else{
                            echo "Query no funciona".$sql1;
                        }
                    }else{
                        echo "Curso Finalizado o inactivo";
                        echo "<meta http-equiv=REFRESH content=2,URL=alumnos_home.php>";
                    }
                }else{
                    echo "Query no funciona".$sql;
                }
                
            }
            
    ?>
    
    <?php 
        }else{
            echo "No hay los suficientes datos";
            echo "<meta http-equiv=REFRESH content=1,URL=alumnos_home.php>";
        }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
