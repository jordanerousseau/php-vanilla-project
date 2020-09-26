<?php

define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASSWORD','');
define('DB_NAME','');

$SQL = new Mysql_new();

class Mysql_old {
	private $Serveur = DB_HOST;
	private $Bdd= DB_NAME;
	private $Identifiant = DB_USER;
	private $Mdp = DB_PASSWORD;
	private $database = '';

    function __construct(){
		$this->database = @mysql_connect($this->Serveur,$this->Identifiant,$this->Mdp);
		if (!$this->database){
			echo "Impossible de se connecter a Mysql";
		}
		else{
			mysql_select_db($this->Bdd,$this->database);
			mysql_query("SET NAMES UTF8");
		}
	}
	
	function ExecuteSQL($requete){
		$resultat = @mysql_query($requete,$this->database);
		if (!$resultat){
			echo "Impossible d'effectuer l'operation.";
		}
		else{
			return $resultat;
		}
	}
	
	function RetourneNbRequetes($requete){
		$resultat = @mysql_num_rows($requete);
		return $resultat;
	}
	
	function ResSQL($requete){
		$resultat = @mysql_fetch_object($requete);
		return $resultat;
	}
	
	function TabResSQL($requete){
		$resultat = @mysql_fetch_assoc($requete);
		return $resultat;
	}
	
	function unbuffered($requete){
		$resultat = @mysql_unbuffered_query($requete);
		return $resultat;
	}
}

class Mysql_new {
	private $Serveur = DB_HOST;
	private $Bdd= DB_NAME;
	private $Identifiant = DB_USER;
	private $Mdp = DB_PASSWORD;
	private $database = '';
	
	function __construct(){
		try{
			@$this->database = new PDO('mysql:host='.$this->Serveur.';dbname='.$this->Bdd,$this->Identifiant,$this->Mdp, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			@$this->database->query("SET NAMES UTF8");
		}
		catch (Exception $e){
			die("Impossible de se connecter a Mysql");
		}
	}
	
	function ExecuteSQL($requete){
		try{
			$resultat = $this->database->query($requete);
			return $resultat;
		}
		catch(Exception $e){
			die("Impossible d'effectuer l'operation.");
		}
	}
	
	function RetourneNbRequetes($requete){
		$resultat = $requete->rowCount();
		return $resultat;
	}
	
	function ResSQL($requete){
		$resultat = $requete->fetch(PDO::FETCH_OBJ);
		return $resultat;
	}
	
	function TabResSQL($requete){
		$resultat = $requete->fetch(PDO::FETCH_ASSOC);
		return $resultat;		
	}	
	
	function unbuffered($requete){
		$resultat = $this->database->query($requete);
		return $resultat;
	}
}

?>