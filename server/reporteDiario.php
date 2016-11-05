<?php
include("conexion.php");

$destino = "markuzzz.2014@gmail.com";
$asunto = "Registro Diario";
$contenido = convertHTML(select("reporteDiario"));
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
mail($destino,$asunto,$contenido,$headers);

//CREATE VIEW reporteDiario AS SELECT Nombre, Facebook, Celular, Operador, Distrito, Precio FROM Usuario WHERE DATE(Fecha)=DATE(CURDATE()) AND Estado = 1 
function convertHTML($json){

    $data =  json_decode($json);
    $str = "";
    if (count($data)) {
        // Open the table
    	
        $str .= "<table border=1>";
        $str .= "<th> Nombre </th>";
        $str .= "<th> Facebook </th>";
        $str .= "<th> Celular </th>";
        $str .= "<th> Operador </th>";
        $str .= "<th> Distrito </th>";
        $str .= "<th> Precio </th>";
        // Cycle through the array
        foreach ($data as $idx => $stand) {

            // Output a row
            $str .= "<tr>";
            $str .= "<td>$stand->Nombre</td>";
            $str .= "<td>$stand->Facebook</td>";
            $str .= "<td>$stand->Celular</td>";
            $str .= "<td>$stand->Operador</td>";
            $str .= "<td>$stand->Distrito</td>";
            $str .= "<td>$stand->Precio</td>";
            $str .= "</tr>";
        }

        // Close the table
        $str .= "</table>";
    }

    return $str;
}


?>