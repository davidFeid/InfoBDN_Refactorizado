<?php
    // Llamamos al fichero database.php
    require_once("database.php");
    // Hacemos que esta class sea hija de Database para poder heredar la conexión.
    class Profesor extends Database{
        private $dni;
        private $nombre;
        private $apellido;
        private $titulo_academico;
        private $foto;
        private $contraseña;
        private $activo;


        /**
         * Get the value of dni
         */ 
        public function getDni()
        {
                return $this->dni;
        }

        /**
         * Set the value of dni
         *
         * @return  self
         */ 
        public function setDni($dni)
        {
                $this->dni = $dni;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

                return $this;
        }

        /**
         * Get the value of titulo_academico
         */ 
        public function getTitulo_academico()
        {
                return $this->titulo_academico;
        }

        /**
         * Set the value of titulo_academico
         *
         * @return  self
         */ 
        public function setTitulo_academico($titulo_academico)
        {
                $this->titulo_academico = $titulo_academico;

                return $this;
        }

        /**
         * Get the value of foto
         */ 
        public function getFoto()
        {
                return $this->foto;
        }

        /**
         * Set the value of foto
         *
         * @return  self
         */ 
        public function setFoto($foto)
        {
                $this->foto = $foto;

                return $this;
        }

        /**
         * Get the value of contraseña
         */ 
        public function getContraseña()
        {
                return $this->contraseña;
        }

        /**
         * Set the value of contraseña
         *
         * @return  self
         */ 
        public function setContraseña($contraseña)
        {
                $this->contraseña = $contraseña;

                return $this;
        }

        /**
         * Get the value of activo
         */ 
        public function getActivo()
        {
                return $this->activo;
        }

        /**
         * Set the value of activo
         *
         * @return  self
         */ 
        public function setActivo($activo)
        {
                $this->activo = $activo;

                return $this;
        }

        public function listadoProfesores(){
            $sql = "SELECT * FROM profesores";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function validarDni(){
            $sql = "SELECT * FROM profesores where dni = '".$this->dni."'";
            $rows = $this->db->query($sql);
            if($rows->rowCount() == 0){
                return true;
            }else{
                return false;
            }
        }

        public function insertar(){
            $sql = "INSERT INTO `profesores` (`dni`, `nombre`, `apellido`, `titulo_academico`, `foto`, `contraseña`, `activo`) VALUES ('$this->dni', '$this->nombre', '$this->apellido', '$this->titulo_academico', '$this->foto', '".md5($this->contraseña)."', '0');";
            $rows = $this->db->query($sql);
        }

        public function obtenerByDni(){
            $sql = "SELECT * FROM profesores WHERE dni = '$this->dni'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function editar(){
            $sql = "UPDATE `profesores` SET `nombre` = '$this->nombre', `apellido` = '$this->apellido', `titulo_academico` = '$this->titulo_academico' WHERE `profesores`.`dni` = '$this->dni';";
            $rows = $this->db->query($sql);
        }

        public function editarEstado(){
            $sql = "UPDATE `profesores` SET `activo` = '$this->activo' WHERE dni = '$this->dni'";
            $this->db->query($sql);
        }

        public function editarFoto(){
            $sql = "UPDATE profesores SET foto = '".$this->foto."' WHERE dni = '".$this->dni."'";
            $this->db->query($sql);
        }

        public function loginProfesor(){
            $sql = "SELECT * FROM profesores WHERE dni = '$this->dni' and contraseña = '".md5($this->contraseña)."' and activo = 1";
            $rows = $this->db->query($sql);
            return ($rows->rowCount() == 0) ? false : true;
        }

        public function cursosEvaluar(){
            $sql = "SELECT * FROM `cursos` WHERE `activo` = 1  and `profesor` = '$this->dni' and `fecha_final` < curdate() ORDER BY `fecha_inicio`";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

    }

?>