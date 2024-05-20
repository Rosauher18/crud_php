<?php
class Conexion{
    public $con;

    public function conectar(){
        // Establecer la conexión y asignarla a $this->con
        $this->con = mysqli_connect("localhost", "root", "", "banco");

        // Verificar si hay errores al conectar
        if (mysqli_connect_errno()) {
            // Si hay errores, imprimir mensaje de error
            echo "Error al conectar a la base de datos: " . mysqli_connect_error();
            // Finalizar el script para evitar más procesamiento
            exit();
        }
    }
}
?>