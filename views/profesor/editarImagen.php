<div class="header">
    <h1 class='tituloRegistroProducto'>Editar Imagen</h1>
        <form action="index.php?controller=Profesor&action=editarFoto" method="POST" enctype="multipart/form-data">
            <?php 
                echo "<label for='img'>Imagen Actual:</label>";
                echo "<img class='imagenEditarProducto' src='".$lista[0]->foto."'>";
            ?>
            <div style="float: right; width: 45%; text-align: justify;">
                
                <label for='imagen'>Nueva Imagen:</label>
                <div class="upload-btn-wrapper1">
                  <button class="btn1">Subir Imagen</button>
                  <input type="file" name="foto" />
                </div>
                <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>" >
            </div>
            <div class="buttonSubmitProducto">
                <input type="submit" value="Editar" class="rainbowButton" >
            </div>
        </form>
</div>