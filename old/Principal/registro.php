<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="estilo_login.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../logo/logo1.png">
    <title>Registro Alumno</title>
</head>
<body>
    <?php
    //include('funciones.php');
    include('../conexion.php');
    $con = conectar();
    if(isset($_POST['dni'])){
            $sql = "SELECT * FROM alumnos WHERE mail = '".$_POST['mail']."'";
            if($resultado = $con->query($sql)){
                $row = $resultado->fetch_assoc();
                if(!isset($row)){
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
                        echo "<meta http-equiv=REFRESH content=2,URL=registro.php>";
                    }else{
                        //Si la imagen es correcta en tamaño y tipo
                        //Se intenta subir al servidor
                        if (move_uploaded_file($temp, "../fotos_alumnos/foto_".$_POST['dni'].".jpg")) {
                            //Mostramos el mensaje de que se ha subido co éxito
                            $sql = "INSERT INTO `alumnos` (`dni`, `nombre`, `apellido`, `edad`, `mail`, `foto`, `contraseña`) VALUES ('".$_POST['dni']."', '".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['edad']."', '".$_POST['mail']."', '../fotos_alumnos/foto_".$_POST['dni'].".jpg', '".md5($_POST['contraseña'])."');";
                            if($resultado = $con->query($sql)){
                                echo "<meta http-equiv=REFRESH content=0,URL=alumnos_login.php>";
                            }else{
                                echo "No funciono".$sql;
                            }
                        }
                        else{
                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                            echo "Por favor vuelva a registrarse..";
                            echo "<meta http-equiv=REFRESH content=2,URL=registro.php>";
                        }
                    }
                    }  
                }else{
                    echo "MAIL YA REGISTRADO";
                    echo "Se le rediccionara al registro otra ves..";
                    echo "<meta http-equiv=REFRESH content=1,URL=registro.php>";
                }
                }else{
                    echo "Error Base de datos";
                    echo "<meta http-equiv=REFRESH content=1,URL=registro.php>";
                }
    }else{
?>
    <section>
        <div class="formulario">
            <!--<div class="form">-->
                <form action="registro.php" method="POST" enctype="multipart/form-data">
                    <label class="titulo_registro"><h1>Registro Alumno</h1></label>
                    <div class="grupo">    
                        <label for="dni">DNI:</label>
                        <input type="text" id="dni" name="dni" autocomplete="off" required></input>
                    </div>
                    <div class="grupo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" autocomplete="off" required></input>
                    </div>
                    <div class="grupo">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" autocomplete="off" required></input>
                    </div>
                    <div class="grupo">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" autocomplete="off" required></input>
                    </div>
                    <div class="grupo">
                        <label for="mail">Mail</label>
                        <input type="email" id="mail" name="mail" autocomplete="off" required></input>
                    </div>
                    <div class="grupo_foto">
                        <label for="foto" class="label">Foto</label>
                        <!--<input type="file" id="foto" name="foto" class="foto" autocomplete="off"  value="" required></input>-->
                        <label class="custom-file-upload">
                            <input type="file" id="foto" name="foto" autocomplete="off" required />
                            <div class="columna_foto">
                                <p>Subir Foto</p><img src="../imagenes/upload.png" class="upload" alt="Subir Foto">
                            </div>
                        </label>
                    </div>
                    
                    <div class="grupo">
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" id="contraseña" name="contraseña" autocomplete="off" required></input>
                    </div>
                    <div class="grupo_boton">
                        <input type="Submit" value="Registrar" id="submit" class="submit_alumnos" />
                    </div>
                    <p>Ya estas registrado? <a href='alumnos_login.php' class='boton_registrarse'>Login Aqui!</a></p>
                </form>
            <!--</div>-->
        </div>
        <div class="banner">
            <div class="texto"><h1 class="h1">Encantados de Verte</h1><br><h3>Cursos Online</h3><br><h3>Educacion desde casa</h3></div>
            <div class="imagen"><img src="../imagenes/landing.png" /></div>
        </div>
    </section>
    <?php } ?>
</body>
</html>