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
        if(isset($_GET['dni']) || isset($_POST['nombre'])){
        include('funciones.php');
        include('../conexion.php');
        $con = conectar();
        if(isset($_GET['eliminar'])){
            if($_GET['eliminar'] == 1){
                $sql = "UPDATE cursos SET `activo` = 0 WHERE `profesor` = '".$_GET['dni']."'";
                echo $sql;
                if($resultado = $con->query($sql)){
                    echo "query realizada con exito";
                }else{
                    echo "Tu Query No se ha realizado correctamente (desactivacion de curso)";
                }

                $sql = "UPDATE profesores SET activo = 0 WHERE dni = '".$_GET['dni']."'";
            }else{
                $sql = "UPDATE profesores SET activo = 1 WHERE dni = '".$_GET['dni']."'";
            }
            if($resultado = $con->query($sql)){
                echo "<meta http-equiv=REFRESH content=0,URL=profesores_admin.php>";
            }else{
                echo "Tu Query No se ha realizado correctamente";
                echo "<meta http-equiv=REFRESH content=1,URL=profesores_admin.php>";
            }
        }else{
        if(isset($_POST['nombre'])){
            $sql = "UPDATE `profesores` SET `nombre` = '".$_POST['nombre']."', `apellido` = '".$_POST['apellido']."', `titulo academico` = '".$_POST['titulo_academico']."' WHERE `profesores`.`dni` = '".$_POST['dni']."';";
            if($resultado = $con->query($sql)){
                echo "<meta http-equiv=REFRESH content=0,URL=profesores_admin.php>";
            }else{
                echo "Tu Query No se ha realizado correctamente";
                echo "<meta http-equiv=REFRESH content=1,URL=profesores_admin.php>";
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
        <?php 
            $listado = listado_profesor_especifico($con,$_GET['dni']);
        ?>
        <div class="Todo">
            <div class="form_profesor">
                <form action="editar_profesores.php" method="POST">
                    <label class="titulo_registro"><h2>Editor Profesor DNI - <?php echo $_GET['dni']; ?></h2></label>
                    <input type="hidden" name="dni" value="<?php echo $_GET['dni']; ?>"></input>
                    <label for="Nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $listado[0]['nombre'] ?>" required></input>
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $listado[0]['apellido'] ?>" required></input>
                    <label for="titulo_academico">Titulo Academico:</label>
                    <input type="text" id="titulo_academico" name="titulo_academico" value="<?php echo $listado[0]['titulo academico'] ?>" required></input>
                    <div><input type="Submit" value="Editar" id="submit" class="submit" /></div>
            </div>
        </div>
        <?php 
        }
        }
        }else{
            echo "No hay ningun id de curso para editar...";
            echo "<meta http-equiv=REFRESH content=2,URL=cursos_admin.php>";
        }    
    }else{
        echo "Debes Validarte...";
        echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
    }
        ?>
</body>
</html>