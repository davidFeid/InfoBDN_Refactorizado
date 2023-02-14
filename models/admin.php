<?php
    // Llamamos al fichero database.php
    require_once("database.php");
    // Hacemos que esta class sea hija de Database para poder heredar la conexión.
    class Admin extends Database{
        private $dni;
        private $contraseña;

        //Generamos los set y get.
        public function getDni()
        {
            return $this->dni;
        }

        public function getContraseña()
        {
            return $this->contraseña;
        }

        public function setDni($dni)
        {
            $this->dni = $dni;
            return $this;
        }

        public function setContraseña($contraseña)
        {
            $this->contraseña = $contraseña;
            return $this;
        }

        // Creamos la función que tendrá que recoger el dni y la contraseña del formulario.
        function validar($dni, $contraseña){   
            // Consulta
            $sql = "SELECT * FROM administrador where dni='$dni' and contraseña= '$contraseña'";
            $rows = $this->db->query($sql);
            return  $rows->rowCount();
        }
    }

?>