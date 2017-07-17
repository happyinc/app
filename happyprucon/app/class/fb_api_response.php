<?php 
   include 'sessions.php';
	$objSe = new Sessions();
	$objSe->init();
    $objSe->set('origen',$_POST['form_login_kit']);
    //error_reporting(E_ALL);	
	
	if(isset($_POST['code']))
	{
		$code = $_POST['code'];
		
		require('FacebookAccountKitApiResponse.php');			
		
		$obj = new FacebookAccountKitApiResponse($code);
		
		$get_authorize_token = $obj->getUserAccessTokenByAuthorizationCode();
		
		if($get_authorize_token['status']== true)
		{
			$obj->makeAppSecretProof();
		
			$user_info = $obj->getAccountKitAccountInfo();	
			
			if(isset($user_info->phone))
			{
								
				$_SESSION['phone']['id'] = $user_info->id;
				$_SESSION['phone']['phone_number'] = $user_info->phone->number;
				$_SESSION['phone']['country_prefix'] = $user_info->phone->country_prefix;
				$_SESSION['phone']['national_number'] = $user_info->phone->national_number;	
				$_SESSION['login_via']['status'] = "Phone";	
				
				header("Location: login_success.php");
			    exit;
								
			
					
			}
			else if(isset($user_info->email))
			{
								
				$_SESSION['email']['id'] = $user_info->email->id;
				$_SESSION['email']['address'] = $user_info->email->address;
				$_SESSION['login_via']['status'] = "Email";
				
				header("Location: login_success.php");
				exit();				
				
			}
			else{				
				
			}

			//print_r($_SESSION);				
			
		}
		else{			
			//print_r($get_authorize_token);
			
			$_SESSION['error']['status'] = true;
			$_SESSION['error']['message'] = $get_authorize_token['curl_result']->error->message;
			
			header("Location:  ../src/logueo.html", true, 301);
			exit();			
			
			//echo $get_authorize_token['curl_result']->error->message;
		}	
	}
	else
	{
		$_SESSION['error']['status'] = true;
		$_SESSION['error']['message'] = "Illegal Access this page!!!!";
		
		header("Location:  ../src/logueo.html", true, 301);
		exit();			
			
	}
?>