<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>
		<?php 
		    if(file_exists('actions/'.$_SESSION['action'].'/titre.php')){
		                require('actions/'.$_SESSION['action'].'/titre.php');
		                }else{
		                    require('actions/titre/controller.php');
		                    } 
		    if(isset($nomSite) && $nomSite != NULL){echo($nomSite);}
		?>
	</title>
	
    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />    
	<link rel="shortcut icon" href="favicon.ico" />
    
	<!-- JavaScript -->
    <script type="text/javascript" src="js/jquerymin.js"></script> 
	<script type="text/javascript" src="js/jqueryuimin.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
	
<!--[if lt IE 9]>
	<div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 100px; position: relative;'>
		<div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'><a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice'/></a></div>
		<div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>
			<div style='width: 75px; float: left;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-warning.jpg' alt='Warning!'/></div>
			<div style='width: 275px; float: left; font-family: Arial, sans-serif;'>
			<div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>Vous utilisez un navigateur d&eacute;pass&eacute;.</div>
			<div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>Pour une meilleure exp&eacute;rience web, prenez le temps de mettre votre navigateur &agrave; jour.</div>
			</div>
			<div style='width: 75px; float: left;'><a href='http://fr.www.mozilla.com/fr/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5'/></a></div>
			<div style='width: 75px; float: left;'><a href='http://www.microsoft.com/downloads/details.aspx?FamilyID=341c2ad5-8c3d-4347-8c03-08cdecd8852b&DisplayLang=fr' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8'/></a></div>
			<div style='width: 73px; float: left;'><a href='http://www.apple.com/fr/safari/download/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4'/></a></div>
			<div style='float: left;'><a href='http://www.google.com/chrome?hl=fr' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome'/></a></div>
		</div>
	</div>
<![endif]-->
	
</head>

<body class="<?php echo classBody(); ?>">

<?php include('actions/header/controller.php'); ?>

<!-- start of wrapper -->
<div id="wrapper">
    <div id="main">
	
		<?php echo $resultatAction ; ?>
		
	</div>

	<?php include('actions/footer/controller.php'); ?>
    
</div> 
<!-- end of wrapper -->
<div id="autocomplete"></div>
</body>
</html>
