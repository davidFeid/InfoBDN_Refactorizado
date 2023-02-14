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
        if(isset($_POST['dni'])){
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
                    echo "<meta http-equiv=REFRESH content=2,URL=registro_profesores.php>";
                }else{
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, "../fotos/foto_".$_POST['dni'].".jpg")) {
                        //Mostramos el mensaje de que se ha subido co éxito
                        $sql = "INSERT INTO `profesores` (`dni`, `nombre`, `apellido`, `titulo academico`, `foto`, `contraseña`) VALUES ('".$_POST['dni']."', '".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['titulo_academico']."', '../fotos/foto_".$_POST['dni'].".jpg', '".md5($_POST['contraseña'])."');";
                        if($resultado = $con->query($sql)){
                            echo "<meta http-equiv=REFRESH content=0,URL=profesores_admin.php>";
                        }else{
                            echo "No funciono".$sql;
                        }
                    }
                    else{
                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                        echo "Por favor vuelva a registrarse..";
                        echo "<meta http-equiv=REFRESH content=2,URL=registro_profesores.php>";
                    }
                }
                }
        }else{
    ?>
    <header>
        <section>
            <div class="Logo"><a href="inicio.php"><img src='../logo/logo1.jpg' class="Logo"></a></div>
            <div class="Titulo"><h1>Administracion Profesores</h1></div>
            <div class="Boton_cursos"><a href="cursos_admin.php" class="boton_cursos">Cursos</a></div>
            <div class="Boton_profes"><a href="profesores_admin.php" class="boton_profes">Profesores</a></div>
            <div class="cerrar_sesion"><a href="cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesion</a></div>
        </section>
    </header>
    <div class="Todo">
        <div class="form">
            <form action="registro_profesores.php" method="POST" enctype="multipart/form-data">
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
        <?php }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
    }
        ?>
</body>
</html>