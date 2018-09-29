<?php

error_reporting( E_ALL );

// DATABASE PARAMS
define('DB_HOST', 'www.ratigan.net/MySQLAdmin'); // Host name
define('DB_LOGIN', 'morby');	// Database login
define('DB_MDP', 'weed78');	// Database password
define('DB_BDD', 'ratigannet1'); // Database name
define('DB_TABLE', 'active_book'); // Table name

// DATABASE CONNECT ( Warning::Do not edit )
mysql_connect(DB_HOST, DB_LOGIN, DB_MDP) or die('<hr />Could not connect to the database '. DB_BDD .' !! Please check you\'r settings.');
mysql_select_db(DB_BDD) or die('<hr />The database '. DB_BDD .' doesn\'t exist !! Please check the documentation.');

// ADMIN PARAMS
$superadminlog 	= 'admin'; // Administrator login
$superadminmdp 	= 'admin'; // Administrator password

// ACTIVEBOOK PARAMS
$nombredecom 	= 5; // Number comment per page
$antiflood 		= 1;  // Enable antiflood (1 = yes/ 0 = no)
$max 			= 300; // Number chars on comment
$aftime 		= 10;  // Number of seconds before re posting.
$adminbgcolor	= '#CDDFF4'; // Admin background color (#EAEAEA, #CDDFF4...)

// EMAIL PARAMS
$sendmemail		= true; // Nothifiy me a message when adding comment

$myemail		= 'contact@activedev.net'; // Your address Email
$emailsubject	= 'New Activebook comment'; // Message nothification subject