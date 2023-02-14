<?php
    if(count($lista) > 0){
        ?>
            <div class="todo">
                <div class="Nuevo_registro">
                    <a href="index.php?controller=Curso&action=registrar" class="boton_nuevo">Nuevo Curso</a>
                </div>
                <table class="cursos">
                    <tr><td colspan="10" class="titulo_cursos"><b>Cursos</b><td></tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Horas</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Foto</th>
                        <th>Profesor</th>
                        <th>Editar</th>
                        <th>Desactivar</th>
                        <th>Editar Foto</th>
                    </tr>
                <?php 
                    foreach($lista as $clave => $valor){
                        echo "<tr>";
                        unset($valor->descripcion);
                        $activo = $valor->activo;
                        unset($valor->activo);    
                        foreach($valor as $clave1 => $valor1){
                            if($clave1 == 'foto'){
                                echo "<td><img src=".$valor1." /></td>";
                            }else{
                                echo "<td>".$valor1."</td>";
                            }
                        }
                        echo "<td class='celda_imagen'><a href='index.php?controller=Curso&action=editar&codigo=".$valor->codigo."'><img src='views/css/assets/imagenes/editarproducto.png' class='eliminar' style='width:50px'></a></td>";
                        if($activo == 1){
                            echo "<td class='celda_imagen'><a href='index.php?controller=Curso&action=estado&codigo=".$valor->codigo."&estado=0'><img src='views/css/assets/imagenes/activado.png' class='eliminar' style='width:50px'></a></td>";
                        }else{
                            echo "<td class='celda_imagen'><a href='index.php?controller=Curso&action=estado&codigo=".$valor->codigo."&estado=1'><img src='views/css/assets/imagenes/desactivado.png' class='eliminar' style='width:50px'></a></td>";
                        }
                        echo "<td class='celda_imagen'><a href='index.php?controller=Curso&action=editarFoto&codigo=".$valor->codigo."'><img src='views/css/assets/imagenes/editarimagen.png' class='eliminar' style='width:50px'></a></td>";
                        echo "</tr>";
                    }
                ?>
                </table>
            </div>
        <?php
    }else{
        echo "No hay cursos";
    }
?>
