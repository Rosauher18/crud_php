<?php
include_once "/xampp/htdocs/crud_php/cliente.php";

//CREATE
/*
$cliente = new Cliente();
$cliente->correo ="lomast@gmail.com";
$cliente->nombre = "locas";
$cliente->edad=29;
$cliente->create();*/


//UPDATE 
/*
$cliente = Cliente::getByEmail("lomast@gmail.com");

if ($cliente !== null) {
    $cliente->edad =89;
    $cliente->update();
} else {
    // Manejar el caso en que el cliente no fue encontrado
    echo "El cliente no fue encontrado.";
}*/

//DELETE 
$cliente =Cliente::getByEmail("lomast@gmail.com");
$cliente->delete();

 //READ 
 $clientes = cliente::all();
?>
<table>
<thead>
    <tr>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Edad</th>
    </tr>
</thead>
<tbody>
    <?php foreach($clientes as $cliente){?>
    <tr>
        <td><?php echo $cliente->correo;?></td>
        <td><?php echo $cliente->nombre;?></td>
        <td><?php echo $cliente->edad;?></td>
    </tr>
    <?php }?>
</tbody>
</table>



 






