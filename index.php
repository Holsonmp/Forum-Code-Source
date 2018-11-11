<?php
session_start();
$titre="Bienvenu sur hpa.cd";
?>
<?php include("includes/header.php");?>
<?php include("includes/identifiants.php");?>

			<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
					<p text-align="justify">Voici un site qui aborde les connaissances générales en informatique visant à préparer tout candidat au cursus des sciences informatique.<br/>
					L'informatique étant un domaine en perpétuelle et rapide évolution, ne soyez pas surpris de trouver, sur ce site, une connaissance quelconque en déphasage avec d'autre site déjà visité..</p>
						<div class="row 200%">
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<img src="images/logo.png" class="img-responsive" alt="Generic placeholder thumbnail"/>
									<h3>Cours de base</h3>
									<p>Pour un Bon début, nous devons connaître les bases de notre domaines qui est sans doute la technologie et l'informatique<br>Ici nous parlerons de l'informatique, les ordinateurs et l'internet</p>
									<a href="#" class="button">Lire</a>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-book"></i>
									<h3>Also Important</h3>
									<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-wrench"></i>
									<h3>Probably Important</h3>
									<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- Gigantic Heading -->
				<section class="wrapper style2">
					<div class="container">
						<header class="major">
							<h2>HPA Group</h2>
							<p>Est là pour vous aidez à trouver des réponses à vos questions sur l'informatique et aussi vous aidez à travailler </p>
						</header>
					</div>
				</section> 

			<!-- Posts -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.jpg" alt="" /></a>
									<div class="inner">
										<h3>The First Thing</h3>
										<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic02.jpg" alt="" /></a>
									<div class="inner">
										<h3>The Second Thing</h3>
										<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
									</div>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic03.jpg" alt="" /></a>
									<div class="inner">
										<h3>The Third Thing</h3>
										<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
									<div class="inner">
										<h3>The Fourth Thing</h3>
										<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
									</div>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- CTA -->
				<section id="cta" class="wrapper style2">
					<div class="container">
						<header>
						<?php
if (isset($_POST['login']) AND isset($_POST['pass']))
{
$login = $_POST['login'];
$pass_crypte = crypt($_POST['pass']); // On crypte le mot de passe
echo '<p>Ligne à copier dans le .htpasswd :<br />' . $login .
':' . $pass_crypte . '</p>';
} else // On n'a pas encore rempli le formulaire
{?>
<p>Entrez votre login et votre mot de passe pour le crypter.</p>
<form method="post">
<p>
Login : <input type="text" name="login"><br />
Mot de passe : <input type="text" name="pass"><br /><br />
<input type="submit" value="Crypter !">
</p>
</form>
<?php
}?>
						</header>
					</div>
				</section>
<?php include("includes/footer.php");?>