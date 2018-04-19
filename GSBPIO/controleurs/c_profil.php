<?php
if(!isset($_REQUEST['action']))
     $action = 'profil';
else
	$action = $_REQUEST['action'];

switch($action)
{
		case 'profil':
		{
			$lesprofil = $pdo->getProfil($_SESSION['id']);
			include("vues/v_prof.php");
			if(isset($_POST['button']))
			{
				echo'a finir';
			}
			break;
		}
				
}