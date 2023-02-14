<?php
    // Llamamos al fichero database.php
    require_once("database.php");
    // Hacemos que esta class sea hija de Database para poder heredar la conexión.
    class Curso extends Database{
        private $codigo;
        private $nombre;
        private $descripcion;
        private $horas;
        private $fecha_inicio;
        private $fecha_final;
        private $foto;
        private $profesor;
        private $activo;
 
        public function getCodigo()
        {
                return $this->codigo;
        }

        public function setCodigo($codigo)
        {
                $this->codigo = $codigo;
        }
 
        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }

        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
        }
 
        public function getHoras()
        {
                return $this->horas;
        }

        public function setHoras($horas)
        {
                $this->horas = $horas;
        }

        public function getFecha_inicio()
        {
                return $this->fecha_inicio;
        }
 
        public function setFecha_inicio($fecha_inicio)
        {
                $this->fecha_inicio = $fecha_inicio;
        }
 
        public function getFecha_final()
        {
                return $this->fecha_final;
        }

        public function setFecha_final($fecha_final)
        {
                $this->fecha_final = $fecha_final;
        }

        public function getFoto()
        {
                return $this->foto;
        }

        public function setFoto($foto)
        {
                $this->foto = $foto;
        }

        public function getProfesor()
        {
                return $this->profesor;
        }

        public function setProfesor($profesor)
        {
                $this->profesor = $profesor;
        }

        public function getActivo()
        {
                return $this->activo;
        }

        public function setActivo($activo)
        {
                $this->activo = $activo;
        }

        //Funcion para obtener un array de todos lo cursos
        public function listadoCursos(){
            $sql = "SELECT * FROM cursos";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        //Funcion para insertar curso en la base de datos
        public function insertar()
        {
            $sql = "INSERT INTO `cursos` (`codigo`, `nombre`, `descripcion`, `horas`, `fecha_inicio`, `fecha_final`, `foto`, `profesor`, `activo`) VALUES (NULL, '".$this->nombre."', '".$this->descripcion."', '".$this->horas."', '".$this->fecha_inicio."', '".$this->fecha_final."', '".$this->foto."', '".$this->profesor."', '0');";
            $rows = $this->db->query($sql);
        }

        public function obtenerByCodigo(){
            $sql = "SELECT * FROM cursos where codigo = '$this->codigo'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function editar(){
            $sql = "UPDATE `cursos` SET `nombre` = '".$this->nombre."', `descripcion` = '".$this->descripcion."', `horas` = '".$this->horas."', `fecha_inicio` = '".$this->fecha_inicio."', `fecha_final` = '".$this->fecha_final."', `profesor` = '".$this->profesor."' WHERE `cursos`.`codigo` = '$this->codigo'";
            $this->db->query($sql);
        }

        public function editarEstado(){
            $sql = "UPDATE `cursos` SET `activo` = '$this->activo' WHERE `cursos`.`codigo` = '$this->codigo'";
            $this->db->query($sql);
        }

        public function editarFoto(){
            $sql = "UPDATE cursos SET foto = '".$this->foto."' WHERE codigo = '".$this->codigo."'";
            $this->db->query($sql);
        }

        public function getAlumnosByCurso(){
            $sql = "SELECT alumnos.dni AS 'DNI_Alumno', alumnos.nombre AS 'Nombre_Alumno', cursos.nombre AS 'Nombre_Curso',matricula.nota AS 'Nota' FROM (alumnos INNER JOIN matricula ON alumnos.dni = matricula.dni_alumno) INNER JOIN cursos ON matricula.curso = cursos.codigo WHERE matricula.curso = '$this->codigo'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function getCursosByProfesor(){
            $sql = "SELECT * FROM cursos where profesor = '$this->profesor'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

        public function getDniProfesorByCurso(){
            $sql = "SELECT profesor FROM cursos WHERE codigo = '$this->codigo'";
            $rows = $this->db->query($sql);
            return $rows->fetchAll(PDO::FETCH_CLASS);
        }

}