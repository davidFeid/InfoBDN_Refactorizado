<?php
    if(count($lista) > 0){
        echo "<table>";
        echo "<tr>";
            echo "<th>DNI</th>";
            echo "<th>Nombre</th>";
            echo "<th>Nombre Curso</th>";
            echo "<th>Nota</th>";
        echo "</tr>";
        foreach($lista as $key => $value){
        echo "<tr>";
            echo "<td>$value->DNI_Alumno</td>";
            echo "<td>$value->Nombre_Alumno</td>";
            echo "<td>$value->Nombre_Curso</td>";
            echo "<td>$value->Nota</td>";
        echo "</tr>";
        }
        echo "</table>";    
    }else{
        echo "No hay alumnos inscritos";
    }


?>