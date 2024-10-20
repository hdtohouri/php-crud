<?php
include 'database.php';

$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone, $title, $created]);
    // Output message
    $msg = 'Ajout Effectué avec success';
}
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

    <div class="content update">
	<h2>Creer un Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Nom et prénom</label>

        <!--La value de ce champs ne peut pas etre modifié -->
        <input type="text" name="id" placeholder="26" value="auto" id="id" readonly>

        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Numero Telephone</label>

        <!--La value de ce champs ne peut pas etre modifié -->
        <input type="text" name="email" placeholder="Saisi votre email : johndoe@example.com" id="email">


        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Titre</label>
        <label for="created">Date Création</label>
        <input type="text" name="title" placeholder="Employé" id="title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

</body>

</html>



