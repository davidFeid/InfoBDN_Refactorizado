<!--Controlador frontal: fichero que se encarga de cargarlo absolutamente todo -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  type="text/css" media="screen" href="views/css/style.css">
        <title>Document</title>
    </head>
    <body>
    
        <?php 
        require_once "autoload.php";
        //require_once "views/general/cabecera.html";
        if(isset($_SESSION['Administrador'])){
            require_once "views/general/headerAdmin.php";
        }else if(isset($_SESSION['Profesor'])){
            require_once "views/general/headerProfesor.php";
        }else if(isset($_SESSION['Alumno'])){
            require_once "views/general/headerAlumno.php";
        }

        if (isset($_GET['controller'])){
            $nombreController = $_GET['controller']."Controller";
           
        }else{
            //Controlador per dedecte
            $nombreController = "BaseController";
        }
        if (class_exists($nombreController)){
            $controlador = new $nombreController(); 
            if(isset($_GET['action'])){
                $action = $_GET['action'];
            }else{
                $action ="login";
            }

            try{
                $controlador->$action();
            } catch (Error $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            } catch (Exception $e){
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
            
        }else{
            echo "No existe el controlador";
        }
        ?>
       
    </body>
    
</html>