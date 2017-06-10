<?php
include 'RegistroCambios.php';

 $registroCambios = new RegistroCambios();
  $request_body = file_get_contents('php://input');
 $data = json_decode($request_body,true);
 $registroCambios->RegistrarDetalleCambios($data   ); 

 

 	echo json_encode( array(
    "data" => [],
    "success" => false,
    "totalCount" =>0
));

 
?>