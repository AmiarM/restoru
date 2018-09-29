<?php 

require(dirname(__FILE__).'/config.php');
require(dirname(__FILE__).'/fonction.php');

$login 	= htmlentities(safe_addslashes($_POST['login']));
$mdp 	= htmlentities(safe_addslashes($_POST['mdp']));

if ( ($login == $superadminlog) AND ($mdp == $superadminmdp) ) {
	
	$blabla = '1';
	session_start();
	$_SESSION['admin'] = '1';
}
else {
	$blabla = '2';
}

echo $blabla ;