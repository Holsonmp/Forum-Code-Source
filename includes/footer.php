<!-- le footer du page -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="3u 6u(narrower) 12u$(mobilep)">
								<h3>Qui sommes-nous?</h3>
								<ul class="links">
									<li><a href="#">A propos</a></li>
									<li><a href="#">Nous contacter</a></li>
									<li><a href="#">Aide et service</a></li>
									<li><a href="#">Newsletters</a></li>
								</ul>
							</section>
							<section class="3u 6u$(narrower) 12u$(mobilep)">
								<h3>Infos légales</h3>
								<ul class="links">
									<li><a href="#">Conditions légales</a></li>
									<li><a href="#">Signaler un abus</a></li>
									<li><a href="#">Logitec</a></li>
									<li><a href="#">Devenir adm</a></li>
								</ul>
							</section>
							<section class="6u 12u(narrower)">
								<h3>Votre avis sur le site</h3>
								<form method="post" action="livredor.php">
									<div class="row 50%">
										<div class="6u 12u(mobilep)">
											<input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" />
										</div>
										<div class="6u 12u(mobilep)">
											<input type="email" name="email" id="email" placeholder="Votre e-mail" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="contenu" id="contenu" placeholder="Votre message" rows="5"></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" class="button alt" value="Envoyez" /></li>
											</ul>
										</div>
									</div>
								</form>								
							</section>
						</div>
						<?php//Initialisation de la variable
						$count_online = 0;
						//Décompte des visiteurs
						$count_visiteurs=$db->query('SELECT COUNT(*) AS nbr_visiteurs FROM forum_whosonline WHERE online_id = 0')->fetchColumn();
						$query->CloseCursor();
						//Décompte des membres
						$texte_a_afficher = "<br />Liste des personnes en ligne : ";
						$time_max = time() - (60 * 5);
						$query=$db->prepare('SELECT membre_id, membre_pseudo FROM forum_whosonline LEFT JOIN forum_membres ON online_id = membre_id WHERE online_time > :timemax AND online_id <> 0');
						$query->bindValue(':timemax',$time_max, PDO::PARAM_INT);
						$query->execute();
						$count_membres=0;
						while ($data = $query->fetch()) 
						{
							$count_membres ++;
							$texte_a_afficher .= '<a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a> ,';
						}
						$texte_a_afficher = substr($texte_a_afficher, 0, -1);
						$count_online = $count_visiteurs + $count_membres;
						echo '<p>Il y a '.$count_online.' connectés ('.$count_membres.' membres et '.$count_visiteurs.' invités)';
						echo $texte_a_afficher.'</p>';
						$query->CloseCursor();
						?>
						
					</div>

					<!-- Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">GitHub</span></a></li>
							<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Tous droits réservés</li><li>Group: <a href="http://hlone.comli.com">HPA</a></li>
							</ul>
						</div>

				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/docs.min.js"></script>
			<script src="assets/js/holder.min.js"></script>
			<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
			<script src="assets/js/affix.js"></script>
			<script src="assets/js/alert.js"></script>
			<script src="assets/js/button.js"></script>
			<script src="assets/js/carousel.js"></script>
			<script src="assets/js/collapse.js"></script>
			<script src="assets/js/dropdown.js"></script>
			<script src="assets/js/modal.js"></script>
			<script src="assets/js/popover.js"></script>
			<script src="assets/js/scrolspy.js"></script>
			<script src="assets/js/tab.js"></script>
			<script src="assets/js/tooltip.js"></script>
			<script src="assets/js/transition.js"></script>
			<script>
			$(function () {
			$('.js-popover').popover()
			$('.js-tooltip').tooltip()
			$('#tall-toggle').click(function () { 
			$('#tall').toggle()  })})
			</script>

	</body>
</html>