<?php
if(!isset($_REQUEST['action']))
     $action = 'demandeConnexion';
else
	$action = $_REQUEST['action'];

switch($action)
{
	case 'demandeConnexion':
		{
			include("vues/v_co.php");
			break;
		}
		
		case 'validerConnexion':
		{
			if(isset($_POST["submit"]))
			{
				$resu = $pdo->verifierUser($_REQUEST['login'], $_REQUEST['mdp']);
				$resu2 = $pdo->verifierAdmin($_REQUEST['login'], $_REQUEST['mdp']);
				if($resu)
				{
					header("location: index.php?uc=gestion&action=affichage");
				}
				else if($resu2){
					
					header("location: index.php?uc=gestion&action=verification");
				}
				else
				{
					include("vues/v_co.php");
					echo "erreur de login ";
				}

			}
		}
}
?>