<?php
//incluyend la libreria de nusopa
require_once('lib/nusoap.php');
//including the database connection file
include_once("config.php");


$server= new soap_server();
$server->configureWSDL("SaludoXML","urn:SaludoXMLwsdl");
$server->wsdl->schemaTargetNamespace=("urn:SaludoXMLwsdl");

function Saludar($nombre){
    return '... and the new rockstar of web pages course is :'.trim($nombre);
}
function obtenerdatos($id)
{
    $sql = "SELECT * FROM tb_solicitud WHERE id =".$id;
    $result = $dbConn->query("SELECT * FROM usuarios ORDER BY id ASC ");

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$resul= "<td>".$row['nombre']."</td>";
    }
    return $resul;
}
//registrando nuestra funcion saludar con su parametro nombre
$server->register(
    'Saludar', //nombre del metodo
    array('nombre'=>'xsd:string'),//parametros de entrada
    array('return'=>'xsd:string'),//parametros de salida
    'urn:SaludoXMLwsdl',//nombre del workspace
    'urn:SaludoXMLwsdl#Saludar',//Accion soap
    'rpc',//estilo
    'encoded',//uso
    'Saluda a la persona'//
);
if(!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA=file_get_contents('php://input');

$server->service($HTTP_RAW_POST_DATA);
?>