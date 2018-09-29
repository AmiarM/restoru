<?php

session_start();

if (isset($_SESSION['admin'])){

	require(dirname(__FILE__).'/config.php');
	require(dirname(__FILE__).'/fonction.php');
	if(!empty($_POST['id']) && ctype_digit($_POST['id'])) {
	
		$id= $_POST['id'];
		$message= htmlentities(utf8_decode ($_POST['message']));
		$requete='UPDATE '.DB_TABLE.' SET message="'.$message.'" WHERE id='.$id ;
		mysql_query($requete);
		mysql_close();
	}
	else{
		echo 'badid';
	}
}
else{

	echo 'interdit';
}