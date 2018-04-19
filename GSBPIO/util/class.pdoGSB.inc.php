	<?php
class PdoGSB
{

      	private static $serveur='mysql:host=172.17.0.15';
      	private static $bdd='dbname=gsbpio';
      	private static $user='oktay' ;
      	private static $mdp='btssio' ;
		private static $monPdo;
		private static $monPdoGSB = null;

/*		private static $serveur='mysql:host=127.0.0.1';
      	private static $bdd='dbname=gsb_ppe2016';
      	private static $user='root' ;
      	private static $mdp='' ;
		private static $monPdo;
		private static $monPdoGSB = null;
*/


	public function getProfil($idU)
	{

		$req = "SELECT Nom, prenom, login, mdp, mail from utilisateur WHERE idU = ".$idU."";

		$res = PdoGSB::$monPdo->query($req);

		return $res->fetchAll();

	}



	private function __construct()
	{
		PdoGSB::$monPdo = new PDO(PdoGSB::$serveur.';'.PdoGSB::$bdd, PdoGSB::$user, PdoGSB::$mdp);
		PdoGSB::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		PdoGSB::$monPdo = null;
	}

// Fonction statique qui crée l'unique instance de la classe

	public static function getPdoGSB()
	{
		if(PdoGSB::$monPdoGSB == null)
		{
			PdoGSB::$monPdoGSB = new PdoGSB();
		}
		return PdoGSB::$monPdoGSB;
	}


	public function creerInscrit($nom, $prenom, $mail, $message)
	{
		$req = "insert into utilisateur (Nom, prenom, mail, message) values ('$nom','$prenom','$mail','$message')";

		$res = PdoGSB::$monPdo->exec($req);
	}

	public function AddChien($nom, $dateDN, $NdeT, $dateAdh, $idtype)
	{

		$req = "insert into chien (idCh, nom, DateDeNaissance, NTatouage, DateAdhesion, idR) values (NULL, '$nom','$dateDN','$NdeT','$dateAdh',(SELECT race.idR from race where race.race='$idtype'))";


		$res = PdoGSB::$monPdo->exec($req);
	}

	public function getChien()
	{
		if(isset($_SESSION['iduser'])){

		$req = "select chien.nom, chien.DateDeNaissance, chien.NTatouage, chien.DateAdhesion, race.race from adhesion, chien, utilisateur,race
                WHERE utilisateur.idU = adhesion.idU
				AND adhesion.idCh = chien.idCh
				AND race.idR=chien.idR
				AND utilisateur.idU=".$_SESSION['iduser'].";";
		$res = PdoGSB::$monPdo->query($req);
		return $res->fetchAll(PDO::FETCH_ASSOC);
		}
		else if(isset($_SESSION['admin'])){

		$req = "select chien.nom, chien.DateDeNaissance, chien.NTatouage, chien.DateAdhesion, race.race from adhesion, chien, utilisateur,race
                WHERE utilisateur.idU = adhesion.idU
				AND adhesion.idCh = chien.idCh
				AND race.idR=chien.idR
				AND utilisateur.idU=".$_SESSION['idadmin'].";";
		$res = PdoGSB::$monPdo->query($req);
		return $res->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			return 0;
		}
	}

	public function AValider(){

		if(isset($_SESSION["admin"])){

			$req = "select utilisateur.idU, utilisateur.Nom, utilisateur.prenom, utilisateur.mail, utilisateur.message, chien.nom, chien.DateDeNaissance, chien.NTatouage, chien.DateAdhesion, race.race
					from adhesion
					inner join utilisateur on utilisateur.idU=adhesion.idU
					inner join chien on chien.idCh=adhesion.idCh
					inner join race on race.idR=chien.idR WHERE utilisateur.Valider = 0 AND utilisateur.Admin = 0";

			$res = PdoGSB::$monPdo->query($req);

			return $res->fetchAll();
		}


	}

	public function ValiderCompte($idU){


		$req = "UPDATE utilisateur SET Valider = 1 WHERE idU = ".$idU."";

		$res = PdoGSB::$monPdo->exec($req);


	}

