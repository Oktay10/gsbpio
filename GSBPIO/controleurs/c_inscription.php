<?php
if(!isset($_REQUEST['action']))
     $action = 'inscription';
else
	$action = $_REQUEST['action'];

switch($action)
{
		case'inscription':
		{
			$lesraces = $pdo->getAllRace();
			include("vues/v_inscriptionCh.php");
			break;
		}
		
		case 'validerCh' :
		{
			if(isset($_POST['submit']))
			{
				$pdo->AddChien($_REQUEST['nom'], $_REQUEST['dateDN'], $_REQUEST['NdeT'], $_REQUEST['dateAdh'], $_REQUEST['idtype']);
				$pdo->Adhesion($_SESSION['nomU'], $_REQUEST['dateAdh'], $_REQUEST['nom']);
			}
			break;
		}
		
		
		case 'inscriptionUti':
		{	
			$lesraces = $pdo->getAllRace();
			include("vues/v_inscription.php");
			break;
		}
		
		case 'validerU':
		{
			if(isset($_POST['submit']))
			{
				$pdo->creerInscrit($_REQUEST['nomUti'], $_REQUEST['prenom'], $_REQUEST['mail'], $_REQUEST['message']);
				$pdo->AddChien($_REQUEST['nom'], $_REQUEST['dateDN'], $_REQUEST['NdeT'], $_REQUEST['dateAdh'], $_REQUEST['idtype']);
				$pdo->Adhesion($_REQUEST['nomUti'], $_REQUEST['dateAdh'],$_REQUEST['nom']);
				
				$_SESSION["inscrit"]=true;
				header("location: index.php?uc=accueil");
				
							
				
				
				break;
			}
		}
}