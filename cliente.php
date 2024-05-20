<?php
include_once "/xampp/htdocs/crud_php/conexion.php";


class Cliente extends Conexion{
public $correo;
public $nombre;
public $edad;


// Método constructor para inicializar la conexión
public function __construct() {
    $this->conectar();
}


//Create
// Método para insertar un nuevo cliente
public function create() {
    // Verifica si la conexión está establecida
    if ($this->con) {
        // Preparar la consulta SQL
        $pre = mysqli_prepare($this->con, "INSERT INTO clientes(correo, nombre, edad) VALUES (?, ?, ?)");
        // Verificar si la preparación de la consulta fue exitosa
        if ($pre) {
            // Vincular parámetros y ejecutar la consulta
            mysqli_stmt_bind_param($pre, "ssi", $this->correo, $this->nombre, $this->edad);
            mysqli_stmt_execute($pre);
            // Verificar si la inserción fue exitosa
            if (mysqli_stmt_affected_rows($pre) > 0) {
                echo "Cliente creado exitosamente.";
            } else {
                echo "Error al crear el cliente.";
            }
            // Cerrar la sentencia preparada
            mysqli_stmt_close($pre);
        } else {
            echo "Error al preparar la consulta.";
        }
    } else {
        echo "Error: No se pudo establecer la conexión.";
    }
}
//UPDATE

public function update(){
    $this->conectar();
    $pre = mysqli_prepare($this->con, "UPDATE clientes SET nombre =?, edad=? WHERE correo=?");
    $pre->bind_param("sis", $this->nombre, $this->edad, $this->correo);
    $pre->execute();

}
//DELETE
public function delete(){
    $this->conectar();
    if ($this->con) {
        $pre= mysqli_prepare($this->con, "DELETE FROM clientes WHERE correo =?");
        if ($pre) {
            $pre->bind_param("s", $this->correo);
            $pre->execute();
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($this->con);
        }
    } else {
        echo "Error al conectar a la base de datos.";
    }
}
//read
public static function all(){
$conex= new Conexion();
$conex->conectar();
$pre = mysqli_prepare($conex->con, "SELECT * FROM clientes");
$pre->execute();
$res= $pre->get_result();
$clientes= [];

while($cliente = $res->fetch_object(Cliente::class))
  array_push($clientes, $cliente);
return $clientes;


}
//obtener un cliente por su correo 
public static function getByEmail($correo) {
    $cliente = new Cliente(); // Se utiliza la conexión existente
    $pre = mysqli_prepare($cliente->con, "SELECT * FROM clientes WHERE correo = ?");
    $pre->bind_param("s", $correo);
    $pre->execute();
    $res = $pre->get_result();

    return $res->fetch_object(Cliente::class);
}





}












?>