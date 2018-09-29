<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restorio House </title>
<meta name="keywords" content="steak house, menu, food, CSS, HTML, free templates, website templates" />
<meta name="description" content="Steak House is a free website template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Style1 {color: #006666}
-->
</style>
</head>
<body class="marges" >

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- SELECTION LANGUE-->

 <?php
  	session_start();
	
	 if( !isset($_SESSION['lang']))
	  {	  
  	     if ( !isset($_GET['lang']) or $_GET['lang']=='fr' ) {           // si la langue est 'fr'
  	      include('langue_fr.php');
	      $_SESSION['lang'] = 'fr';
  	     }  	 
  	     else if ( isset($_GET['lang']) and $_GET['lang']=='en') {      // si la langue est 'en' 
  	      include('langue_en.php');
		  $_SESSION['lang'] = 'en';
  	     }
	 }	 
	  else if( isset($_SESSION['lang']) )
	   {	   	   	 	   
	      if ( isset($_GET['lang'])) {   	     
		       $_SESSION['lang'] = ($_GET['lang']);
  	         }		 
	       	 
		 if ( $_SESSION['lang']=='en' ) {           // si la langue est 'fr'
  	      include('langue_en.php');	     
  	     }  	 
		 else {include('langue_fr.php');	     
  	     }
   	     
  	   }   
  ?>


<div id="fb-root"></div>

<div id="templatemo_container_wrapper_outter">
<div id="templatemo_container_wrapper_inner">

<div id="templatemo_container">

	<div id="templatemo_menu">
    	<ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            
            <li></li>
        </ul>
        
        <div id="site_title">
            <h1>
                <a href="http://www.templatemo.com" target="_parent">l’Entrecôte des Halles<span>Paris</span></a>            </h1>
      </div>
        
</div>
	<!-- end of menu --><!-- end of banner -->
<!-- end of content wrapper -->
<!-- end of container -->     
      
</body>
</html>