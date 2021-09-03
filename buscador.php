<?php
require("conexion.php");

echo '<a href="buscador.html">BUSCADOR</a> &emsp; <a href="formulario.html">FORMULARIO</a><br><br>';

if(isset($_POST["fecha"]))
{
    $res=mysqli_query($conexion,"SELECT * FROM informes WHERE fecha > '".$_POST["fecha"]." 00:00:00' and fecha < '".$_POST["fecha"]." 23:59:59'");
    while ($registro=mysqli_fetch_assoc($res)){
        echo '<a href="'.$registro["nombre"].'">'.$registro["nombre"].'</a><br><br>';
    }
}
else{
    $res=mysqli_query($conexion,"SELECT * FROM informes");
    while ($registro=mysqli_fetch_assoc($res)){
        echo '<a href="'.$registro["nombre"].'">'.$registro["nombre"].'</a><br><br>';
        
    }
}
?>