<?php
    // Llamamos al fichero database.php
    require_once("database.php");
    // Hacemos que esta class sea hija de Database para poder heredar la conexión.
    class Alumno extends Database{
        private $dni;
        private $nombre;
        private $apellido;
        private $edad;
        private $foto;
        private $mail;
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
         * Get the value of edad
         */ 
        public function getEdad()
        {
                return $this->edad;
        }

        /**
         * Set the value of edad
         *
         * @return  self
         */ 
        public function setEdad($edad)
        {
                $this->edad = $edad;

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
         * Get the value of mail
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

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

        public function login(){
            $sql = "SELECT * FROM alumnos WHERE dni = '$this->dni' and contraseña = '".md5($this->contraseña)."' and activo = 1";
            $rows = $this->db->query($sql);
            if($rows->rowCount() == 0){
                return false;
            }else{
                return true;
            }
        }

        public function obtenerByDni(){
            $sql = "SELECT * FROM alumnos WHERE dni = '$this->dni'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function validarDni(){
            $sql = "SELECT * FROM profesores where dni = '".$this->dni."'";
            $rows = $this->db->query($sql);
            return ($rows->rowCount() == 0) ? true : false;
        }

        public function insertar(){
            $sql = "INSERT INTO `alumnos` (`dni`, `nombre`, `apellido`, `edad`, `foto`,`mail` , `contraseña`, `activo`) VALUES ('$this->dni', '$this->nombre', '$this->apellido', '$this->edad', '$this->foto', '$this->mail', '".md5($this->contraseña)."', '1');";
            $rows = $this->db->query($sql);
        }

    }

?>