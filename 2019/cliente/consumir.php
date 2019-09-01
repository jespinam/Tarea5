<?php
require_once('../lib/nusoap.php');
// direccion del WSDL URL del servidor cambiar por la ip o nombre del server
$wsdl = "http://localhost:8080/Tarea_DW/2019/servicio.php?wsdl";


$client = new nusoap_client($wsdl, 'wsdl');
$err = $client->getError();
if ($err) {

   echo '<h2>Error en la construccion</h2>' . $err;

   exit();
}

// Call the hello method
$result1=$client->call('obtenerdatos', array('nombre'=>'JESICA ESPINA'));
print_r($result1).'RESULTO BIEN!!!!!\n';
?>