<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'simplon2017');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Inscription des commentaires en bd et requête préparée
$req = $bdd->prepare('INSERT INTO commentaires(id_billet,auteur,commentaire,date_commentaire) VALUES(?,?,?,NOW())') or die(print_r($bdd->getMessage()));
$req->execute(array($_POST['billet'],$_POST['auteur'],$_POST['commentaire']));

header('Location:commentaires.php?billet=' .$_POST['billet']);
