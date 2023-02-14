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
            <div class="Titulo"><h1>Administracion Cursos</h1></div>
            <div class="Boton_cursos"><a href="cursos_admin.php" class="boton_cursos">Cursos</a></div>
            <div class="Boton_profes"><a href="profesores_admin.php" class="boton_profes">Profesores</a></div>
            <div class="cerrar_sesion"><a href="cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesion</a></div>
        </section>
    </header>
    <div class="Todo">
        <?php 
            if(!isset($_POST['busqueda'])){
                $lista = listado_cursos($con);
            }else{
                    $sql = "SELECT * FROM `cursos` WHERE `nombre` LIKE '%".$_POST['busqueda']."%'";
                    if($resultado = $con->query($sql)){
                            while($row = $resultado->fetch_assoc()){
                            $lista[] = $row;
                            }
                    }
                    if(!isset($lista)){
                        echo "<meta http-equiv=REFRESH content=0,URL=cursos_admin.php>";
                    }
            }
        ?>
        <div class="buscador">
            <form action='cursos_admin.php' method='POST'>
                <input type="text" id="busqueda" name="busqueda" placeholder="Busca tu Curso por Nombre" autocomplete="off" class="busqueda"></input>
                <input type="submit" id="submit" value="Buscar" class="buscar"></input>
            </form>
        </div>
        <div class="Nuevo_registro">
            <a href="registro_cursos.php" class="boton_nuevo">Nuevo Curso</a>
        </div>
        <div class="tabla">
            <table class="cursos">
                <tr><td colspan="10" class="titulo_cursos"><b>Cursos</b><td></tr>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Horas</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Foto</th>
                    <th>Profesor</th>
                    <th>Editar</th>
                    <th>Desactivar</th>
                    <th>Editar Foto</th>
                </tr>
            <?php 
                foreach($lista as $clave => $valor){
                    echo "<tr>";
                    unset($valor['descripcion']);
                    $activo = $valor['activo'];
                    unset($valor['activo']);    
                    foreach($valor as $clave1 => $valor1){
                        if($clave1 == 'foto'){
                            echo "<td><img src=".$valor1." /></td>";
                        }else{
                            echo "<td>".$valor1."</td>";
                        }
                    }
                    echo "<td class='celda_imagen'><a href='editar_cursos.php?codigo=".$valor['codigo']."'><img src='../imagenes/editar.png' class='editar'></a></td>";
                    if($activo == 1){
                        echo "<td class='celda_imagen'><a href='editar_cursos.php?codigo=".$valor['codigo']."&eliminar=1'><img src='../imagenes/check_rojo.png' class='eliminar'></a></td>";
                    }else{
                        echo "<td class='celda_imagen'><a href='editar_cursos.php?codigo=".$valor['codigo']."&eliminar=0'><img src='../imagenes/check.png' class='eliminar'></a></td>";
                    }
                    echo "<td class='celda_imagen'><a href='editar_foto_curso.php?codigo=".$valor['codigo']."'><img src='../imagenes/editar_foto.png' class='eliminar'></a></td>";
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