<div class="Nuevo_registro">
    <a href="index.php?controller=Profesor&action=registrar" class="boton_nuevo">Nuevo Registro</a>
</div>
<div class="tabla">
    <table class="profesores">
        <tr><td colspan="9" class="titulo_profesores"><b>Cursos</b><td></tr>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Titulo Academico</th>
            <th>Foto</th>
            <th>Editar</th>
            <th>Desactivar</th>
            <th>Editar Foto</th>
        </tr>
    <?php 
        foreach($lista as $clave => $valor){
            echo "<tr>";
            unset($valor->contraseña);
            $activo = $valor->activo;
            unset($valor->activo);
            foreach($valor as $clave1 => $valor1){
                if($clave1 =='foto'){
                    echo "<td><img class='imagen_profe' src='".$valor1."' style='width:50px' /></td>";
                }else{
                echo "<td>".$valor1."</td>";
            }
            }
            echo "<td class='celda_imagen'><a href='index.php?controller=Profesor&action=editar&dni=".$valor->dni."'><img src='views/css/assets/imagenes/editarproducto.png' class='eliminar' style='width:50px'></a></td>";
            if($activo == 1){
                echo "<td class='celda_imagen'><a href='index.php?controller=Profesor&action=estado&dni=".$valor->dni."&estado=0'><img src='views/css/assets/imagenes/activado.png' class='eliminar' style='width:50px'></a></td>";
            }else{
                echo "<td class='celda_imagen'><a href='index.php?controller=Profesor&action=estado&dni=".$valor->dni."&estado=1'><img src='views/css/assets/imagenes/desactivado.png' class='eliminar' style='width:50px'></a></td>";
            }
            echo "<td class='celda_imagen'><a href='index.php?controller=Profesor&action=editarFoto&dni=".$valor->dni."'><img src='views/css/assets/imagenes/editarimagen.png' class='eliminar' style='width:50px'></a></td>";
            echo "</tr>";
        }
    ?>
    </table>
</div>