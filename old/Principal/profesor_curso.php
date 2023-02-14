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
        if(isset($_GET['curso'])){
            include('funciones_sql.php');
            include('../conexion.php');
            include('funciones_header.php');
            $con = conectar();
            $lista_alumnos = alumnos_inscritos($con,$_GET['curso']);
            $fecha_final = obtener_fecha_curso($con,$_GET['curso']);
            if(isset($lista_alumnos)){
                header_profesor($_SESSION['array_profesor']['nombre'],$_SESSION['array_profesor']['foto']);
                if(!isset($fecha_final)){
                    echo "<table class='alumnos'>";
                    echo "<tr>";
                    foreach($lista_alumnos[0] as $clave => $valor){
                        echo "<th>".$clave."</th>";
                    }
                    echo "</tr>";
                    foreach($lista_alumnos as $clave => $valor){
                        echo "<tr>";
                        foreach($valor as $clave1 => $valor1){
                            echo "<td>".$valor1."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }else{
                    echo "<table class='alumnos'>";
                    echo "<tr>";
                    foreach($lista_alumnos[0] as $clave => $valor){
                        echo "<th>".$clave."</th>";
                    }
                    echo "<th>Editar nota</th>";
                    echo "</tr>";
                    foreach($lista_alumnos as $clave => $valor){
                        echo "<tr>";
                        foreach($valor as $clave1 => $valor1){
                            echo "<td>".$valor1."</td>";
                        }
                        echo "<td>";
                                echo "<form action='poner_nota.php' method='POST'>";
                                echo "<input type='number' id='nota' name='nota' min='1' max='10'>";
                                echo "<input type='hidden' id='alumno' name='alumno' value='".$valor['DNI Alumno']."'>";
                                echo "<input type='hidden' id='curso' name='curso' value='".$_GET['curso']."'>";
                                echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
            }else{
                echo "Curso SIN ALUMNOS";
                echo "<meta http-equiv=REFRESH content=1,URL=profesores_home.php>";
            }
    ?>
    
    <?php 
        }else{
            echo "No hay curso seleccionado";
            echo "<meta http-equiv=REFRESH content=1,URL=profesores_home.php>";
        }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
