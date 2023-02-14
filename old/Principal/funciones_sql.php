<?php

    //OBTENER LOS 4 CURSOS PROXIMOS POR EMPEZAR
    function proximos_cursos($con,$dni){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and codigo not in (SELECT curso FROM matricula WHERE dni_alumno = '".$dni."') and `fecha inicio` > curdate() ORDER BY `fecha inicio` ASC limit 0,4";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        return $lista;
    }

    /*OBTENER LOS 4 CURSOS PROXIMOS POR EMPEZAR GENERALES*/
    function proximos_cursos_general($con,){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1 and `fecha inicio` > curdate() ORDER BY `fecha inicio` ASC limit 0,4";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        return $lista;
    }

    /*LISTADO CURSOS QUE ESTAN DISPONIBLES PERO NO ESTA MATRICULADO EL ALUMNO*/
    function cursos_disponibles($con,$dni){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and codigo not in (SELECT curso FROM matricula WHERE dni_alumno = '".$dni."') and `fecha inicio` > curdate() ORDER BY `fecha inicio` ASC";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        return $lista;
    }
    

    //OBTENER EL ARRAY DEL CURSO ESPECIFICO
    function obtener_curso($con,$codigo){
        $sql = "SELECT * FROM `cursos` WHERE `codigo` = $codigo and `activo` = 1 and `cursos`.`fecha final` >= curdate()";
        if($resultado = $con->query($sql)){
            /*while(*/$row = $resultado->fetch_assoc()/*){*/;
                //$lista[] = $row;
            //}
        }
        return $row;
    }

    // COMPROBAR SI EL ALUMNO ESTA REGISTRADO EN EL CURSO
    function comprobar_matricula($con,$dni_alumno,$curso_codigo){
        $sql = "SELECT * FROM `matricula` INNER JOIN `cursos` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `dni_alumno` = '$dni_alumno' and `curso` = $curso_codigo";
        if($resultado = $con->query($sql)){
            /*while(*/$row = $resultado->fetch_assoc()/*){*/;
                //$lista[] = $row;
            //}
        }
        if(!isset($row)){
            return boton_inscripcion($con,$dni_alumno,$curso_codigo);
        }else{
            return FALSE;
        }
    }
    //COMPROBAR SI ALUMNO ESTA INSCRITO DE LO CONTRARIO DAR BOTON DE INSCRIPCION Y DESINSCRIPCION
    function comprobar_matricula1($con,$dni_alumno,$curso_codigo){
        $sql = "SELECT * FROM `matricula` INNER JOIN `cursos` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `dni_alumno` = '$dni_alumno' and `curso` = $curso_codigo";
        if($resultado = $con->query($sql)){
            /*while(*/$row = $resultado->fetch_assoc()/*){*/;
                //$lista[] = $row;
            //}
        }
        if(!isset($row)){
            return boton_inscripcion($con,$dni_alumno,$curso_codigo);
        }else{
            return boton_desinscripcion($con,$dni_alumno,$curso_codigo);
        }
    }

    //BOTON INSCRIPCION ALUMNO*/
    function boton_inscripcion($con,$dni_alumno,$curso_codigo){
        $sql = "SELECT * from `cursos` WHERE codigo = $curso_codigo and `fecha inicio` >= curdate()";
        if($resultado = $con->query($sql)){
            return "<a class='inscripcion' href='matricular.php?accion=1&curso=".$curso_codigo."&dni=".$dni_alumno."'>Obtener Plaza</a>";
        }
    }

    //BOTON DESINSCRIPCION ALUMNO
    function boton_desinscripcion($con,$dni_alumno,$curso_codigo){
        $sql = "SELECT * from `cursos` WHERE codigo = $curso_codigo and `fecha final` > curdate()";
        if($resultado = $con->query($sql)){
            return "<a class='desinscripcion' href='matricular.php?accion=0&curso=".$curso_codigo."&dni=".$dni_alumno."'>Dejar Plaza</a>";
        }
    }




    /*OBTENER TODOS LOS CURSOS ACTIVOS QUE ESTA INSCRITO UN ALUMNO ESPECIFICO*/
    function mis_cursos_activos($con,$dni){
        $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `cursos`.`fecha final` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$dni."' and `cursos`.`activo` = 1 and `cursos`.`fecha inicio` <= curdate() and `cursos`.`fecha final` >= curdate()";
        // $sql = "SELECT dni_alumno,curso,nota FROM `matricula` WHERE `activo` = 1 and `dni_alumno` = '$dni'";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        if(isset($row)){
            return $row;
        }else if(isset($lista)){
            return $lista;
        }else{
            return "NO HAY CURSOS";
        }
    }

    /*OBTENER TODOS LOS CURSOS PROXIMOS QUE ESTA INSCRITO UN ALUMNO ESPECIFICO*/
    function mis_cursos_proximos($con,$dni){
        $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `cursos`.`fecha inicio` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$dni."' and `cursos`.`activo` = 1 and `cursos`.`fecha inicio` >= curdate() ";
        // $sql = "SELECT dni_alumno,curso,nota FROM `matricula` WHERE `activo` = 1 and `dni_alumno` = '$dni'";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        if(isset($row)){
            return $row;
        }else if(isset($lista)){
            return $lista;
        }else{
            return "NO HAY CURSOS";
        }
    }

    /*OBTENER TODOS LOS CURSOS ACTIVOS QUE ESTA INSCRITO UN ALUMNO ESPECIFICO*/
    function mis_cursos_finalizados($con,$dni){
        $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `matricula`.`nota` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$dni."' and `cursos`.`activo` = 1 and `cursos`.`fecha final` <= curdate() ";
        // $sql = "SELECT dni_alumno,curso,nota FROM `matricula` WHERE `activo` = 1 and `dni_alumno` = '$dni'";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                $lista[] = $row;
            }
        }
        if(isset($row)){
            return $row;
        }else if(isset($lista)){
            return $lista;
        }else{
            return "NO HAY CURSOS";
        }
    }

    /*PROXIMOS CURSOS DE UN PROFESOR*/
    function proximos_cursos_profesor($con,$dni){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and `profesor` = '$dni' and `fecha inicio` >= curdate() ORDER BY `fecha inicio` ASC limit 0,4";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                unset($row['profesor']);
                unset($row['activo']);
                $lista[] = $row;
            }
        }
        if(isset($lista)){
            return $lista;
        }else{
            return false;
        }
        
    }

    /*LISTADO TODOS LOS CURSOS ACTIVOS DEL PROFESOR*/
    function profesor_cursos($con,$dni){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and `profesor` = '$dni' and `fecha inicio` <= curdate() and `fecha final` > curdate() ORDER BY `fecha inicio`";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                unset($row['profesor']);
                unset($row['activo']);
                $lista[] = $row;
            }
        }
        if(isset($lista)){
            return $lista;
        }else if(isset($row)){
            return $row;
        }else{
            return false;
        }
        
    }

    /*Listado de cursos finalizados del profesor*/
    function profesor_cursos_finalizados($con,$dni){
        $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and `profesor` = '$dni' and `fecha final` < curdate() ORDER BY `fecha inicio`";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                unset($row['profesor']);
                unset($row['activo']);
                $lista[] = $row;
            }
        }
        if(isset($lista)){
            return $lista;
        }else{
            return false;
        }
    }


    /*LISTADO ALUMNOS INSCRITOS EN UN CURSOS */
    function alumnos_inscritos($con,$curso){
        $sql = "SELECT alumnos.dni AS 'DNI Alumno', alumnos.nombre AS 'Nombre Alumno', cursos.nombre AS 'Nombre Curso',matricula.nota AS 'Nota' FROM (alumnos INNER JOIN matricula ON alumnos.dni = matricula.dni_alumno) INNER JOIN cursos ON matricula.curso = cursos.codigo WHERE matricula.curso = '$curso'";
        if($resultado = $con->query($sql)){
            while($row = $resultado->fetch_assoc()){
                unset($row['activo']);
                $lista[] = $row;
            }
        }
        if(isset($lista)){
            return $lista;
        }else{
            return $row;
        }
    }

    /*OBTENER FECHA FINAL CURSO CON CODIGO */
    function obtener_fecha_curso($con,$curso){
        $sql = "SELECT * FROM `cursos` WHERE `codigo` = $curso and `fecha final` < curdate()";
        if($resultado = $con->query($sql)){
            $row = $resultado->fetch_assoc();
        }
        return $row;
    }

    /*TABLA DE CURSOS ACTIVOS DEL ALUMNOS ACTUAL*/
    function tabla_activos($array){
        echo "<div class='titulo_tabla'><h1>Cursos Activos</h1></div>";
        if($array == 'NO HAY CURSOS'){
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
            foreach($array as $clave1 => $valor1){
                echo "<tr class='texto'>";
                foreach($valor1 as $clave2 => $valor2){
                    if(!($clave2 == "fecha final")){
                        echo "<td class='tabla_cursos'>".$valor2."</td>";
                    }else{
                        echo "<td class='tabla_cursos'>".cambiaf_a_espanol($valor2)."</td>";
                    }
                }
                echo "<td class='tabla_cursos'><a href='alumnos_curso.php?codigo=".$valor1['curso']."'><img class='tabla_cursos' src='../imagenes/icono_ojo.png' /></a></td>";
                echo "<td class='tabla_cursos'><a href='matricular.php?accion=0&curso=".$valor1['curso']."&dni=".$_SESSION['array_alumno']['dni']."'><img class='tabla_cursos' src='../imagenes/unsubscribe_icono.png' /></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    
    /*TABLA PROXIMOS CURSOS DEL ALUMNOS INSCRITO */
    function tabla_Proximos($array){
        echo "<div class='titulo_tabla'><h1>Proximos Cursos</h1></div>";
        if($array == 'NO HAY CURSOS'){
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
            foreach($array as $clave1 => $valor1){
                echo "<tr class='texto'>";
                foreach($valor1 as $clave2 => $valor2){
                    if(!($clave2 == "fecha inicio")){
                        echo "<td class='tabla_cursos'>".$valor2."</td>";
                    }else{
                        echo "<td class='tabla_cursos'>".cambiaf_a_espanol($valor2)."</td>";
                    }
                }
                echo "<td class='tabla_cursos'><a href='alumnos_curso.php?codigo=".$valor1['curso']."'><img class='tabla_cursos' src='../imagenes/icono_ojo.png' /></a></td>";
                echo "<td class='tabla_cursos'><a href='matricular.php?accion=0&curso=".$valor1['curso']."&dni=".$_SESSION['array_alumno']['dni']."'><img class='tabla_cursos' src='../imagenes/unsubscribe_icono.png' /></a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    /*TABLA DE CURSOS FINALIZADOS DEL ALUMNOS INSCRITO*/
    function tabla_finalizados($array){
        echo "<div class='titulo_tabla'><h1>Cursos Finalizados</h1></div>";
        if($array == 'NO HAY CURSOS'){
            echo "No hay cursos";
        }else{
            echo "<table class='cursos'>";
            echo "<tr>";
                echo "<th class='tabla_cursos'>ID</th>";
                echo "<th class='tabla_cursos'>Curso</th>";
                echo "<th class='tabla_cursos'>Nota</th>";
            echo "</tr>";
            foreach($array as $clave1 => $valor1){
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
    }

    /*PASAR FECHA DE SQL A ESPAÑOL */
    function cambiaf_a_espanol($fecha){
        preg_match( '/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/', $fecha, $mifecha);
        $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
        return $lafecha;
    }

    /*OBTENER INFORMACION DE UN PROFESOR DEL CURSO*/
    function profesor_curso($con,$curso){
        $sql = "SELECT `profesores`.`foto`, `profesores`.`nombre`, `profesores`.`apellido` FROM `profesores` INNER JOIN `cursos` ON `profesores`.`dni` = `cursos`.`profesor` WHERE `cursos`.`codigo` = $curso";
        if($resultado = $con->query($sql)){
            $row = $resultado->fetch_assoc();
        }
        return $row;
    }

    /*OBTENER ARRAY DE UN ALUMNO PARA EDITAR SU PERFIL */
    function array_alumno($con,$dni){
        $sql = "SELECT * FROM alumnos WHERE dni = '".$dni."'";
        if($resultado = $con->query($sql)){
            $row = $resultado->fetch_assoc();
        }
        return $row;
    }
?>