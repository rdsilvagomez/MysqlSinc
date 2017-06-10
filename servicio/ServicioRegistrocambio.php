<?php
include 'RegistroCambios.php';
$objRegistro= new RegistroCambios(); 
echo json_encode($objRegistro->ObtenerRegistroCambios()); 
?>