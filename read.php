<?php
include 'database.php';

// Obtenir la page via une requête GET (paramètre URL : page), si elle n'existe pas, la valeur par défaut de la page est 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Nombre d'enregistrements à afficher sur chaque page dans le tableau
$records_per_page = 5;

/*Préparer l'instruction SQL et récupérer les enregistrements de notre table contacts, 
LIMIT déterminera le nombre maximum d'éléments a affichr sur la page.*/

/** 
 * Pour comprendre les différentes étapes d'une requete en PHP
 * il faut se rendre sur le lien ci dessous pour consulter la documentation
 * https://www.php.net/manual/fr/pdo.prepared-statements.php
 * 
**/

$stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// fetchAll Récupére les enregistrements de la base de données afin de les afficher dans le tableau.
// lien de la documentation https://www.php.net/manual/fr/pdostatement.fetchall.php
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtenir le nombre total de contacts, afin de déterminer s'il doit y avoir un bouton « suivant » ou « précédent ».
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<title>Mon premier Mini projet PHP</title>
</head>

<body>
	<nav class="navtop">
		<div>
			<h1>Website Title</h1>
			<a href="index.php"><i class="fas fa-home"></i>Home</a>
			<a href="read.php"><i class="fas fa-address-book"></i>Contacts</a>
		</div>
	</nav>

    <div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Title</td>
                <td>Created</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['name']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['phone']?></td>
                <td><?=$contact['title']?></td>
                <td><?=$contact['created']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

</body>

</html>



