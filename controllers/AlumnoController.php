<?php
    // Creamos la class.
    class AlumnoController{
        
        public function home(){
            if(isset($_SESSION['Alumno'])){
                require_once 'models/matricula.php';
                $matricula = new Matricula();
                $matricula->setDni_alumno($_SESSION['Alumno']->dni);
                $lista = $matricula->cursosNoMatriculado();
                require_once 'views/alumno/home.php';
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function verCurso(){
            if(isset($_SESSION['Alumno'])){
                if(isset($_GET['curso'])){
                    require_once 'models/curso.php';
                    require_once 'models/profesor.php';
                    require_once 'models/matricula.php';

                    $curso = new Curso();
                    $curso->setCodigo($_GET['curso']);
                    $lista = $curso->obtenerByCodigo();
                    $dniProfesor = $curso->getDniProfesorByCurso();

                    $matricula = new Matricula();
                    $matricula->setCurso($_GET['curso']);
                    $matricula->setDni_alumno($_SESSION['Alumno']->dni);
                    $comprobarMatricula = $matricula->comprobarMatricula();

                    $profesor = new Profesor(); 
                    $profesor->setDni($dniProfesor[0]->profesor);
                    $infoProfesor = $profesor->obtenerByDni();
                    unset($infoProfesor[0]->contraseña);
                    unset($infoProfesor[0]->activo);

                    require_once 'views/alumno/verCurso.php';
                }else{
                    ?>
                    <script>
                        alert('curso no encontrado');
                        window.location.replace("index.php?controller=Alumnos&action=home");
                    </script>
                <?php
                }
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function misCursos(){
            if(isset($_SESSION['Alumno'])){
                include_once "models/matricula.php";
                $matricula = new Matricula();
                $matricula->setDni_alumno($_SESSION['Alumno']->dni);

                $cursosActivos = $matricula->cursosActivosByDni();

                $cursosProximos = $matricula->cursosProximosByDni();

                $cursosFinalizados = $matricula->cursosFinalizadosByDni();

                include_once "views/alumno/misCursos.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function Matricularse(){
            if(isset($_SESSION['Alumno'])){
                if($_GET['curso']){
                    include_once "models/matricula.php";
                    $matricula = new Matricula();
                    $matricula->setDni_alumno($_SESSION['Alumno']->dni);
                    $matricula->setCurso($_GET['curso']);
                    if(!($matricula->comprobarMatricula())){
                        $matricula->matricular();
                        ?>
                            <script>
                                window.location.replace("index.php?controller=Alumno&action=verCurso");
                            </script>
                        <?php
                    }else{
                        ?>
                            <script>
                                alert('Ya estas matriculado en este curso');
                                window.location.replace("index.php?controller=Alumno&action=misCursos");
                            </script>
                        <?php
                    }
                }else{
                    ?>
                        <script>
                            alert('curso no encontrado');
                            window.location.replace("index.php?controller=Alumno&action=misCursos");
                        </script>
                    <?php
                }
                include_once "models/matricula.php";
                $matricula = new Matricula();
            

                include_once "views/alumno/misCursos.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function desmatricularse(){
            if(isset($_SESSION['Alumno'])){
                if($_GET['curso']){
                    include_once "models/matricula.php";
                    $matricula = new Matricula();
                    $matricula->setDni_alumno($_SESSION['Alumno']->dni);
                    $matricula->setCurso($_GET['curso']);
                    if($matricula->comprobarMatricula()){
                        $matricula->desmatricular();
                        ?>
                            <script>
                                window.location.replace("index.php?controller=Alumno&action=misCursos");
                            </script>
                        <?php
                    }else{
                        ?>
                            <script>
                                alert('No estas matriculado en este curso');
                                window.location.replace("index.php?controller=Alumno&action=misCursos");
                            </script>
                        <?php
                    }
                }else{
                    ?>
                        <script>
                            alert('curso no encontrado');
                            window.location.replace("index.php?controller=Alumno&action=misCursos");
                        </script>
                    <?php
                }
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function cursosDisponibles(){
            if(isset($_SESSION['Alumno'])){
                include_once "models/matricula.php";
                $matricula = new Matricula();
                $lista = $matricula->cursosDisponibles();
                include_once "views/alumno/cursosDisponibles.php";
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            }
        }

        public function registro(){
            if(isset($_POST['dni'])){
                require_once "models/alumno.php";
                $alumno = new Alumno();
                $alumno->setDni($_POST['dni']);
                if($alumno->validarDni()){
                    foreach($_POST as $clave => $valor){
                       $set = "set".$clave;
                       $alumno->$set($valor);
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
                            echo "<meta http-equiv=REFRESH content=2,URL=index.php?controller=Alumno&action=registro>";
                        }else{
                            //Si la imagen es correcta en tamaño y tipo
                            //Se intenta subir al servidor C:\xampp\htdocs\tiendaonline\views\css\assets\fotos
                            if (move_uploaded_file($temp, "views/css/assets/fotos/foto_".$_POST['dni'].".jpg")) {
                                $alumno->setFoto("views/css/assets/fotos/foto_".$_POST['dni'].".jpg");
                                $alumno->insertar();
                                ?>
                                    <script>
                                        alert('Alumno registrado');
                                        window.location.replace("index.php?controller=Base&action=Login");
                                    </script>
                                <?php
                            }else{
                                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                                echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                                echo "Por favor vuelva a registrarse..";
                                require_once "views/alumno/registro.php";
                            }
                        }
                    }
                }else{
                    ?>
                    <script>
                        alert('Dni ya registrado');
                        window.location.replace("index.php?controller=Alumno&action=registro");
                    </script>
                    <?php
                }
            }else{
                require_once 'views/alumno/registro.php';
            }
        } 

    }