<?php 
    class CursoController{
        

        //Funcion para enlistar todos los cursos
        public function listado(){
            if(isset($_SESSION['Administrador'])){
                require_once "models/curso.php";
                $curso = new Curso();
                $lista = $curso->listadoCursos();
                require_once "views/curso/lista.php";
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
            
        }

        public function registrar(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_POST['nombre'])){//Validaos que tengamos un formulario rellenado
                    require_once "models/curso.php";
                    $curso = new Curso();
                        foreach($_POST as $clave => $valor){
                           $set = "set".$clave;
                           $curso->$set($valor);
                        }
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
                            echo "<meta http-equiv=REFRESH content=2,URL=index.php?controller=Curso&action=registrar>";
                        }else{
                            //Si la imagen es correcta en tamaño y tipo
                            //Se intenta subir al servidor C:\xampp\htdocs\tiendaonline\views\css\assets\fotos
                            if (move_uploaded_file($temp, "views/css/assets/fotos/foto_".$_POST['nombre'].".jpg")) {
                                $curso->setFoto("views/css/assets/fotos/foto_".$_POST['nombre'].".jpg");
                                $curso->insertar();
                                $lista = $curso->listadoCursos();
                                require_once "views/curso/lista.php";
                            }else{
                                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                echo "Por favor vuelva a registrarse..";
                                require_once "views/curso/registro.php";
                            }
                        }
                    }
                }else{
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    $listadoProfesores = $profesor->listadoProfesores();
                    require_once "views/curso/registro.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function editar(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_GET['codigo'])){
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    $listadoProfesores = $profesor->listadoProfesores();

                    require_once "models/curso.php";
                    $curso = new Curso;
                    $curso->setCodigo($_GET['codigo']);
                    $editarCurso = $curso->obtenerByCodigo();
                    require_once "views/curso/editar.php";

                }elseif(isset($_POST['codigo'])){
                    require_once "models/curso.php";
                    $curso = new Curso();
                    foreach($_POST as $clave => $valor){
                       $set = "set".$clave;
                       $curso->$set($valor);
                    }
                    $curso->editar();
                    $lista = $curso->listadoCursos();
                    require_once "views/curso/lista.php";
                }else{
                    echo "El curso ".$_GET['codigo']." No existe";
                    $lista = $curso->listadoCursos();
                    require_once "views/curso/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function estado(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_GET['codigo']) && isset($_GET['estado'])){
                    require_once "models/curso.php";
                    $curso = new Curso;
                    $curso->setCodigo($_GET['codigo']);
                    $curso->setActivo($_GET['estado']);
                    $curso->editarEstado();
                    ?>
                        <script>window.location.replace("index.php?controller=Curso&action=listado");</script>
                    <?php
                }else{
                    require_once "models/curso.php";
                    $curso = new Curso;
                    echo "Datos incorrectos";
                    $lista = $curso->listadoCursos();
                    require_once "views/curso/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        //Funcion para editar la imagen del curso
        public function editarFoto(){
            if(isset($_SESSION['Administrador'])){//Validamos que accede el administrador
                if(isset($_POST['codigo'])){//Validaos que tengamos un formulario rellenado
                    require_once "models/curso.php";
                    $curso = new Curso();
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
                            echo "<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                            - Se permiten archivos .jpg, .png. y de 200 kb como máximo.</b><br>Por favor Vuelva a registrarse</div>";
                            
                        }else{
                            //Si la imagen es correcta en tamaño y tipo
                            //Se intenta subir al servidor C:\xampp\htdocs\tiendaonline\views\css\assets\fotos
                            if (move_uploaded_file($temp, "views/css/assets/fotos/foto_".$_POST['codigo'].".jpg")) {
                                $curso->setFoto("views/css/assets/fotos/foto_".$_POST['codigo'].".jpg");
                                $curso->setCodigo($_POST['codigo']);
                                $curso->editarFoto();
                                $lista = $curso->listadoCursos();
                                require_once "views/curso/lista.php";
                            }else{
                                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo "<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>";
                                echo "Por favor vuelva a Editar la imagen..";
                                require_once "views/curso/editarFoto.php";
                            }
                        }
                    }

                }elseif(isset($_GET['codigo'])){
                    require_once "models/curso.php";
                    $curso = new Curso();
                    $curso ->setCodigo($_GET['codigo']);
                    $lista = $curso->obtenerByCodigo();
                    require_once "views/curso/editarImagen.php";
                }else{
                    require_once "models/curso.php";
                    $curso = new Curso();
                    $lista = $curso->listadoCursos();
                    require_once "views/curso/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

}
?>