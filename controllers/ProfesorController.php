<?php
    // Creamos la class.
    class ProfesorController{
        
        public function listado(){
            if(isset($_SESSION['Administrador'])){
                require_once "models/profesor.php";
                $profesor = new Profesor();
                $lista = $profesor->listadoProfesores();
                require_once "views/profesor/lista.php";
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function registrar(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_POST['dni'])){//Validaos que tengamos un formulario rellenado
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
                    $profesor->setDni($_POST['dni']);
                    if($profesor->validarDni()){
                        foreach($_POST as $clave => $valor){
                           $set = "set".$clave;
                           $profesor->$set($valor);
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
                                echo "<meta http-equiv=REFRESH content=2,URL=index.php?controller=Profesor&action=registrar>";
                            }else{
                                //Si la imagen es correcta en tamaño y tipo
                                //Se intenta subir al servidor C:\xampp\htdocs\tiendaonline\views\css\assets\fotos
                                if (move_uploaded_file($temp, "views/css/assets/fotos/foto_".$_POST['dni'].".jpg")) {
                                    $profesor->setFoto("views/css/assets/fotos/foto_".$_POST['dni'].".jpg");
                                    $profesor->insertar();
                                    $lista = $profesor->listadoProfesores();
                                    require_once "views/profesor/lista.php";
                                }else{
                                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                    echo "Por favor vuelva a registrarse..";
                                    require_once "views/profesor/registro.php";
                                }
                            }
                        }
                    }else{
                        ?>
                        <script>
                            alert('Dni ya registrado');
                            window.location.replace("index.php?controller=Profesor&action=registrar");
                        </script>
                        <?php
                    }
                }else{
                    require_once "views/profesor/registro.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function editar(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_GET['dni'])){
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    $profesor->setDni($_GET['dni']);
                    $editarProfesor = $profesor->obtenerByDni();
                    require_once "views/profesor/editar.php";
                }elseif(isset($_POST['dni'])){
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
                    foreach($_POST as $clave => $valor){
                       $set = "set".$clave;
                       $profesor->$set($valor);
                    }
                    $profesor->editar();
                    $lista = $profesor->listadoProfesores();
                    require_once "views/profesor/lista.php";
                }else{
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    echo "El profesor No existe";
                    $lista = $profesor->listadoProfesores();
                    require_once "views/profesor/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function estado(){
            if(isset($_SESSION['Administrador'])){
                if(isset($_GET['dni']) && isset($_GET['estado'])){
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    $profesor->setDni($_GET['dni']);
                    $profesor->setActivo($_GET['estado']);
                    $profesor->editarEstado();
                    ?>
                        <script>window.location.replace("index.php?controller=Profesor&action=listado");</script>
                    <?php
                }else{
                    require_once "models/profesor.php";
                    $profesor = new Profesor;
                    echo "Datos incorrectos";
                    $lista = $profesor->listadoProfesores();
                    require_once "views/profesor/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function editarFoto(){
            if(isset($_SESSION['Administrador'])){//Validamos que accede el administrador
                if(isset($_POST['dni'])){//Validaos que tengamos un formulario rellenado
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
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
                            if (move_uploaded_file($temp, "views/css/assets/fotos/foto_".$_POST['dni'].".jpg")) {
                                $profesor->setFoto("views/css/assets/fotos/foto_".$_POST['dni'].".jpg");
                                $profesor->setDni($_POST['dni']);
                                $profesor->editarFoto();
                                $lista = $profesor->listadoProfesores();
                                require_once "views/profesor/lista.php";
                            }else{
                                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo "<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>";
                                echo "Por favor vuelva a Editar la imagen..";
                                require_once "views/profesor/editarImagen.php";
                            }
                        }
                    }

                }elseif(isset($_GET['dni'])){
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
                    $profesor ->setDni($_GET['dni']);
                    $lista = $profesor->obtenerByDni();
                    require_once "views/profesor/editarImagen.php";
                }
                else{
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
                    $lista = $profesor->listadoProfesores();
                    require_once "views/profesor/lista.php";
                }
            }else{
                ?>
                <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function home(){
            if(isset($_SESSION['Profesor'])){
                require_once 'views/profesor/home.php';
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function evaluaciones(){
            if(isset($_SESSION['Profesor'])){
                require_once "models/Profesor.php";
                $profesor = new Profesor();
                $profesor->setDni($_SESSION['Profesor']->dni);
                $lista = $profesor->cursosEvaluar();
                require_once "views/profesor/evaluaciones.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            } 
        }

        public function evaluarCurso(){
            if(isset($_SESSION['Profesor']) && isset($_GET['curso'])){
                require_once "models/curso.php";
                $curso = new Curso;
                $curso->setCodigo($_GET['curso']);
                $lista = $curso->getAlumnosByCurso();
                require_once "views/profesor/evaluarCurso.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            } 
        }

        public function cursosActivos(){
            if(isset($_SESSION['Profesor'])){
                require_once "models/curso.php";
                $curso = new Curso;
                $curso->setProfesor($_SESSION['Profesor']->dni);
                $lista = $curso->getCursosByProfesor();
                require_once "views/profesor/cursosActivos.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            } 
        }

        public function verCurso(){
            if(isset($_SESSION['Profesor']) && isset($_GET['curso'])){
                require_once "models/curso.php";
                $curso = new Curso;
                $curso->setCodigo($_GET['curso']);
                $lista = $curso->getAlumnosByCurso();
                require_once "views/profesor/verCurso.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            } 
        }

    }