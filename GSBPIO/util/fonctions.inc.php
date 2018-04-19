<?php

$pdo = PdoGSB::getPdoGSB();

$tab = $pdo->getChien();
include("vues/v_entete.php");
include("vues/v_affichage.php");
?>
