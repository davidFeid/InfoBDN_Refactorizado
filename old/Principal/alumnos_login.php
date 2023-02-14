<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="estilo_login.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../logo/logo1.png">
    <title>Login Alumno</title>
</head>
<body>
    <?php
    //include('funciones.php');
    include('../conexion.php');
    $con = conectar();
    if(isset($_POST['dni'])){
        if($_POST['opcion'] == 'alumno'){
            $sql = "SELECT * FROM alumnos WHERE dni = '".$_POST['dni']."' and contraseña = '".md5($_POST['contraseña'])."' and activo = 1";
            if($resultado = $con->query($sql)){
                $row = $resultado->fetch_assoc();
                if(isset($row)){
                    unset($row['contraseña']);
                    unset($row['activo']);
                    $_SESSION['array_alumno'] = $row;
                    echo "<meta http-equiv=REFRESH content=0,URL=alumnos_home.php>";
                }else{
                    echo "Usuario No Existe<br>";
                    echo "Redireccion al Inicio de Sesión...";
                    echo "<meta http-equiv=REFRESH content=2,URL=alumnos_login.php>";
                }
            }else{
                echo "Fallo QUERY".$sql;
            }
        }else if($_POST['opcion'] == 'profesor'){
            $sql = "SELECT * FROM profesores WHERE dni = '".$_POST['dni']."' and contraseña = '".md5($_POST['contraseña'])."' and activo = 1";
            if($resultado = $con->query($sql)){
                $row = $resultado->fetch_assoc();
                if(isset($row)){
                    unset($row['contraseña']);
                    unset($row['activo']);
                    $_SESSION['array_profesor'] = $row;
                    echo "<meta http-equiv=REFRESH content=0,URL=profesores_home.php>";
                }else{
                    echo "Usuario No Existe<br>";
                    echo "Redireccion al Inicio de Sesión...";
                    echo "<meta http-equiv=REFRESH content=2,URL=alumnos_login.php>";
                }
            }else{
                echo "Fallo QUERY".$sql;
            }
        }
    }else{
?>
    <section class="login">
        <div class="formulario">
            <!--<div class="form">-->
                <form action="alumnos_login.php" method="POST" enctype="multipart/form-data">
                    <!--<label class="titulo_registro">--><h1>Iniciar Sesión</h1><!--</label>-->
                    <div class="grupo">    
                        <label for="dni">DNI:</label>
                        <input type="text" id="dni" name="dni" autocomplete="off" required></input>
                    </div>
                    <div class="grupo">
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" id="contraseña" name="contraseña" autocomplete="off" required></input>
                    </div>
                    <div class="grupo_option">
                        <label for="nada">Iniciar Sesion Como:</label>
                        <input type="radio" id="alumno" name="opcion" value="alumno" required />
                        <label for="alumno">Alumno</label>
                        <input type="radio" id="profesor" name="opcion" value="profesor" />
                        <label for="profesor">Profesor</label>
                    </div>
                    <div class="grupo_boton">
                        <input type="Submit" value="Entrar" id="submit" class="submit_alumnos" />
                    </div>
                    <p>No estas registrado? <a href='registro.php' class='boron_registrarse'>Registrarse Aqui!</a></p><br>
                    <p>Ingresar como Admin? <a href='../Admin/login.php' class='boton_admin'>Acceder Aqui!</a></p>
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