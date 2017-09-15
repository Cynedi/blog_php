<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	<link href="style.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/normalize.min.css">

    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    </head>

    <body>
      <header>
        <h1>Beauty Nature</h1>
        <h2>-Le blog au naturel-</h2>
      </header>

        <p><a id="retour" href="index.php">Retour à la liste des billets</a></p>

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

// Récupération du billet
$req = $bdd->prepare('SELECT id, image, titre, contenu_entier, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
$req->execute(array($_GET["billet"]));
$donnees = $req->fetch();

?>

<div class="news">
  <img src="<?php echo ($donnees['image']);?>" alt="image">
    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>

    <p>
    <?php
    echo nl2br(htmlspecialchars($donnees['contenu_entier']));
    ?>
    </p>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch())
{
?>
<div id="coment">
<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
</div>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>

<!--formulaire commentaires-->

<form id="com" action="commentaires_post.php" method="POST">
  <div class="form-group ">
  <label for="auteur">Nom:<br /> <input class="form-control" type="text" name="auteur" id="auteur"></label> <br />
  <label for="commentaire">Commentaire:</label> <br />
  <textarea name="commentaire" id="commentaire"></textarea>

  <input class="form-control" type="submit" name="Envoyer" value="Laisser un commentaire" id="Envoyer">

  <input class="form-control" type="hidden" name="billet" width="50px" value="<?php echo $_GET['billet'];?>">
</div>
</form>

</body>
</html>
