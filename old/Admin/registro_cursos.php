<?php 
 session_start();
?>
<head>
    <link href="estilo_admin.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../logo/logo1.png">
    <title>Home Admin</title>
</head>
<body>
    <?php
    if(isset($_SESSION['admin'])){
        include('funciones.php');
        include('../conexion.php');
        $con = conectar();
        if(isset($_POST['nombre'])){
            //Calculamo el codigo que tendra el cursa para podere guardar la imagen con este codigo
            $sql = "SELECT `codigo` FROM `cursos` ORDER BY `codigo` DESC limit 0,1";
            if($resultado = $con->query($sql)){
                while($row = $resultado->fetch_assoc()){
                    $lista[] = $row;
                }
            }
            $codigo = $lista[0]['codigo']+1;
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['foto']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['foto']['type'];
            $tamano = $_FILES['foto']['size'];
            $temp = $_FILES['foto']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                - Se permiten archivos .jpg, .png. y de 200 kb como máximo.</b><br>Por favor Vuelva a registrarse</div>';
                echo "<meta http-equiv=REFRESH content=2,URL=registro_cursos.php>";
            }else{
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, "../fotos_cursos/foto_".$codigo.".jpg")) {
                    //Mostramos el mensaje de que se ha subido co éxito
                    // $sql = "INSERT INTO `profesores` (`dni`, `nombre`, `apellido`, `titulo academico`, `foto`, `contraseña`) VALUES ('".$_POST['dni']."', '".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['titulo_academico']."', '../fotos/foto_".$_POST['dni'].".jpg', '".$_POST['contraseña']."');";
                    $sql = "INSERT INTO cursos (`codigo`,`nombre`,`descripcion`,`horas`,`fecha inicio`,`fecha final`, `foto`, `profesor`) VALUES (NULL,'".$_POST['nombre']."','".$_POST['descripcion']."',".$_POST['horas'].",'".$_POST['fecha_inicio']."','".$_POST['fecha_final']."', '../fotos_cursos/foto_".$codigo.".jpg','".$_POST['profesor']."')";      
                    if($resultado = $con->query($sql)){
                        echo "<meta http-equiv=REFRESH content=0,URL=cursos_admin.php>";
                    }else{
                        echo "No funciono".$sql;
                    }
                }
                else{
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    echo "Por favor vuelva a registrarse..";
                    echo "<meta http-equiv=REFRESH content=2,URL=registro_cursos.php>";
                }
            }
            }
        }else{
    ?>
    <header>
        <section>
            <div class="Logo"><a href="inicio.php"><img src='../logo/logo1.jpg' class="Logo"></a></div>
            <div class="Titulo"><h1>Administracion Cursos</h1></div>
            <div class="Boton_cursos"><a href="cursos_admin.php" class="boton_cursos">Cursos</a></div>
            <div class="Boton_profes"><a href="profesores_admin.php" class="boton_profes">Profesores</a></div>
            <div class="cerrar_sesion"><a href="cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesion</a></div>
        </section>
    </header>
    <script src="funciones_javascript.js"></script>
    <div class="Todo">
        <div class="form">
            <form action="registro_cursos.php" method="POST" enctype="multipart/form-data" onsubmit="return validar()">
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
                    foreach(lista_profesores($con) as $clave => $valor){
                        echo "<option value=".$valor['dni'].">".$valor['nombre']." - ".$valor['dni']."</option>";
                    };
                ?>
                </select>
                <input type="Submit" value="Registrar" id="submit" class="submit_cursos" />
        </div>
    </div>
        <?php }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
    }
        ?>
</body>
</html>