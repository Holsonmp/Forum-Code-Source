<?php
//Cette fonction doit être appelée avant tout code html
session_start();
//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
$titre = "Forum";
include("includes/header.php");
?>
<?php 
	echo'<i>Vous êtes ici : </i><a href ="./index.php">Accueil</a>-->Forum';
?>
<div class="container">
	<div class="col-xs-4 col-sm-3 col-md-2">
		<img src="images/forum_logo.png" alt="forum logo" class="img-rounded">
	</div>
	<h1>Vous êtes sur notre Forum</h1>
	
	<?php
	//Initialisation de deux variables
		$totaldesmessages = 0;
		$categorie = NULL;
	?>
	<?php
	//Cette requête permet d'obtenir tout sur le forum
		$query=$db->prepare('SELECT cat_id, cat_nom, forum_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic, auth_view, forum_topic.topic_id, forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, membre_id FROM forum_categorie LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur WHERE auth_view <= :lvl ORDER BY cat_ordre, forum_ordre DESC');
		$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
		$query->execute();
	?>

<table class="table table-bordered table-striped table-condensed table-responsive wrapper style2">
	<?php
	//Début de la boucle
	while($data = $query->fetch())
	{
		//On affiche chaque catégorie
		if( $categorie != $data['cat_id'] )
			{
				//Si c'est une nouvelle catégorie on l'affiche
				$categorie = $data['cat_id'];
	?>
				<tr class="success">
					<th></th>
					<th class="titre"><strong><?php echo stripslashes(htmlspecialchars($data['cat_nom'])); ?></strong></th>
					<th class="nombremessages"><strong>Sujets</strong></th>
					<th class="nombresujets"><strong>Messages</strong></th>
					<th class="derniermessage"><strong>Dernier message</strong></th>
				</tr>
			<?php
			} //Ici, on met le contenu de chaque catégorie
			?>
			<?php
				if (verif_auth($data['auth_view']))
				{
			?>
			<?php
					// Ce super echo de la mort affiche tous
					// les forums en détail : description, nombre de réponses etc...
					echo'
					<tr>
						<td><img src="./images/message.png" alt="message" /></td>
						<td class="table table-title"><strong><a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong><br />'.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</td>
						<td class="nombresujets">'.$data['forum_topic'].'</td>
						<td class="nombremessages">'.$data['forum_post'].'</td>';
					// Deux cas possibles :
					// Soit il y a un nouveau message, soit le forum est vide
					if (!empty($data['forum_post']))
						{
							//Selection dernier message
							$nombreDeMessagesParPage = 15;
							$nbr_post = $data['topic_post'] +1;
							$page = ceil($nbr_post / $nombreDeMessagesParPage);
							echo'<td class="derniermessage">'.date('H\hi \l\e d/M/Y',$data['post_time']).'<br />
<a href="./voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.'</a>
<a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'<img src="./images/go.gif" alt="go" /></a></td></tr>';
						}
					else
					{
						echo'<td class="nombremessages">Pas de message</td></tr>';
					} //Cette variable stock le nombre de messages, on la met à jour
				} //Cette variable stock le nombre de messages, on la met à jour
					$totaldesmessages += $data['forum_post'];
		//On ferme notre boucle et nos balises
	} //fin de la boucle
$query->CloseCursor();
echo '</table></div>';
?>

<?php include("includes/footer.php");?>