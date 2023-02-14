<?php
    
    if(count($lista) > 0){
        echo "<table>";
        echo "<tr>";
            echo "<th>DNI</th>";
            echo "<th>Nombre</th>";
            echo "<th>Nombre Curso</th>";
            echo "<th>Nota</th>";
            echo "<th>Editar Nota</th>";
        echo "</tr>";
        foreach($lista as $key => $value){
            echo "<tr>";
                echo "<td>$value->DNI_Alumno</td>";
                echo "<td>$value->Nombre_Alumno</td>";
                echo "<td>$value->Nombre_Curso</td>";
                echo "<td>$value->Nota</td>";
                echo "<td>";
                        echo "<form action='index.php?controller=Matricula&action=ponerNota' method='POST'>";
                        echo "<input type='number' id='nota' name='nota' min='1' max='10' required>";
                        echo "<input type='hidden' id='alumno' name='alumno' value='".$value->DNI_Alumno."'>";
                        echo "<input type='hidden' id='curso' name='curso' value='".$_GET['curso']."'>";
                        echo "</form>";
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "No hay alumnos inscritos";
    }
    
?>