<?php
if(!isset($_REQUEST['action']))
     $action = 'accueil';
else
	$action = $_REQUEST['action'];

switch($action)
{
		
		case 'affichage':
		{
			
			$tab = $pdo->getChien();
			include("vues/v_affichage.php");
			break;
		}
		
		case 'verification' :
		{
			$tab = $pdo->AValider();
			include("vues/v_valider.php");
			break;
		}
	
		case 'validerCompte':
		{
			$pdo->ValiderCompte($_REQUEST['idU']);
			
			$idU = $_REQUEST["idU"];
			$log = $pdo->AfficherLogMail($idU);
			$mail2 = $pdo->RecupMail($idU);
			
			include("controleurs/TestMail.php");
			
			
			header("Location:index.php?uc=gestion&action=verification");
			
			
			break;
		}
		
		case 'supprimerCompte':
		{
			$idU = $_REQUEST["idU"];
			
			
			$mail2 = $pdo->RecupMail($idU);
			
			include("controleurs/MailRefus.php");
			
			
			
			header("Location:index.php?uc=gestion&action=verification");
			
			break;
		}
}