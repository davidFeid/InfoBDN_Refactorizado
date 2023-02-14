
<?php

var_dump($editarCurso[0]->profesor);
echo "<br><br>";
var_dump($listadoProfesores);
?>

<div class="Todo">
    <div class="form">
        <form action="index.php?controller=Curso&action=editar" method="POST" >
            <label class="titulo_registro"><h2>Editor Curso ID - <?php echo $_GET['codigo']; ?></h2></label>
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $editarCurso[0]->codigo ?>" required></input>
            <label for="Nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $editarCurso[0]->nombre ?>" required></input>
            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50" required><?php echo $editarCurso[0]->descripcion ?></textarea>
            <label for="horas">Horas:</label>
            <input type="number" id="horas" name="horas" min="0" value="<?php echo $editarCurso[0]->horas ?>" required></input>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $editarCurso[0]->fecha_inicio ?>" required></input>
            <label for="fecha_final">Fecha Final:</label>
            <input type="date" id="fecha_final" name="fecha_final" value="<?php echo $editarCurso[0]->fecha_final ?>" required></input>
            <label for="profesor">Profesor</label>
            <select name="profesor" id="profesor" required>
            <?php 
                foreach($listadoProfesores as $clave => $valor){
                    if($valor->dni == $editarCurso[0]->profesor){
                        echo "<option value=".$valor->dni." selected >".$valor->nombre." - ".$valor->dni."</option>";
                    }else{
                        echo "<option value=".$valor->dni.">".$valor->nombre." - ".$valor->dni."</option>";
                    }
                };
            ?>
            </select>
            <div><input type="Submit" value="Editar" id="submit" class="submit" /></div>
    </div>
</div>