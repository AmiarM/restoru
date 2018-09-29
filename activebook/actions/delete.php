<?php

session_start();

if (isset($_SESSION['admin'])){

	if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
		$id=$_POST['id'];
		require(dirname(__FILE__).'/config.php');
		require(dirname(__FILE__).'/fonction.php');
		mysql_connect(DB_HOST, DB_LOGIN, DB_MDP);
		mysql_select_db (DB_BDD);
		$requete='DELETE FROM '.DB_TABLE.' WHERE id='.$id;
		$ReadAllQuery = mysql_query ($requete);
		mysql_close();
		}
		else{
		
		echo 'badid';
	}
}
else{

	echo 'interdit';
}