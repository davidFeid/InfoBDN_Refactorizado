<?php

foreach($lista as $clave => $valor){
    echo "<div class='curso'>";
        echo "<div class='fotos_curso'>";
            echo "<a><img class='foto_curso' src='".$valor->foto."' /></a>";
        echo "</div>";
        echo "<div class='contenido'>";
            echo "<h1>".$valor->nombre."</h1>";
            echo "<h3>Fecha Finalizacion: ".$valor->fecha_final."</h3>";
            echo "<a class='boton_curso' href='index.php?controller=Profesor&action=evaluarCurso&curso=".$valor->codigo."'>Evaluar</a>";
        echo "</div>";
    echo "</div>";
}

?>