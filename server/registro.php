<?php
include("conexion.php");

if(isset($_GET['nuevoUsuario'])){
    
    $usuario = json_decode($_GET['nuevoUsuario']);
    echo insertarUsuario($usuario->{'Nombre'}, $usuario->{'Facebook'}, $usuario->{'Celular'}, $usuario->{'Operador'}, $usuario->{'Distrito'}, $usuario->{'Precio'});   
}

function insertarUsuario($nombre,$facebook,$celular,$operador,$distrito,$precio){

    $estadoFacebook = getFacebook($facebook);
    $estadoCelular = getCelular($celular);

    if($nombre=="" or $facebook=="" or $celular==0 or $operador=="" or $distrito=="" or $precio == 0){
        return 4;
    }
    
    $dbh = conectar();
    $sql = "INSERT INTO Usuario (Nombre, Facebook, Celular, Operador, Distrito, Precio) VALUES (:nom, :fac, :cel, :ope, :dist, :pre)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':nom'=>$nombre, ':fac'=>$facebook, ':cel'=>$celular, ':ope'=>$operador, ':dist'=>$distrito, ':pre'=>$precio));
    $dbh= null;

    $contenido = "\nNombre: " . $nombre . "\nFacebook: " . $facebook . "\nCelular: " . $celular . "\nOperador: " . $operador . "\nDistrito: " . $distrito . "\nPrecio: " . $precio ;
    
    enviarCorreo($contenido);
    return 1;
}

function enviarCorreo($contenido){
    $destino = "markuzzz.2014@gmail.com";
    $asunto = "registro de nuevo usuario";
    mail($destino,$asunto,$contenido);
}

function getFacebook($facebook){

    $sql = 'SELECT COUNT(*) as Cantidad FROM Usuario where Facebook = :fac';

    $dbh = conectar();
    $stmt = $dbh->prepare( $sql );
    $stmt->bindParam(':fac', $facebook , PDO::PARAM_STR); 
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC);
    $dbh= null;

    return  $result[0]["Cantidad"];

}

function getCelular($celular){

    $sql = 'SELECT COUNT(*) as Cantidad FROM Usuario where Celular = :cel';

    $dbh = conectar();
    $stmt = $dbh->prepare( $sql );
    $stmt->bindParam(':cel', $celular , PDO::PARAM_STR); 
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC);
    $dbh= null;

    return  $result[0]["Cantidad"];
}

?>

