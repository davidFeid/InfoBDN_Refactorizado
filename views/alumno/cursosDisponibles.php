<h1 class='nuestros_cursos'>Todos Nuestros Cursos</h1>
<div class="todos_cursos">    
<?php 
    foreach($lista as $clave => $valor){
        echo "<div class='s".$clave."'>";
            echo "<div class='foto'>";  
                echo "<img src=".$valor->foto." />";
            echo "</div>";
            echo "<div class='cuerpo'>";
                echo "<div class='titulo'>";
                    echo "<h2>".$valor->nombre."</h2>";
                    echo "<p>Fecha Inicio: ".$valor->fecha_inicio."<br>Fecha Final: ".$valor->fecha_final."</p>";
                echo "</div>";
                echo "<div class='botones'>";
                    echo "<a class='informate' href='index.php?controller=Alumno&action=verCurso&curso=".$valor->codigo."'>Infórmate</a> ";
                    echo "<a class='plaza' href='index.php?controller=Alumno&action=Matricularse&curso=".$valor->codigo."'>Obtener Plaza</a>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
?>
</div>