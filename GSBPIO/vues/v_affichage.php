<?php 
if(isset($_SESSION['iduser']) or isset($_SESSION["admin"])){
?>
<div class="container">

<?php

if(empty($tab))
{
	echo"<h2>Aucun chiens...</h2>";
}
else{
?>

<h3>Chiens inscrits par <?php if(isset($_SESSION['iduser'])){echo $_SESSION['user'];} if(isset($_SESSION['admin'])){echo "Admin ".$_SESSION['admin'];} ?> :</h3><br>
<table class="table table-bordered">
<thead style="background-color: #eee;">
<tr>
	<th>Nom </td>
	<th>Date De Naissance</th>
	<th>N°Tatouage</th>
	<th>Date d'adhesion</th>
	<th>Race</th>
</tr>
</thead>
	
	<?php
	foreach($tab as $event)
{
	$date = date_format( date_create($event['DateDeNaissance']) , 'l d F Y');
	echo "<tr><td>
	". $event['nom'] ." </td>
	<td>". $date ."</td>
	<td>". $event['NTatouage'] ."</td>
	<td>". $event['DateAdhesion'] ."</td>
	<td>". $event['race'] ."</td>
	</td> </tr>" ;
}
}


?>

</table>
<?php
}
?>