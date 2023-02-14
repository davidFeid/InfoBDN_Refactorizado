<div class="Todo">
    <div class="form">
        <form action="index.php?controller=Curso&action=registrar" class="formCursos" method="POST" enctype="multipart/form-data">
            <label class="titulo_registro"><h2>Registro Cursos</h2></label>
            <label for="Nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required></input>
            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea>
            <label for="horas">Horas:</label>
            <input type="number" id="horas" name="horas" min="0" required></input>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required></input>
            <label for="fecha_final">Fecha Final:</label>
            <input type="date" id="fecha_final" name="fecha_final" required></input>
            <label for="foto">Foto (1920 x 700 aprox)</label>
            <input type="file" id="foto" name="foto" required></input>
            <label for="profesor">Profesor</label>
            <select name="profesor" id="profesor" required>
                <?php
                    foreach ($listadoProfesores as $key => $value) {
                        echo "<option value='".$value->dni."'>".$value->nombre."</option>";
                    }
                ?>
            </select>
            <input type="Submit" value="Registrar" id="submit" class="submit_cursos" />
    </div>
</div>