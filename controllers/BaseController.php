<?php 

    class BaseController{

        public static function salir(){
            session_unset();
            session_destroy();
            ?>
            <script>window.location.replace("index.php");</script>
            <?php
        }

        public static function login(){
            if(isset($_POST['dni'])){
                if($_POST['opcion'] == 'alumno'){
                    require_once "models/alumno.php";
                    $alumno = new Alumno();
                    $alumno->setDni($_POST['dni']);
                    $alumno->setContraseña($_POST['contraseña']);
                    if($alumno->login()){
                        $row = $alumno->obtenerByDni();
                        unset($row[0]->contraseña);
                        unset($row[0]->activo);
                        $_SESSION['Alumno'] = $row[0];
                        ?>
                            <script>
                                window.location.replace("index.php?controller=Alumno&action=home");
                            </script>
                        <?php
                    }else{
                        ?>
                            <script>
                                alert('Usuario no existe');
                                window.location.replace("index.php?controller=Base&action=login");
                            </script>
                        <?php
                    }
                }else{
                    require_once "models/profesor.php";
                    $profesor = new Profesor();
                    $profesor->setDni($_POST['dni']);
                    $profesor->setContraseña($_POST['contraseña']);
                    if($profesor->loginProfesor()){
                        $row = $profesor->obtenerByDni();
                        unset($row[0]->contraseña);
                        unset($row[0]->activo);
                        $_SESSION['Profesor'] = $row[0];
                        ?>
                            <script>
                                window.location.replace("index.php?controller=Profesor&action=home");
                            </script>
                        <?php
                    }else{
                        ?>
                            <script>
                                alert('Usuario no existe');
                                window.location.replace("index.php?controller=Base&action=login");
                            </script>
                        <?php
                    }
                }
                require_once 'views/general/login.php';
            }else{
                require_once 'views/general/login.php';
            }
        }
        
    }
?>