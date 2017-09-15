<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

        <link rel="stylesheet" href="css/normalize.min.css">


        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>

      <header>
        <h1>Beauty Nature</h1>
        <h2>-Le blog au naturel-</h2>
      </header>

        <h3>Les Derniers Billets:</h3>
<!--Debut de la row pour les articles-->
        <div class="container">
        <section class="row">

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

      // requete mysql:On récupère les 5 derniers billets
      $req = $bdd->query('SELECT id, image, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

//affichage resultat de la requete//
      while ($donnees = $req->fetch())
      {
      ?>

      <article class=" col-12 col-md-6 col-lg-4">
      <figure class="card news" style="width: 20rem;">
        <img class="card-img-top w-75 p-3" src="<?php echo ($donnees['image']);?>" alt="Card image cap">
        <div class="card-block">
          <h4 class="card-title"><?php echo htmlspecialchars($donnees['titre']); ?></h4>
          <em>le <?php echo $donnees['date_creation_fr']; ?> </em><br><br>
          <p class="card-text"><?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?></p>
          <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>" class="btn ">Lire la suite</a>
        </div>
      </figure>
    </article>

      <?php
      } // Fin de la boucle des billets
      $req->closeCursor();
      ?>
    </section>
  </div>
<!--Fin de la row des articles-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
