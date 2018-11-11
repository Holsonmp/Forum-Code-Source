<?php
if (isset ($_COOKIE['pseudo']) && empty($id))
{
	$_SESSION['pseudo'] = $_COOKIE['pseudo']; 
	/* On créé la variable de session à partir du cookie pour ne pas avoir à vérifier 2 fois sur les pages qu'un membre est connecté. */
}if (isset ($_COOKIE['pseudo']) && !empty($id))
{
	//On est connecté
}
if (!isset ($_COOKIE['pseudo']) && empty($id))
{
	//On n'est pas connecté
} 
//Création des variables
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<?php
		if (!empty($titre))
			{
				echo '<title> '.$titre.' </title>';
			}
		else 
			{
				echo '<title> Group HPA </title>';
			}
		?>
		<?php
		$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
		$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
		$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
		include("./includes/functions.php");
		include("./includes/constants.php");
		include("./includes/identifiants.php");
		$ip = ip2long($_SERVER['REMOTE_ADDR']);
		//Requête
		$query=$db->prepare('INSERT INTO forum_whosonline VALUES(:id, :time,:ip) ON DUPLICATE KEY UPDATE online_time = :time , online_id = :id');
		$query->bindValue(':id',$id,PDO::PARAM_INT);
		$query->bindValue(':time',time(), PDO::PARAM_INT);
		$query->bindValue(':ip', $ip, PDO::PARAM_INT);
		$query->execute();
		$query->CloseCursor();
		$time_max = time() - (60 * 5);
		$query=$db->prepare('DELETE FROM forum_whosonline WHERE online_time < :timemax');
		$query->bindValue(':timemax',$time_max, PDO::PARAM_INT);
		$query->execute();
		$query->CloseCursor();
?>
		<?php 
		$query = $db->query('SELECT * FROM forum_config');
		$config = array();
		while($data=$query->fetch())
		{
			$config[$data['config_nom']] = $data['config_valeur'];
		}
		$query->CloseCursor();?>
		<?php
			$balises=(isset($balises))?$balises:0;
			if($balises)
			{
		?>	<script>
					function bbcode(bbdebut, bbfin)
						{
							var input = window.document.formulaire.message;
							input.focus();
							if(typeof document.selection != 'undefined')
								{
									var range = document.selection.createRange();
									var insText = range.text;
									range.text = bbdebut + insText + bbfin;
									range = document.selection.createRange();
									if (insText.length == 0)
										{
											range.move('character', -bbfin.length);
										}
									else
										{
											range.moveStart('character', bbdebut.length + insText.length + bbfin.length);
										}
										range.select();
								}
							else if(typeof input.selectionStart != 'undefined')
						}
						{
							var start = input.selectionStart;
							var end = input.selectionEnd;
							var insText = input.value.substring(start, end);
							input.value = input.value.substr(0, start) + bbdebut + insText + bbfin + input.value.substr(end);
							var pos;
							if (insText.length == 0)
								{
									pos = start + bbdebut.length;
								}
							else
								{
									pos = start + bbdebut.length + insText.length + bbfin.length; 
								}input.selectionStart = pos;
								input.selectionEnd = pos;
						} 
							else
							{
								var pos;
								var re = new RegExp('^[0-9]{0,3}$');
								while(!re.test(pos))
									{
										pos = prompt("insertion (0.." + input.value.length + "):", "0");
									}
									if(pos > input.value.length)
										{
											pos = input.value.length;
										}
									var insText = prompt("Veuillez taper le texte");
										input.value = input.value.substr(0, pos) + bbdebut + insText + bbfin + input.value.substr(pos);
							}
						function smilies(img)
						{
							window.document.formulaire.message.value += '' + img + '';
						}
					</script>
			
			<?php 
			}
			?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="images/favicon.png">

		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/carousel.css" rel="stylesheet">
		<!-- Bootstrap theme -->
		<link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="theme.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="assets/js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
			#quote
			{
				width: 100%;
				background-color : rgb(220,220,220);
				margin-top: 2px;
				margin-bottom: 2px;
				font-family: "Comic sans MS", Arial, Verdana, serif;
			}
		</style>
	</head>
	 
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">
					<img src="images/logo.png" width="30%" id="logo" href="images/logo.png"/>
					<!-- Logo -->
	
					<!-- Nav -->
						<nav id="nav" >
							<ul>
								<li class="current"><a href="../index.php">Accueil</a></li>
								<li><a href="left-sidebar.html">Les articles</a></li>
								<li><a href="connexion.php">Connexion</a></li>
								<li><a href="register.php">Inscription</a></li>
								<li><a href="chat.php">Chat</a></li>
								<li><a href="pages/index.php">Info-Cours</a></li>
								<li><a href="forum.php">Forum</a></li>
								<li><a href="news.php">News</a></li>
							</ul>
						</nav>

				</div>

			<!-- Banner -->
	
				    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="./images/SSGP1716.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Bienvenu.</h1>
              <p>Note: Vous pouvez nous réjoindre sur facebook, par <code>http://</code> facebook.com, et vivez la globalité de l'informatique sur le HPA, Nous sommes là pour vous.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="./images/SSGP1713.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Nos Programmeurs et Analyses pourront vous aidez.</h1>
              <p>Vous avez un petit hic? Ne vous inquiété pas!! Nous avons une équipe solide pour résoudre vos problèmes dans plusieur domaine de la vie mais aussi le domaine informatique</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="./images/SSGP1715.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Un plus pour bonne mesure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
<!--Header-->