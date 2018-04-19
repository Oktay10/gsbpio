<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="util/cssGeneral.css">	
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
  <script src="vendor/jquery/jquery.min.js"></script>
     
</head>

<body>

<nav style="margin-top: -20px; padding: 10px; background: dimgray;" id="test" class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" ><img style="width: 100px; height: 60px; margin-left: -25px; margin-top: -20px" src="images/Logo.PNG"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
			    <li><p style="color: cyan; margin: 15px;"><?php if(isset($_SESSION['user'])){echo "<span class='glyphicon glyphicon-user'></span> Bonjour ".$_SESSION['user']."";}?><?php  if(isset($_SESSION['admin'])){echo "<span class='glyphicon glyphicon-user'></span> Bonjour Admin ".$_SESSION['admin']."";}?></p></li>	
				<li><a href="index.php?uc=accueil">Accueil</a></li>
				<?php if(isset($_SESSION['user'])){ ?><li><a href="index.php?uc=gestion&action=affichage">Liste des chiens inscrits</a></li><?php } ?>
				<?php if(isset($_SESSION['admin'])){ ?><li><a href="index.php?uc=gestion&action=affichage">Liste des chiens inscrits</a></li><?php } ?>
				<?php if(isset($_SESSION['admin'])){ ?><li><a href="index.php?uc=gestion&action=verification">Contact à valider</a></li><?php } ?>

				
				
              </ul>
              <ul class="nav navbar-nav navbar-right"> 
											<?php
											if(isset($_SESSION['user']) or isset($_SESSION["admin"]))
											{
												echo '<li><a href="index.php?uc=profil">Mon Profil</a></li>';
												echo '<li><a href="index.php?uc=inscription">Inscrire un chien</a></li>';
												echo '<li><a href="index.php?uc=deconnexion"><span class="glyphicon glyphicon-off"></span> Deconnexion</a></li>';
											}
											else
											{
												echo "<li><a href='index.php?uc=inscription&action=inscriptionUti'>Contact</a></li>";
												echo '<li><a href="index.php?uc=connexion">Connexion</a></li>';
											}
											?>				
              </ul>
            </div>			
			</div>
        </nav>