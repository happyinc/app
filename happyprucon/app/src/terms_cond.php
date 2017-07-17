<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';
$objSe = new Sessions();
?>
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
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<?php

$objSe->init();
$user_face = isset($_SESSION['nom-face']) ? $_SESSION['nom-face'] : null ;
$ape_face = isset($_SESSION['ape-face']) ? $_SESSION['ape-face'] : null ;
$mail_face = isset($_SESSION['mail']) ? $_SESSION['mail'] : null ;

$cell = $_SESSION['phone']['national_number'];

$correo = $_SESSION['email']['address'];

//variables recibidas del rol escogido
$rol_emp = $_POST['emprende'];
$objSe->set('emprende',$rol_emp);


$rol_cli = $_POST['cliente'];
$objSe->set('cliente',$rol_cli);

if($rol_emp == 2){

    $objConn = new PDOModel();
    $objConn->where("id",1);
    $res_usu =  $objConn->select("terminos_condiciones");

    $terminos = $res_usu[0]['descripcion'];
    $id_termino = $res_usu[0]['id'];

}else if($rol_cli == 3){

    $objConn = new PDOModel();
    $objConn->where("id",2);
    $res_usu =  $objConn->select("terminos_condiciones");

    $terminos = $res_usu[0]['descripcion'];
    $id_termino = $res_usu[0]['id'];

}





?>
<body class=" login">
<!-- BEGIN LOGIN -->
<div class="content">
    <div align="center" style="padding-bottom: 40px;"><a href="logueo.html">
            <img src="../../externo/img/logo-default.png" width="230px" alt="" /> </a>
    </div>
    <div class="login-form" method="post">
        <div class="row" style="padding-bottom: 20px;">
            <div class="form-group">
                <textarea name="terminos" id="terminos" class="form-control" rows="10" readonly><?php echo $terminos; ?> </textarea></div>
        </div>
    </div>
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="registro_emp.php" method="post">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3" style="margin-bottom: 10px"></div>
            <div class="col-lg-6 col-md-6 col-xs-6" style="margin-bottom: 10px">
                <input type="hidden" name="acepta" id="acepta" value="<?php echo $id_termino; ?>"/>
                <button type="submit"  class="btn btn-circle red-flamingo btn-block bold" > Aceptar </button>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3" style="margin-bottom: 10px"></div>
        </div>
    </form>

    <form name="empre" action="logueo.html" method="post">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-3" style="margin-bottom: 10px"></div>
            <div class="col-lg-6 col-md-6 col-xs-6" style="margin-bottom: 10px">
                <input type="hidden" name="cancela" id="cancela" value="0" />
                <button type="submit"  class="btn btn-circle purple-studio btn-block bold" > Cancelar </button>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3" style="margin-bottom: 10px"></div>

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