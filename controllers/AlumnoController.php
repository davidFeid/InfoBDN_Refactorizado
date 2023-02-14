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

    }