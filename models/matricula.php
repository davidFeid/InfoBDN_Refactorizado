<?php
    // Llamamos al fichero database.php
    require_once("database.php");
    // Hacemos que esta class sea hija de Database para poder heredar la conexión.
    class Matricula extends Database{
        private $dni_alumno;
        private $curso;
        private $nota;

        /**
         * Get the value of dni_alumno
         */ 
        public function getDni_alumno()
        {
                return $this->dni_alumno;
        }

        /**
         * Set the value of dni_alumno
         *
         * @return  self
         */ 
        public function setDni_alumno($dni_alumno)
        {
                $this->dni_alumno = $dni_alumno;

                return $this;
        }

        /**
         * Get the value of curso
         */ 
        public function getCurso()
        {
                return $this->curso;
        }

        /**
         * Set the value of curso
         *
         * @return  self
         */ 
        public function setCurso($curso)
        {
                $this->curso = $curso;

                return $this;
        }

        /**
         * Get the value of nota
         */ 
        public function getNota()
        {
                return $this->nota;
        }

        /**
         * Set the value of nota
         *
         * @return  self
         */ 
        public function setNota($nota)
        {
                $this->nota = $nota;

                return $this;
        }

        public function matricular(){
                $sql = "INSERT INTO `matricula` (`dni_alumno`, `curso`, `nota`) VALUES ('$this->dni_alumno', '$this->curso', NULL);";
                $rows = $this->db->query($sql);
                return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function desmatricular(){
                $sql = "DELETE FROM matricula WHERE dni_alumno = '$this->dni_alumno' and curso = '$this->curso'";
                $rows = $this->db->query($sql);
                return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function updateNota(){
            $sql = "UPDATE matricula SET nota = ".$this->nota." WHERE dni_alumno = '".$this->dni_alumno."' and curso = ".$this->curso."";
            $rows = $this->db->query($sql);
        }

        public function cursosNoMatriculado(){
            $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and codigo not in (SELECT curso FROM matricula WHERE dni_alumno = '".$this->dni_alumno."') and `fecha_inicio` > curdate() ORDER BY `fecha_inicio` ASC limit 0,4";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function cursosActivosByDni(){
                $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `cursos`.`fecha_final` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$this->dni_alumno."' and `cursos`.`activo` = 1 and `cursos`.`fecha_inicio` <= curdate() and `cursos`.`fecha_final` >= curdate()";
                $rows = $this->db->query($sql);
                return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function cursosProximosByDni(){
                $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `cursos`.`fecha_inicio` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$this->dni_alumno."' and `cursos`.`activo` = 1 and `cursos`.`fecha_inicio` >= curdate() ";
                $rows = $this->db->query($sql);
                return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function cursosFinalizadosByDni(){
                $sql = "SELECT `matricula`.`curso`, `cursos`.`nombre`, `matricula`.`nota` FROM `cursos` INNER JOIN `matricula` ON `cursos`.`codigo` = `matricula`.`curso` WHERE `matricula`.`dni_alumno` LIKE '".$this->dni_alumno."' and `cursos`.`activo` = 1 and `cursos`.`fecha_final` <= curdate() ";
                $rows = $this->db->query($sql);
                return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function comprobarMatricula(){
            $sql = "SELECT * FROM matricula where dni_alumno = '$this->dni_alumno' and curso = '$this->curso'";
            $rows = $this->db->query($sql);
            if($rows->rowCount() == 0){
                return false;
            }else{
                return true;
            }
        }

        public function cursosDisponibles(){
            $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and codigo not in (SELECT curso FROM matricula WHERE dni_alumno = '".$this->dni_alumno."') and `fecha_inicio` > curdate() ORDER BY `fecha_inicio` ASC";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

    }



?>