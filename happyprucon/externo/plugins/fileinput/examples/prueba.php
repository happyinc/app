<!DOCTYPE html>
<?
error_reporting(0);
?>
<!-- release v4.4.3, copyright 2014 - 2017 Kartik Visweswaran -->
<!--suppress JSUnresolvedLibraryURL -->
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Krajee JQuery Plugins - &copy; Kartik</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="../themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../js/fileinput.js" type="text/javascript"></script>
    <script src="../js/locales/fr.js" type="text/javascript"></script>
    <script src="../js/locales/es.js" type="text/javascript"></script>
    <script src="../themes/explorer/theme.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
	<?
				$archivos = "";
				$directorio = "../../../../app/src/usuarios/130/sitio";
				if (file_exists($directorio)) 
                {
					$direct=opendir($directorio);  
					while ($archivo = readdir($direct))
					{
						if($archivo=='.' or $archivo=='..')
						{

						}
						else 
						{
							$rut = $directorio."/".$archivo;
							$archivos .= "'".$rut."',";                                                                         	
						}
					}
					closedir($directorio);				
				}				
			
	?>
</head>
<body>
<div class="container kv-main">
    <div class="page-header">
        <h1>Actualizar Fotos
        </h1>
    </div>
    <form enctype="multipart/form-data">
        <input id="kv-explorer" type="file" multiple>
    </form>
    
</div>
</body>
<script>
    $(document).ready(function () {
        $("#test-upload").fileinput({
            'showPreview': false,
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
            'elErrorContainer': '#errorBlock'
        });
        $("#kv-explorer").fileinput({
            'theme': 'explorer',
            'uploadUrl': '#',
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: [
                <? echo $archivos ?>
            ],
            initialPreviewConfig: [
            ]
        });
    });
</script>
</html>