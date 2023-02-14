<?php 
function lista_profesores($con){
    $sql = "SELECT dni,nombre FROM profesores WHERE `activo` = 1";
    if($resultado = $con->query($sql)){
        while($row = $resultado->fetch_assoc()){
            $lista[] = $row;
        }
    }
    return $lista;
}

function listado_profesores($con){
    $sql = "SELECT * FROM profesores";
    if($resultado = $con->query($sql)){
        while($row = $resultado->fetch_assoc()){
            $lista[] = $row;
        }
    }
    return $lista;
}

function listado_cursos($con){
    $sql = "SELECT * FROM cursos";
    if($resultado = $con->query($sql)){
        while($row = $resultado->fetch_assoc()){
            $lista[] = $row;
        }
    }
    return $lista;
}


function listado_curso_especifico($con,$codigo){
    $sql = "SELECT * FROM cursos WHERE codigo = '$codigo'";
    if($resultado = $con->query($sql)){
        while($row = $resultado->fetch_assoc()){
            $lista[] = $row;
        }
    }
    return $lista;
}

function listado_profesor_especifico($con,$dni){
    $sql = "SELECT * FROM profesores WHERE dni = '".$dni."'";
    if($resultado = $con->query($sql)){
        while($row = $resultado->fetch_assoc()){
            $lista[] = $row;
        }
    }
    return $lista;
}

function desactivar_curso_profe($con,$dni){
    $sql = "UPDATE cursos SET `activo` = 0 WHERE `profesor` = '$dni'";
    echo $sql;
    if($resultado = $con->query($sql)){
        echo "query realizada con exito";
    }else{
        echo "Tu Query No se ha realizado correctamente (desactivacion de curso)";
    }
}


?>