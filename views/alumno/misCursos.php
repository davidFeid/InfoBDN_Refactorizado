<?php

    echo "<p>Cursos Activos</p>";
    if(count($cursosActivos) == 0){
        echo "No hay cursos";
    }else{
        echo "<table class='cursos'>";
        echo "<tr>";
            echo "<th class='tabla_cursos'>ID</th>";
            echo "<th class='tabla_cursos'>Curso</th>";
            echo "<th class='tabla_cursos'>Fecha Final</th>";
            echo "<th class='tabla_cursos'>Ver Info</th>";
            echo "<th class='tabla_cursos'>Desinscribirte</th>";
        echo "</tr>";
        foreach($cursosActivos as $clave1 => $valor1){
            echo "<tr class='texto'>";
            foreach($valor1 as $clave2 => $valor2){
                    echo "<td class='tabla_cursos'>".$valor2."</td>";
            }
            echo "<td class='tabla_cursos'><a href='index.php?controller=Alumno&action=verCurso&curso=".$valor1->curso."'><img class='tabla_cursos' src='views\css\assets\imagenes\icono_ojo.png' style='width:35px' /></a></td>";
            echo "<td class='tabla_cursos'><a href='index.php?controller=Alumno&action=desmatricularse&curso=".$valor1->curso."'><img class='tabla_cursos' src='views\css\assets\imagenes\unsubscribe_icono.png' style='width:35px' /></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<br><br>";
    echo "<p>Proximos Cursos</p>";
    if(count($cursosProximos) == 0){
        echo "No hay cursos";
    }else{
        echo "<table class='cursos'>";
        echo "<tr class='texto'>";
            echo "<th class='tabla_cursos'>ID</th>";
            echo "<th class='tabla_cursos'>Curso</th>";
            echo "<th class='tabla_cursos'>Fecha Inicio</th>";
            echo "<th class='tabla_cursos'>Ver Info</th>";
            echo "<th class='tabla_cursos'>Desinscribirte</th>";
        echo "</tr>";
        foreach($cursosProximos as $clave1 => $valor1){
            echo "<tr class='texto'>";
            foreach($valor1 as $clave2 => $valor2){
                    echo "<td class='tabla_cursos'>".$valor2."</td>";
            }
            echo "<td class='tabla_cursos'><a href='index.php?controller=Alumno&action=verCurso&curso=".$valor1->curso."'><img class='tabla_cursos' src='views\css\assets\imagenes\icono_ojo.png' style='width:35px' /></a></td>";
            echo "<td class='tabla_cursos'><a href='index.php?controller=Alumno&action=desmatricularse&curso=".$valor1->curso."'><img class='tabla_cursos' src='views\css\assets\imagenes\unsubscribe_icono.png' style='width:35px' /></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<br><br>";
    echo "<p>Proximos Finalizados</p>";
    if(count($cursosFinalizados) == 0){
        echo "No hay cursos";
    }else{
        echo "<table class='cursos'>";
        echo "<tr>";
            echo "<th class='tabla_cursos'>ID</th>";
            echo "<th class='tabla_cursos'>Curso</th>";
            echo "<th class='tabla_cursos'>Nota</th>";
        echo "</tr>";
        foreach($cursosFinalizados as $clave1 => $valor1){
            echo "<tr class='texto'>";
            foreach($valor1 as $clave2 => $valor2){
                if($clave2 == "nota"){
                    if(isset($valor2)){
                        echo "<td class='tabla_cursos'>".$valor2."</td>";
                    }else{
                        echo "<td class='tabla_cursos'>-</td>";
                    }
                }else{
                    echo "<td class='tabla_cursos'>".$valor2."</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }

?>