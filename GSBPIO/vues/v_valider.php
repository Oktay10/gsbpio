<?php 
if(isset($_SESSION["admin"])){
?>
<div class="container">

<?php

if(empty($tab))
{
	echo"<h2>Pas de contacts...</h2>";
}
else{
?>

<h3>Liste des personnes en attente :</h3><br>
<table class="table table-bordered">
<thead style="background-color: #eee;">
<tr>
	<th>Nom </td>
	<th>Prénom</th>
	<th>Mail</th>
	<th>Message</th>
	<th>Nom du chien</th>
	<th>Date de naissance chien</th>
	<th>Num tatouage</th>
	<th>Date Adhesion</th>
	<th>Race du chien</th>
</tr>
</thead>
	
	<?php
	foreach($tab as $event)
{
	$date = date_format( date_create($event['DateDeNaissance']) , 'l d F Y');
	$date2 = date_format( date_create($event['DateAdhesion']) , 'l d F Y');
	echo "<tr><td>
	". $event['Nom'] ." </td>
	<td>". $event['prenom'] ."</td>
	<td>". $event['mail'] ."</td>
	<td>". $event['message'] ."</td>
	<td>". $event['nom'] ."</td>
	<td>". $date ."</td>
	<td>". $event['NTatouage'] ."</td>
	<td>". $date2 ."</td>
	<td>". $event['race'] ."</td>
	<td>"?><a href="index.php?uc=gestion&action=validerCompte&idU=<?php echo $event['idU']; ?>"><img src="images/pouceVert.jpg" name="valider" style="height: 88px;width: 100px;"></img></a><?php "</td>
	<td>"?><a href="index.php?uc=gestion&action=supprimerCompte&idU=<?php echo $event['idU']; ?>"><img src="images/pouceRouge.png" style="height: 88px;width: 100px;"></img></a><?php "</td>
	</td> </tr>" ;
}

}

?>

</table>
<?php
}
?>