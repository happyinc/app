<?php
require_once'../externo/plugins/PDOModel.php';
require'../app/class/sessions.php';
$objSe = new Sessions();
		
				$app = $_POST['txtkey'];
				$apk = md5($app);

				$mydate = getdate(date("U"));

					  $day = "";
						$lon = strlen($mydate["mday"]);
						if ($lon == 1) {
							$day = "0" . $mydate["mday"];
						} else {
							$day = $mydate["mday"];
						}

						$key = "H*2017*" . $day;
						$api_key = md5($key);
			
				$username = $_POST['usern'];
				$password = $_POST['passwd'];

				if($apk == $api_key){
				
					if(isset($_POST['form_login']) && $_POST['form_login'] == "W")
					{

						//verificación de campos vacios	
						if( isset($_POST['usern']) && $_POST['usern'] != "" && isset($_POST['passwd']) && $_POST['passwd'] != "")
						{	
						
							$objConn = new PDOModel(); 
							$objConn->columns = array("count(*)");
							$objConn->where("correo",$username);
							$result =  $objConn->select("usuarios");
							
							if($result[0]['count(*)'] == 1){
								
								$objConn->where("correo",$username);
								$res_usu =  $objConn->select("usuarios");

									$fullname = $res_usu[0]['nombre_completo'];
									$rol = $res_usu[0]['id_roles'];
									$usu_id = $res_usu[0]['id'];
								if($res_usu[0]["acceso_fallido"] <= 3){	
									
									//verificación de estado de usuario
									if($res_usu[0]["id_estado"]==1){
										
										$contra = md5($password);
										$id_usu = $res_usu[0]['id'];
										//comparación de contraseñas
										if($contra == $res_usu[0]['password']){

											$updateUser["ultimo_acceso"] = date("Y-m-d H:i:s");
											$objConn->where("id", $res_usu[0]['id']);
											$objConn->update("usuarios", $updateUser);		
												
										    $rol = $res_usu[0]['id_roles'];

												
												//Verificación de roles
												if($rol == 2)
												{
													$objConn = new PDOModel();
													$insertSe["id_usuario"] = $id_usu;
													$insertSe["origen"] = "W";
													$insertSe["f_login"] = date("Y-m-d H:i:s");
													$insertSe["estado"] = "A";
													$insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
													$objConn->insert("sesion", $insertSe);
													$ultima_sesion = $objConn->lastInsertId;
													
													$objSe->init();
													$objSe->set('sesion_activa',$ultima_sesion);
													$objSe->set('id_usuario', $res_usu[0]['id']);
													$objSe->set('id_roles', $res_usu[0]['id_roles']);
													$objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                                                    $objSe->set('nombre', $res_usu[0]['nombre']);
                                                    $objSe->set('apellido', $res_usu[0]['apellido']);
                                                    $objSe->set('genero', $res_usu[0]['genero']);
                                                    $objSe->set('telefono', $res_usu[0]['telefono']);
                                                    $objSe->set('correo', $res_usu[0]['correo']);
                                                    $objSe->set('origen',$_POST['form_login']);

																									
													echo "<script> window.location.assign('../app/src/index.php'); </script>";
												}
												else if($rol == 3)
												{
                                                    $objConn = new PDOModel();
                                                    $insertSe["id_usuario"] = $id_usu;
                                                    $insertSe["origen"] = "W";
                                                    $insertSe["f_login"] = date("Y-m-d H:i:s");
                                                    $insertSe["estado"] = "A";
                                                    $insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
                                                    $objConn->insert("sesion", $insertSe);
                                                    $ultima_sesion = $objConn->lastInsertId;

                                                    $objSe->init();
                                                    $objSe->set('sesion_activa',$ultima_sesion);
                                                    $objSe->set('id_usuario', $res_usu[0]['id']);
                                                    $objSe->set('id_roles', $res_usu[0]['id_roles']);
                                                    $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                                                    $objSe->set('nombre', $res_usu[0]['nombre']);
                                                    $objSe->set('apellido', $res_usu[0]['apellido']);
                                                    $objSe->set('genero', $res_usu[0]['genero']);
                                                    $objSe->set('telefono', $res_usu[0]['telefono']);
                                                    $objSe->set('correo', $res_usu[0]['correo']);
                                                    $objSe->set('origen',$_POST['form_login']);

                                                    echo "<script> window.location.assign('../app/src/index.php'); </script>";
												}
										}else{
											$fallo = $res_usu[0]["acceso_fallido"]+1;

											$updateUser["acceso_fallido"] = $fallo;
											$objConn->where("id", $res_usu[0]['id']);
											$objConn->update("usuarios", $updateUser);
											
											$insertSe["id_usuario"] = $id_usu;
											$insertSe["origen"] = "W";
											$insertSe["f_login"] = date("Y-m-d H:i:s");
											$insertSe["f_logout"] = date("Y-m-d H:i:s");
											$insertSe["estado"] = "X";
											$insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
											$objConn->insert("sesion", $insertSe);	
											echo "<script> alert('La contraseña no es valida, intentos fallidos # $fallo');
											window.location.assign('../app/src/logueo.html');</script>";
											}
									}else{
										echo "<script> alert('Usuario inactivo');
										window.location.assign('../app/src/logueo.html');</script>";
									}		
								}else{
									echo "<script> alert('Por favor contacte al administrador');
									window.location.assign('../app/src/logueo.html');</script>";
								}
							}else{
								echo "<script> alert('Correo invalido');
								window.location.assign('../app/src/logueo.html');</script>";		
							}
						}
						else if( isset($_POST['usern']) && $_POST['usern'] == "" || isset($_POST['passwd']) && $_POST['passwd'] == "")
							{
								echo "<script> alert('Faltan campos por diligenciar');
								window.location.assign('../app/src/logueo.html');</script>";
							}

					}

				}else
				{
					echo "<script> alert('Error: no tienes acceso al api');
							window.location.assign('../app/src/logueo.html');</script>";
				}
				
?>		