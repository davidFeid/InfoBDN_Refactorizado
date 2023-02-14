<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="width=device-width , initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo/logo1.png">
    <link href="estilo_admin.css" rel="stylesheet" type="text/css">
    <title>Login Admin</title>
</head>
    <body>
    <?php
    if(isset($_POST['dni'])){
        include('../conexion.php');
        $con = conectar();
        $sql = "SELECT * FROM administrador";
        if($resultado = $con->query($sql)){
            $row = $resultado->fetch_assoc();
            if(($_POST['dni'] = $row['dni']) && (md5($_POST['password']) == $row['contraseña'])){
                $_SESSION['admin'] = $_POST['dni'];
                echo "<meta http-equiv=REFRESH content=0,URL=inicio.php>";
            }else{
                echo "Usuario y/o Contraseña incorrectos".$row['contraseña'];
                echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
            }
        }else{
            echo "Fallo Interno Base de Datos";
        } 
    }else{
        echo "<div class='login'>";
            echo "<h1>Admin InfoBDN</h1>";
            echo "<form class='login' action='login.php' method='POST'>";
                echo "DNI: <input type='text' name='dni' required /><br>";
                echo "Password: <input type='password' name='password' required /><br>";
                echo "<input class='submit' type='submit' name='Enviar' value='Enviar'/>";
            echo "</form>";
            echo "<p>Ingresar como usuario: <a href='../principal/alumnos_login.php' class='boron_registrarse'>Ingresar Aqui!</a></p><br>";
        echo "</div>";
    }   
    ?>
    </body>
</html>