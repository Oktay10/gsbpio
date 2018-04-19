<div class="container">

<h3>Mon Profil :</h3>
<table class="table table-bordered">
<thead style="background-color: #eee;">
<tr>
	<th>Nom </td>
	<th>Prenom</th>
	<th>Login</th>
	<th>Mot de passe</th>
	<th>Mail</th>
</tr>
</thead>
	
	<?php
	foreach($lesprofil as $event)
{
	echo "<tr><td>
	". $event['Nom'] ." </td>
	<td>". $event['prenom'] ."</td>
	<td>". $event['login'] ."</td>
	<td>". $event['mdp'] ."</td>
	<td>". $event['mail'] ."</td>
	<td>"?><form method="post"> <input name="button" type="submit" value="Modifier"><form><?php "</td>
	</td> </tr>" ;
}




?>

</table>

</div>