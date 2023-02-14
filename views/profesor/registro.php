<div class="Todo">
        <div class="form">
            <form action="index.php?controller=Profesor&action=registrar" method="POST" enctype="multipart/form-data">
                <label class="titulo_registro"><h2>Registro Profesor</h2></label>
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" required></input>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required></input>
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required></input>
                <label for="titulo_academico">Titulo Academico</label>
                <input type="text" id="titulo_academico" name="titulo_academico" required></input>
                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" required></input>
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required></input>
                <div><input type="Submit" value="Registrar" id="submit" class="submit_profesor" /></div>
        </div>
    </div>