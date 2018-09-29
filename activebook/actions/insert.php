<?php

session_start();

require(dirname(__FILE__).'/config.php');
require(dirname(__FILE__).'/fonction.php');

$auteur 	= strip_tags(htmlentities(safe_addslashes($_POST['pseudo'])));
$email	 	= strip_tags(htmlentities(safe_addslashes($_POST['email'])));
$message	= utf8_decode(safe_addslashes($_POST['message']));
$temp 		= time();
$ip 		= get_ip();

if ( strlen($message) > $max ){
	
	$longeur = 1;
}
else {
	
	$longeur = 0;
}

if ( isset($_SESSION['admin']) ){
	
	$etat = 1;
}
else {
	
	$etat = 0;
}

if ( isset($_SESSION['admin']) ) {

	$requete = 'INSERT INTO '.DB_TABLE.' (auteur, email, message, temp, ip, etat) values("'.$auteur.'", "'.$email.'", "'.$message.'", "'.$temp.'", "'.$ip.'", "'.$etat.'")';
	mysql_query($requete);
	
	echo 'noflood';

}
else {

	// visitors parts
	if ( $antiflood == 1 ){

		$antiflood 	= 'SELECT * FROM '.DB_TABLE.' WHERE ip = "'.$ip.'" ORDER BY temp DESC LIMIT 1 ';
		$retour 	= mysql_query($antiflood);
		$antiflood0 = mysql_fetch_array($retour);
		$timelaps 	= $temp - $antiflood0['temp'];

		if ( $timelaps < $aftime ) {
			
			echo 'flood';
		}
		else {
			
			if ( $longeur == 1 ) {
				
				echo 'trop';
			}
			else {
				
				$requete = 'INSERT INTO '.DB_TABLE.' (auteur, email, message, temp, ip, etat) values("'.$auteur.'", "'.$email.'", "'.$message.'", "'.$temp.'", "'.$ip.'", "'.$etat.'")';
				mysql_query($requete);
				
				echo 'noflood';
				
				if ( $requete AND $sendmemail == true ) {
					
					mail($myemail, $emailsubject, "This is the comment : \n \n".$message);
				}
			}
		}
	}
	else {
		
		if ( $longeur == 1 ) {
			
			echo 'trop';
		}
		else{
			
			$requete='INSERT INTO '.DB_TABLE.' (auteur, email, message, temp, ip, etat) values("'.$auteur.'","'.$email.'", "'.$message.'", "'.$temp.'", "'.$ip.'", "'.$etat.'")';
			mysql_query($requete);
			
			echo 'noflood';
			
			if ( $requete AND $sendmemail == true ) {
				
				mail($myemail, $emailsubject, "This is the comment : \n \n".$message);
			}
		}
	}
}

mysql_close();