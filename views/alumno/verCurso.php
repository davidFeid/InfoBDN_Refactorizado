<?php

    echo "<div class='banner_cursos'>";
                echo "<img src='".$lista[0]->foto."' />";
                echo "<div class='centrado'>";
                    echo "<h3>Curso</h3>";
                    echo "<h1>".$lista[0]->nombre."</h1>";
                    echo "<h4>Apuesta por el Futuro... Apuesta por INFOBDN!</h4>";
                    if($comprobarMatricula){
                        echo "<a href='index.php?controller=Alumno&action=desmatricularse&curso=".$lista[0]->codigo."'>Desmatriculate</a>";
                    }else{
                        echo "<a href='index.php?controller=Alumno&action=Matricularse&curso=".$lista[0]->codigo."'>Matriculate</a>";
                    }
                echo "</div>";
            echo "</div>";
            echo "<div class='Info'>";
                echo "<div class='descripcion'>";
                    echo "<h1>Descripción</h1>";
                    echo "<p>".$lista[0]->descripcion."</p>";
                echo "</div>";
                echo "<div class='boton'>";
                    if($comprobarMatricula){
                        echo "<a href='index.php?controller=Alumno&action=desmatricularse&curso=".$lista[0]->codigo."'>Desmatriculate</a>";
                    }else{
                        echo "<a href='index.php?controller=Alumno&action=Matricularse&curso=".$lista[0]->codigo."'>Matriculate</a>";
                    }
                echo "</div>";
            echo "</div>";
            echo "<div class='cuadrados'>";
                echo "<div>";
                    echo "<div class='fechas'>";
                        echo "<img src='../imagenes/fecha_icono.png' />";
                        echo "<p>Fecha Inicio: ".$lista[0]->fecha_inicio."</p>";
                        echo "<p>Fecha Final: ".$lista[0]->fecha_final."</p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='infoProfesor[0]'>";
                        echo "<img class='infoProfesor[0]_foto' src='".$infoProfesor[0]->foto."' />";
                        echo "<p><b>Profesor/a:</b></p>";
                        echo "<p><b>".$infoProfesor[0]->nombre." ".$infoProfesor[0]->apellido."</b></p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='formacion'>";
                        echo "<img class='formacion_online' src='../imagenes/icono_online.png' />";
                        echo "<p>Formacion Virtual tutorizada por expertos</p>";
                    echo "</div>";
                echo "</div>";
                echo "<div>";
                    echo "<div class='duracion'>";
                        echo "<img class='duracion_icono' src='../imagenes/icono_relog.png' />";
                        echo "<p>El curso se realizara en ".$lista[0]->horas." Horas</p>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";

?>