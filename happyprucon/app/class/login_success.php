<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'sessions.php';
include'../../externo/plugins/PDOModel.php';
$objSe = new Sessions();

	   
$objSe->init();
if($kitse=isset($_SESSION['login_via']['status']))
{
	if($kitse=='Phone'){ 			
		
		 $cell = $_SESSION['phone']['national_number'];	
		 
			$objConn = new PDOModel(); 
			$objConn->columns = array("count(*)");
			$objConn->where("telefono",$cell);
			$result =  $objConn->select("usuarios");
				
				if($result[0]['count(*)'] == 1){
					
				}
	}
	else if($kitse =='Email')
	{
		 $correo = $_SESSION['email']['address'];		
		  
	}
}

?>