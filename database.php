<?php

/** 
 * Pour apprendre comment connecter sa base données avec son backend PHP
 * il faut se rendre sur le lien ci dessous pour consulter la documentation
 * https://www.php.net/manual/fr/pdo.connections.php 
 * 
**/

// Connexion avec la base de données 
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASSWORD = '';
$DATABASE_NAME = 'phpcrud';
try {
	// En cas de success ce code s'exécute
	$pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASSWORD);
} catch (PDOException $e) {
	// En cas d'erreur ce code s'exécute
	exit('Une erreur est survenue' . $e->getMessage());
}
