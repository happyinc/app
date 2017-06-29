<?
if(isset($_POST['formulario']) && $_POST['formulario'] == "f")
					{
						if( isset($_POST['email']) && $_POST['email'] != "")
						{
							$tmp = "funciono";
							return $tmp;
						}
						else
						{
							$tmp = "sin email";
							return $tmp;

						}
					}



$tmp = "sin email";
							return $tmp;

?>