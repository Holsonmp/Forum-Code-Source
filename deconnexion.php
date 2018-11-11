<?php
session_start();
if (isset ($_COOKIE['pseudo']))
{
	setcookie('pseudo', '', -1);
} 
session_destroy();
$titre="Déconnexion";
include("includes/header.php");
if ($id==0) erreur(ERR_IS_NOT_CO);
echo '<p>Vous êtes à présent déconnecté <br />
Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>';
?>
<?php include("./includes/footer.php");?>