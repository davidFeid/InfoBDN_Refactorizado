<?php 
 session_start();
?>
<html>
<head>
    <link href="estilo_admin.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="../logo/logo1.png">
    <title>Home Admin</title>
</head>
<body>
    <?php
    if(isset($_SESSION['admin'])){
    ?>
    <header>
        <section>
            <div class="Logo"><img src='../logo/logo1.jpg' class="Logo"></div>
            <div class="Titulo"><h1>Administrador</h1></div>
            <div class="Boton_cursos"><a href="cursos_admin.php" class="boton_cursos">Cursos</a></div>
            <div class="Boton_profes"><a href="profesores_admin.php" class="boton_profes">Profesores</a></div>
            <div class="cerrar_sesion"><a href="cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesion</a></div>
        </section>
    </header>
    <div class="todo_home">
        <div class="home">
            <a class="home" href="cursos_admin.php"><h1>Cursos</h1></a>
            <a class="home" href="cursos_admin.php"><img src='../imagenes/cursos_imagen.jpg' />
        </div>
        <div class="home">
            <a class="home" href="profesores_admin.php"><h1>Profesores</h1></a>
            <a class="home" href="profesores_admin.php"><img src='../imagenes/profesor_imagen1.png' /></a>
        </div>
    </div>
        <?php 
        }else{
            echo "Debes Validarte...";
            echo "<meta http-equiv=REFRESH content=2,URL=login.php>";
        }
        ?>
</body>
</html>