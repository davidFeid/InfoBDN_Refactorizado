<div class="Todo">
    <div class="form_profesor">
        <form action="index.php?controller=Profesor&action=editar" method="POST">
            <label class="titulo_registro"><h2>Editor Profesor DNI - <?php echo $_GET['dni']; ?></h2></label>
            <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>"></input>
            <label for="Nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $editarProfesor[0]->nombre ?>" required></input>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $editarProfesor[0]->apellido ?>" required></input>
            <label for="titulo_academico">Titulo Academico:</label>
            <input type="text" id="titulo_academico" name="titulo_academico" value="<?php echo $editarProfesor[0]->titulo_academico ?>" required></input>
            <div><input type="Submit" value="Editar" id="submit" class="submit" /></div>
    </div>
</div>