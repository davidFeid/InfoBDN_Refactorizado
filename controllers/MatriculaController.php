<?php 

    class MatriculaController{

        public function ponerNota(){
            if(isset($_SESSION['Profesor'])){
                if(isset($_POST['nota'])){
                    require_once "models/matricula.php";
                    $matricula = new Matricula();
                    $matricula->setDni_alumno($_POST['alumno']);
                    $matricula->setCurso($_POST['curso']);
                    $matricula->setNota($_POST['nota']);
                    $matricula->updateNota();
                    //echo "<meta http-equiv=REFRESH content=0,URL=index.php?controller=Profesor&action=evaluarCurso&curso=".$_POST['curso'].">";
                    header("Location: index.php?controller=Profesor&action=evaluarCurso&curso=".$_POST['curso']."");
                }else{
                    ?>
                        <script>window.location.replace("index.php?controller=Profesor&action=evaluaciones");</script>
                    <?php
                }
            }else{
                ?>
                    <script>window.location.replace("index.php");</script>
                <?php
            } 
        }

    }
?>