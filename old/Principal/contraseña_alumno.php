<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link href="estilos_alumnos.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['array_alumno'])){
            include('funciones_sql.php');
            include('../conexion.php');
            include('funciones_header.php');
            $con = conectar();
            if(isset($_POST['dni'])){
                print_r($_POST);
                $sql = "UPDATE alumnos SET `contraseña` = '".md5($_POST['contraseña'])."' WHERE `dni` = '".$_POST['dni']."'";
                if($resultado = $con->query($sql)){
                    echo "<meta http-equiv=REFRESH content=0,URL=alumnos_home.php>";
                }else{
                    echo "Tu Query No se ha realizado correctamente";
                }
            }else{
            header_alumno($_SESSION['array_alumno']['nombre'],$_SESSION['array_alumno']['foto'],$_SESSION['array_alumno']['dni']);
            ?>
                <div class="Todo">
                    <div class="form">
                        <form action="contraseña_alumno.php" method="POST">
                            <input type="hidden" id="dni" name="dni" value="<?php echo $_SESSION['array_alumno']['dni'] ?>" required></input>
                            <label for="contraseña">Contraseña:</label>
                            <input type="password" id="contraseña" name="contraseña" required></input>
                            <div class='submit'><input type="Submit" value="Editar" id="submit" class="submit" /></div>
                        </form>
                    </div>
                </div>
            <?php
            }
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=1,URL=alumnos_login.php>";
    } ?>
</body>
</html>
