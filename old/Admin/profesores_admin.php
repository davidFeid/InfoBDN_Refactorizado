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
        <?php 
            if(!isset($_POST['busqueda'])){
                $lista = listado_profesores($con);
            }else{
                    $sql = "SELECT * FROM `profesores` WHERE `nombre` LIKE '%".$_POST['busqueda']."%'";
                    if($resultado = $con->query($sql)){
                            while($row = $resultado->fetch_assoc()){
                            $lista[] = $row;
                            }
                    }
                    if(!isset($lista)){
                        echo "<meta http-equiv=REFRESH content=0,URL=profesores_admin.php>";
                    }
            }
        ?>
        <div class="buscador">
            <form action='profesores_admin.php' method='POST'>
                <input type="text" id="busqueda" name="busqueda" placeholder="Busca tu Profesor por Nombre" autocomplete="off" class="busqueda"></input>
                <input type="submit" id="submit" value="Buscar" class="buscar"></input>
            </form>
        </div>
        <div class="Nuevo_registro">
            <a href="registro_profesores.php" class="boton_nuevo">Nuevo Registro</a>
        </div>
        <div class="tabla">
            <table class="profesores">
                <tr><td colspan="9" class="titulo_profesores"><b>Cursos</b><td></tr>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Titulo Academico</th>
                    <th>Foto</th>
                    <th>Editar</th>
                    <th>Desactivar</th>
                    <th>Editar Foto</th>
                </tr>
            <?php 
                foreach($lista as $clave => $valor){
                    echo "<tr>";
                    unset($valor['contraseña']);
                    $activo = $valor['activo'];
                    unset($valor['activo']);
                    foreach($valor as $clave1 => $valor1){
                        if($clave1 =='foto'){
                            echo "<td><img class='imagen_profe' src='".$valor1."' /></td>";
                        }else{
                        echo "<td>".$valor1."</td>";
                    }
                    }
                    echo "<td class='celda_imagen'><a href='editar_profesores.php?dni=".$valor['dni']."'><img src='../imagenes/editar.png' class='editar'></a></td>";
                    if($activo == 1){
                        echo "<td class='celda_imagen'><a href='editar_profesores.php?dni=".$valor['dni']."&eliminar=1'><img src='../imagenes/check_rojo.png' class='eliminar'></a></td>";
                    }else{
                        echo "<td class='celda_imagen'><a href='editar_profesores.php?dni=".$valor['dni']."&eliminar=0'><img src='../imagenes/check.png' class='eliminar'></a></td>";
                    }
                    echo "<td class='celda_imagen'><a href='editar_foto.php?dni=".$valor['dni']."'><img src='../imagenes/editar_foto.png' class='eliminar'></a></td>";
                    echo "</tr>";
                }
            ?>
            </table>
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