<?
error_reporting(0);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;
$rol = isset($_SESSION['id_roles']) ? $_SESSION['id_roles'] : null ;
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
    <?php
    include "include_css.php";
    include "funciones.php";
    ?>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!--Inicio Archivos para bootstrap file input -->

    <link href="../../externo/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../externo/plugins/fileinput/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <?
    include "include_js.php";
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/purify.min.js"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/piexif.js"></script>
    <script src="../../externo/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/themes/explorer/theme.js" type="text/javascript"></script>
    <script src="../../externo/plugins/fileinput/js/locales/es.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <!--FIN Archivos para bootstrap file input -->


</head>
<!-- END HEAD -->
<body class=" login">
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form role="form" enctype="multipart/form-data" action="fotos_sitio.php" class="form-horizontal">
        <div class="form-body">
            <div class="form-group">
                <h3 class="block bold" style="color: #520d9b">FOTOS DEL SITIO</h3>
                <input id="fotos" name="fotos[]"  type="file" accept="image/*" multiple>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">

                    <button href="javascript:;" class="btn green button-submit" name="btn1" value="registrar"> Registrar
                        <i class="fa fa-check"></i>
                    </button>
                    <input type="hidden" id="formulario" name="formulario" value="Registrar"/>

                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $("#test-upload").fileinput({
                'showPreview': false,
                'allowedFileExtensions': ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'JPG', 'JPEG', 'GIF', 'PNG', 'BMP'],
                'elErrorContainer': '#errorBlock'
            });
            $("#fotos").fileinput({
                language: 'es',
                'theme': 'explorer',
                'uploadUrl': 'actualiza_fotos_sitio.php',
                uploadAsync: false,
                minFileCount: 1,
                maxFileCount: 6,
                showUpload: true,
                showRemove: false,
                maxImageWidth: 600,
                resizeImage: true,
                overwriteInitial: false,
                initialPreviewAsData: true,
                browseOnZoneClick: true,
                purifyHtml: true,
            });
        });
    </script>

    <div class="row">
    </div>
    <!-- END FORM FOTOS SITIO -->
    <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
</body>

</html>