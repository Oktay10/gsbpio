

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_ALL, 'fr_FR');setlocale(LC_ALL, 'french');
session_start();
session_cache_limiter('private_no_expire, must_revalidate');

require_once("util/class.pdoGSB.inc.php");
include("vues/v_entete.php");

if(!isset($_REQUEST['uc']))
     $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

$pdo = PdoGSB::getPdoGSB();
switch($uc)
{
	
	case 'accueil' :
	{
		if(isset($_SESSION["inscrit"])){
			
			?><script>alert("Votre demande a bien été envoyé");</script><?php
			session_unset("inscrit");
		}
		include("vues/v_accueil.php");
		break;
	}
	case 'gestion' :
	{
		include("controleurs/c_gestion.php");
		break;
	}
	
	
	case 'profil' :
	{
		include("controleurs/c_profil.php");
		break;
	}	
	
	
	case 'inscription' :
	{
		include("controleurs/c_inscription.php");
		break;
	}	
	
	case 'connexion' :
	{
		include("controleurs/c_connexion.php");
		break;
	}

	case 'deconnexion' :
	{
		session_destroy();
		header("location: index.php?uc=accueil");
		break;
	}	
}
?>