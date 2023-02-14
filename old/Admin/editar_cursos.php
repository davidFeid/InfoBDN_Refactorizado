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
        if(isset($_GET['codigo']) || isset($_POST['nombre'])){
            include('funciones.php');
            include('../conexion.php');
            $con = conectar();
            if(isset($_GET['eliminar'])){
                if($_GET['eliminar'] == 1){
                    $sql = "UPDATE cursos SET activo = 0 WHERE codigo = ".$_GET['codigo']."";
                }else{
                    $sql = "UPDATE cursos SET activo = 1 WHERE codigo = ".$_GET['codigo']."";
                }
                if($resultado = $con->query($sql)){
                        echo "<meta http-equiv=REFRESH content=0,URL=cursos_admin.php>";
                }else{
                    echo "Tu Query No se ha realizado correctamente";
                }
            }else{
                if(isset($_POST['nombre'])){
                    $sql = "UPDATE `cursos` SET `nombre` = '".$_POST['nombre']."', `descripcion` = '".$_POST['descripcion']."', `horas` = '".$_POST['horas']."', `fecha inicio` = '".$_POST['fecha_inicio']."', `fecha final` = '".$_POST['fecha_final']."', `profesor` = '".$_POST['profesor']."' WHERE `cursos`.`codigo` = ".$_POST['codigo'].";";
                    if($resultado = $con->query($sql)){
                        echo "<meta http-equiv=REFRESH content=0,URL=cursos_admin.php>";
                    }else{
                        echo "Tu Query No se ha realizado correctamente";
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
                <?php 
                    $listado = listado_curso_especifico($con,$_GET['codigo']);
                ?>
                <script src="funciones_javascript.js"></script>
                <div class="Todo">
                    <div class="form">
                        <form action="editar_cursos.php" method="POST" onsubmit="return validar()" >
                            <label class="titulo_registro"><h2>Editor Curso ID - <?php echo $_GET['codigo']; ?></h2></label>
                            <input type="hidden" id="codigo" name="codigo" value="<?php echo $listado[0]['codigo'] ?>" required></input>
                            <label for="Nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $listado[0]['nombre'] ?>" required></input>
                            <label for="descripcion">Descripcion:</label>
                            <textarea id="descripcion" name="descripcion" rows="4" cols="50" required><?php echo $listado[0]['descripcion'] ?></textarea>
                            <label for="horas">Horas:</label>
                            <input type="number" id="horas" name="horas" min="0" value="<?php echo $listado[0]['horas'] ?>" required></input>
                            <label for="fecha_inicio">Fecha Inicio:</label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $listado[0]['fecha inicio'] ?>" required></input>
                            <label for="fecha_final">Fecha Final: <?php echo $listado[0]['fecha final'] ?></label>
                            <input type="date" id="fecha_final" name="fecha_final" value="<?php echo $listado[0]['fecha final'] ?>" required></input>
                            <label for="profesor">Profesor</label>
                            <select name="profesor" id="profesor" required>
                            <?php 
                                foreach(lista_profesores($con) as $clave => $valor){
                                    if($valor['dni'] == $listado[0]['profesor']){
                                        echo "<option value=".$valor['dni']." selected >".$valor['nombre']." - ".$valor['dni']."</option>";
                                    }else{
                                        echo "<option value=".$valor['dni'].">".$valor['nombre']." - ".$valor['dni']."</option>";
                                    }
                                };
                            ?>
                            </select>
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