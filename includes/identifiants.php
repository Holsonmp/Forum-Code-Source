<?php
	try
	{
		$db = new PDO('mysql:host=localhost; dbname=grouphp', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
?>