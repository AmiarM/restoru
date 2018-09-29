<?php

// RESUME FONCTION
function resume($txt, $max) {

    if (strlen($txt) > $max){
	
		$txt = substr($txt, 0, $max);
		$dernier_espace = strrpos($txt, "");
		$txt = substr($txt, 0, $dernier_espace)."...";
    }
    echo $txt;
}

// REPLACE ICONES FONCTION
function bbcode ($final){

	$final=str_replace(":)","<img src='activebook/img/emoticones/oui.gif'>",$final);
	$final=str_replace(":P","<img src='activebook/img/emoticones/p.gif'>",$final);
	$final=str_replace(":(","<img src='activebook/img/emoticones/non.gif'>",$final);
	$final=str_replace("[wink]","<img src='activebook/img/emoticones/wink.gif'>",$final);
	$final=str_replace("[love]","<img src='activebook/img/emoticones/loveit.gif'>",$final);
	$final=str_replace(":D","<img src='activebook/img/emoticones/big_smile.gif'>",$final);

	echo ($final);
}

// IMOTICONES FONCTION
function urlconvert3($texte){
	$texte = ereg_replace(	"(http://)(([[:punct:]]|[[:alnum:]])*)",
							"<a href=\"\\0\">\\2</a>",$texte);
							echo $texte;
}

// SECURITE FONCTION
function safe_addslashes($string) {

  static $setting=-1;
  if($setting === -1) {
  
    $setting = get_magic_quotes_gpc();
  }
  return ($setting) ? $string : addslashes($string);
}

function safe_stripslashes($string) {

  static $setting = -1;
  
  if($setting === -1){
	$setting = get_magic_quotes_gpc();
 }
  return ($setting) ? stripslashes($string) : $string;
}

// GRAVATAR FONCTION
function gravatar($email, $size=60) {

	// Définition des paramètres utiles
	$default = urlencode('activebook/images/avatar.jpg');
	$email 	 = md5($email);
	// Détermination de l'url paramétrée
	$url = 'http://www.gravatar.com/avatar.php';
	$url.= '?gravatar_id=%s';
	$url.= '&amp;size=%d';
	// Création de l'url
	$url = sprintf
	(
	$url,
	$email,
	intval($size),
	$default
	);
	// Génération de la sortie HTML
	$out = '<img src="'. $url .'" alt="Gravatar" title="Gravatar" />';
	return $out;
}

// IP FONCTION
function get_ip(){
 
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){	
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])){	
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} 
	else{ $ip = $_SERVER['REMOTE_ADDR'];
	} 
	return $ip;
}

// NUMBER OF COMMENTS FUNCTION

function get_comment_count() {
	
	$comment_count = 'SELECT COUNT(*) AS count FROM active_book';
	$count_query = mysql_query ($comment_count) or die('Erreur SQL ('.$comment_count.'):<br />'.mysql_error().'<br /><br />');
	
	while($comments = mysql_fetch_assoc($count_query )) {
		
		echo $comments['count'];
	}
}
?>