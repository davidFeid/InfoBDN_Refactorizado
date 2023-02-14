<?php
session_start();
if(isset($_SESSION['array_profesor'])){
    if(isset($_POST)){
        include('../conexion.php');
        $con = conectar();
        $sql = "UPDATE matricula SET nota = ".$_POST['nota']." WHERE dni_alumno = '".$_POST['alumno']."' and curso = ".$_POST['curso']."";
        if($resultado = $con->query($sql)){
            echo "<meta http-equiv=REFRESH content=0,URL=profesor_curso.php?curso=".$_POST['curso'].">";
        }else{
            echo "NO FUNCIONA QUERY".$sql;
        }
    }
}else{
    echo "Debes Validarte...";
    echo "<meta http-equiv=REFRESH content=5,URL=alumnos_login.php>";
}
    
?>