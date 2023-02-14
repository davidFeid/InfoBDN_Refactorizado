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
        if(isset($_GET['dni']) || isset($_POST['dni'])){
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
                    echo "<meta http-equiv=REFRESH content=2,URL=editar_foto.php?dni=".$_POST['dni'].">";
                }else{
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, "../fotos/foto_".$_POST['dni'].".jpg")) {
                        //Mostramos el mensaje de que se ha subido co éxito
                        $sql = "UPDATE `profesores` SET `foto` = '/InfoBDN/fotos/foto_".$_POST['dni'].".jpg' WHERE `profesores`.`dni` = '".$_POST['dni']."';";
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
                        echo "<meta http-equiv=REFRESH content=2,URL=editar_foto.php?dni=".$_POST['dni'].">";
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
                <form action="editar_foto.php" method="POST" enctype="multipart/form-data">
                    <label class="titulo_registro"><h2>Editor Foto Profesor</h2></label>
                    <input type="hidden" name="dni" value="<?php echo $_GET['dni'] ?>"></input>
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" required></input>
                    <div><input type="Submit" value="Registrar" id="submit" class="submit" /></div>
            </div>
        </div>
            <?php  
        }
    }else{
        echo "No hay DNI";
        echo "<meta http-equiv=REFRESH content=2,URL=profesores_admin.php>";
    }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
    }
        ?>
</body>
</html>