	public function getAllRace()
	{
		$req = "select * from race";
		$res = PdoGSB::$monPdo->query($req);

		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllUtilisateur()
	{
		$req = "select * from utilisateur order by prenom";
		$res = PdoGSB::$monPdo->query($req);

		return $res->fetchAll();
	}


	public function verifierAdmin($login, $mdp){

		$req = "select count(*) as nb from utilisateur where login='".$login."' and mdp='".$mdp."' and Admin=1";
		$res = PdoGSB::$monPdo->query($req);
		$l = $res->fetch();

		if($l['nb'] == 1)
		{
			$req = "select * from utilisateur where login='".$login."' and mdp='".$mdp."'";

			$res = PdoGSB::$monPdo->query($req);

			$res = $res->fetch(PDO::FETCH_NUM);

			//ajout de variables sessions
			$_SESSION['nomU'] = $res[1];
	 		$_SESSION['admin'] = $res[1]." ".$res[2]; //nom et prenom
			$_SESSION['idadmin'] = $res[0];
			$_SESSION["id"] = $res[0];

			return true;
		}
		else
		{
			return false;
		}


	}

	public function Adhesion($nom, $dateAdh, $NomChien){

		$req = "insert into adhesion(nomA, date, idU, idCh) values ('".$nom."', '".$dateAdh."', (select idU from utilisateur where Nom='".$nom."'), (select idCh from chien where nom='".$NomChien."'))";

		$res = PdoGSB::$monPdo->exec($req);


	}

	public function verifierUser($login, $mdp)
	{
		$req = "select count(*) as nb from utilisateur where login='".$login."' and mdp='".$mdp."' and Valider=1";
		$res = PdoGSB::$monPdo->query($req);
		$l = $res->fetch();


		if($l['nb'] == 1)
		{
			$req = "select * from utilisateur where login='".$login."' and mdp='".$mdp."'";

			$res = PdoGSB::$monPdo->query($req);

			$res = $res->fetch(PDO::FETCH_NUM);

			//ajout de variables sessions
			$_SESSION['nomU'] = $res[1];
	 		$_SESSION['user'] = $res[1]." ".$res[2]; //nom et prenom
			$_SESSION['iduser'] = $res[0];
			$_SESSION["id"] = $res[0];

			return true;
		}
		else
		{
			return false;
		}


	}


	public function AfficherLogMail($idU){

		$req = "select DISTINCT(LEFT(prenom,1)) as login, nom, mail, SUBSTRING(MD5(RAND()) FROM 1 FOR 5) AS password from utilisateur where idU = ".$idU."";

		$res = PdoGSB::$monPdo->query($req);

		return $res->fetchAll();



	}

	public function EnregistrerLogin($pseudo, $mdp, $idU){

		$req = "UPDATE utilisateur SET login = '".$pseudo."', mdp = '".$mdp."' WHERE idU = ".$idU."";

		$res = PdoGSB::$monPdo->exec($req);


	}

	public function RecupMail($idU){

		$req="SELECT mail from utilisateur where idU = ".$idU."";

		$res = PdoGSB::$monPdo->query($req);

		return $res->fetchAll();

	}

	public function RefusMail($idU){

		$req = "UPDATE utilisateur SET Valider = 2 WHERE idU = ".$idU."";

		$res = PdoGSB::$monPdo->exec($req);


	}



	public function ajouterMessage($idUser, $texte)
	{
		$req = 'INSERT INTO message (idPosteur, text, prive) VALUES ('.$idUser.', "'.$texte.'", 0)';
		PdoGSB::$monPdo->exec($req);
	}
	public function ajouterMessagePrive($idUser, $idPosteur, $texte)
	{
		$req = 'INSERT INTO message (idU, idPosteur, text, prive) VALUES ('.$idUser.', "'.$idPosteur.'", "'.$texte.'", 1)';
		PdoGSB::$monPdo->exec($req);
	}
	public function getTousLesMessagesPublics()
	{
		$req = 'SELECT message.text, Nom, prenom FROM message INNER JOIN utilisateur ON message.idPosteur = utilisateur.idU WHERE prive=0 ORDER BY message.idM LIMIT 30;';
		$messages = PdoGSB::$monPdo->query($req);
		return $messages->fetchAll();
	}
	public function getMessagesPrives($idUser)
	{
		$req = 'SELECT message.text, Nom, prenom FROM message INNER JOIN utilisateur ON utilisateur.idU = message.idPosteur WHERE prive=1 AND message.idU = '.$idUser.' ORDER BY message.idM LIMIT 30;';
		$messages = PdoGSB::$monPdo->query($req);
		return $messages->fetchAll();
	}
  public function getMessagesPublicsDepuisId($idMessage)
  {
    $req = 'SELECT message.text, Nom, prenom FROM message INNER JOIN utilisateur ON message.idPosteur = utilisateur.idU WHERE prive=0 AND message.idM > '.$idMessage.' ORDER BY message.idM LIMIT 30;';
		$messages = PdoGSB::$monPdo->query($req);
		return $messages->fetchAll();
  }
	public function getToutesDiscussionsPourAdmin()
	{
		$req = 'SELECT MAX(message.idM) as idDernierMessage, utilisateur.Nom, utilisateur.prenom, message.idU FROM message INNER JOIN utilisateur ON utilisateur.idU = message.idU WHERE message.prive = 1 GROUP BY idU';
		$messages = PdoGSB::$monPdo->query($req);
		return $messages->fetchAll();
	}

}
	?>
