<div class="wrapper" style="padding-left: 500; padding-right: 500;">
<form method="POST" action="index.php?uc=inscription&action=validerCh">
<h2 class="form-signin-heading"> <center> Inscrire un chien </center></h2>
		<h4 class="form-signin-heading">Nom</h4><input type="text" class="form-control" name="nom" REQUIRED ></td></tr>
		<h4 class="form-signin-heading">Date de naissance</h4><input type="date" class="form-control" name="dateDN" REQUIRED></td></tr>
		<h4 class="form-signin-heading">N°de tatouage</h4><input type="number" class="form-control" name="NdeT" REQUIRED></td></tr>
		<h4 class="form-signin-heading">Date d'adhesion</h4><input type="date" class="form-control" name="dateAdh" REQUIRED></td></tr>
		<h4 class="form-signin-heading">Race : </h4><select class="form-control" name="idtype">
		<?php
			foreach($lesraces as $untype)
			{
				echo "<option> ".$untype['race'] ."</option>" ;
			}
		?></select>
		


<br/><input type="submit" class="btn btn-lg btn-primary btn-block" style="background-color: dimgray" name="submit" value="Valider ajout">
</form>
