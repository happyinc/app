<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Logueo</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #2 for " name="description" />
        <meta content="" name="author" />
		<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
        <script src="https://sdk.accountkit.com/es_LA/sdk.js"></script>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="main.js"></script>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
		<link href="../../externo/plugins/bootstrap-social-gh-pages/bootstrap-social.css" rel="stylesheet" type="text/css" />
        <link href="../assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/hhmain.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
		</head>
    <!-- END HEAD -->
	
    <body class=" login" style="background-color: white !important;">
        <!-- BEGIN LOGIN -->
        <div class="content centrado-porcentual" style="padding: 0 !important;">
			<div align="center" style="padding-bottom: 10px"><a href="logueo.html">
                    <img src="../../externo/img/logo-default.png" width="230px" alt="" /> </a>
                </div>
            <!-- BEGIN LOGIN FORM -->
            <form name="form-face" id="form-face" action="../../seguridad/verificarf.php" method="post">
                <div style="padding-bottom: 50px">
                    <h4>
                        <p class="font-grey-gallery bold">
                            Lo que quieres con lo que tienes
                        </p>
                    </h4>
                </div>
                <div class="row">

                    <!--Campos escondidos para envio de datos de facebook -->
                    <input type="hidden" id="form_login_face" name="form_login_face" value="W">
                    <input type="hidden" name="nom-face" id="nom-face">
                    <input type="hidden" name="ape-face" id="ape-face">
                    <input type="hidden" name="mail" id="mail">
                    <div class="col-lg-12 col-md-12 col-xs-12" style="margin-bottom: 10px;">
                        <a href="sel_rol.php" class="btn btn-block btn-social btn-circle purple-studio" style="text-align: center; background-color: #5F059E; padding: 10px;" ><span class="fa fa-list"></span> REGISTRO MANUAL </a>
                    </div>

                    <?
                    $web = 1;
                    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                    if(stripos($ua,'android') !== false)
                    {
                        $web = 0;
                    }
                    
                    $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');

                    // iphone/ipod
                    if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
                    {
                        $web = 0;
                    }

                    if($web == 1)
                    {
                        ?>
                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-bottom: 10px; margin-top: 20px;">
                            <a href="#" type="submit" id="login" class="btn btn-block btn-social  btn-circle purple-studio" style="text-align: center; background-color: #5F059E; padding: 10px; " ><span class="fa fa-facebook"></span> REGISTRO CON FACEBOOK </a>
                        </div>
                        <script>
                            (function(d, s, id){
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) {return;}
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/es_ES/sdk.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));

                        </script>
                        <?
                    }
                    ?>
                    
                </div>
            </form>
            <?
            if($web == 1)
            {
                ?>
                    <div class="row">

                        <div class="social-icons">
                            <div class="col-lg-12 col-md-12 col-xs-12" style="margin-bottom: 10px">
                                <button onclick="loginWithEmail();" class="btn btn-block btn-social btn-circle purple-studio" style="text-align: center; background-color: #5F059E; padding: 10px;" ><span class="fa fa-envelope"></span> REGISTRO CON CORREO </button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12" style="margin-bottom: 10px">
                                <button onclick="loginWithSMS();" class="btn btn-block btn-social btn-circle purple-studio" style="text-align: center; background-color: #5F059E; padding: 10px;" ><span class="fa fa-tablet"></span> REGISTRO CON CELULAR </button>
                            </div>
                            <form id="accountkit_form" name="accountkit_form" action="../class/fb_api_response.php" method="POST" style="display: none;">
                                <input type="text" id="form_login_kit" name="form_login_kit" value="W">
                                <input type="text" id="code" name="code">
                                <input type="text" id="csrf_nonce" name="csrf_nonce">
                                <input type="submit" value="Submit" hidden>
                            </form>
                        </div>
                    </div>
                <?
            }
            ?>
            
            <form class="login-form" action="" method="post">
               	<div class="row" style="margin-top: 30px">
					<div class="col-lg-12 col-md-12 col-xs-12" style="text-align: center; margin-bottom: 20px">
                        <a href="logueo.html" id="forget-password" class="bold" style="color: #520d9b"> YA TENGO UNA CUENTA</a>
                    </div>
				</div>	
            </form>
			<!-- END LOGIN FORM -->
        </div>
        <!-- END LOGIN -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
		<script>
		  // initialize Account Kit with CSRF protection
		  AccountKit_OnInteractive = function(){
		  	console.log("{{csrf}}")
		    AccountKit.init(
		      {
		        
				appId:"128324841091354",
		        state:"{{csrf}}", 
		        version:"v1.1"
		      }
		    );
		  };

		  // login callback
		  function loginCallback(response) {
		    console.log(response);
		    if (response.status === "PARTIALLY_AUTHENTICATED") {
		      document.getElementById("code").value = response.code;
		      document.getElementById("csrf_nonce").value = response.state;
		      document.getElementById("accountkit_form").submit();
		    }
		    else if (response.status === "NOT_AUTHENTICATED") {
		      // handle authentication failure
			   console.log("NOT_AUTHENTICATED");
		    }
		    else if (response.status === "BAD_PARAMS") {
		      // handle bad parameters
			  console.log("BAD_PARAMS");
		    }
		  }

		  function loginWithSMS(){
		  	AccountKit.login("PHONE",{}, loginCallback);
		  }

		  function loginWithEmail(){
		  	AccountKit.login("EMAIL", {}, loginCallback);
		  }
		</script>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/icheck/icheck.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/pages/scripts/form-icheck.min.js" type="text/javascript"></script>
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/login.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>