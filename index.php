<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restorio House </title>
<meta name="keywords" content="steak house, menu, food, CSS, HTML, free templates, website templates" />
<meta name="description" content="Steak House is a free website template provided by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.infinitecarousel.js"></script>

<script type="text/javascript">
$(function(){
	$('#carousel').infiniteCarousel({
		displayTime: 6000,
		textholderHeight : .25
	});
});
</script>



<style type="text/css">
<!--
.Style2 {
	font-size: 16px;
	font-weight: bold;
}
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
            <li><a href="index.php?page=accueil" 
             <?php { if( !isset($_GET['page']) or $_GET['page'] == "accueil" ) echo ' class="current" ';}?>           
            title="Accueil"><?php echo TXT_ACCUEIL_INDEX; ?></a></li>
            <li><a href="index.php?page=plats#carousel" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "plats" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_PLATS; ?></a></li>
            <li><a href="index.php?page=music" class="margin_r_330"><?php echo TXT_ACCUEIL_MUSIC; ?></a></li>
            
              <li><a href="index.php?page=photos" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "photos" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_PHOTOS; ?></a></li>
          
         <li><a href="index.php?page=contact" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "contact" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_CONTACT; ?></a></li>
            
             <li><a href="index.php?page=livre_or" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "livre_or" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_LIVRE_OR; ?></a></li>
            
        </ul>
        
        <div id="site_title">
            <h1>
                <a href="http://www.templatemo.com" target="_parent">l’Entrecôte des Halles<span>Paris</span></a>            </h1>
      </div>
        
        <div class="langue">
          <div >
            <div align="left"><a href="index.php?lang=fr" class="UneLangue">
           <img src="images/fr.gif" alt="Langue FR" width="15" height="10"  vspace="1" border="1" /> Français</a> </div>
          </div>
          <div><a href="index.php?lang=en" class="UneLangue">
           <img src="images/en.gif" alt="Langue FR" width="15" height="10"  vspace="1" border="1" /> Englais</a></div>          
      </div>
        
        
</div> <!-- end of menu -->
    
    <div id="templatemo_banner">
     	
        <div id="banner_section">
          	<h2>Histoire d'amour de géneration en géneration</h2>
          	<p>depuis 1889.</p>
      </div> <!-- banner section -->
    
    </div> <!-- end of banner -->
    
    <div id="templatemo_content_wrapper">
    
      <div id="templatemo_content">
        <div id="side_column">
          <div class="side_column_section">
            <h4>Categories</h4>
            <ul class="category_list">
            
              <li><a href="index.php?page=accueil" 
             <?php { if( !isset($_GET['page']) or $_GET['page'] == "accueil" ) echo ' class="current" ';}?>           
            title="Accueil"><?php echo TXT_ACCUEIL_INDEX; ?></a>             </li>
            
             <li><a href="index.php?page=plats#templatemo_content_wrapper" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "plats" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_PLATS; ?></a></li>
            
             <li><a href="index.php?page=music" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "music" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_MUSIC; ?></a></li>
            
              <li><a href="index.php?page=photos" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "photos" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_PHOTOS; ?></a></li>
             
              <li><a href="index.php?page=contact" 
            <?php { if( isset($_GET['page']) and $_GET['page'] == "contact" ) echo ' class="current" ';}?>
            ><?php echo TXT_ACCUEIL_CONTACT; ?></a></li>
            
            </ul>
          </div>
          <div class="side_column_section">
            <h4>Notre Adresse</h4>
            <a href="http://maps.google.fr/maps?q=38+Rue+Saint-Denis,+75001+Paris&hl=fr&ie=UTF8&sll=48.680793,2.502588&sspn=2.172492,4.938354&oq=38,+rue+Saint+Denis,+75001+Paris&hnear=38+Rue+Saint-Denis,+75001+Paris,+%C3%8Ele-de-France&t=m&z=16" target="_blank"><img src="images/map_12.jpg" alt="map" width="178" /></a>           
            <p> 38, rue Saint Denis,<br />
              75001 Paris</p>
            <p>              <br />
              Tel: +331.47.83.67.06<br />
</p>
            
            <p>&nbsp;</p>
            <p>Email:<br />
              <a href=" mailto:entrecotedeparis@free.fr">entrecotedeparis@free.fr</a> </p>
          <br>         
        
          
<br>  
              <div class="network">
              
                <a href="index.php?page=livre_or" class="Style2">Livre D'Or</a> <br>
                <br>
                
             <div class="fb-like" data-href="http://www.facebook.com/pages/The-Official-Steve-Jobs-Memorial-Page/288081601204080" 		             data-send="true" data-layout="button_count" data-width="50" data-show-faces="true" data-font="tahoma"></div>             
              <br>
              <br>
               
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<div>
<a href="http://twitter.com/share" class="twitter-share-button"
data-url="http://www.twoutils.com"
data-via="twoutils"
data-text="Mettre le Bouton Twitter sur son Site"
data-related="twitter,twitfond"
data-count="horizontal"
data-lang="fr">Tweeter</a>
</div>

          </div>
          </div>
          <div class="side_column_bottom"></div>
        </div>
        <!-- end of side column -->
<div id="main_column">
            	
                <div class="section_w590">


            <?php    	
                {
				  if( !isset($_GET['page']) or  $_GET['page'] == "accueil"  )
                  include("accueil.html");
                }                   
    		?>   
            
             <?php    	
                {
				if( isset($_GET['page']) and $_GET['page'] == "contact" ){
                  include("contact.html");
				  }								  
                }                   
    		  ?>               
              
             <?php                 
				if( isset($_GET['page']) and ( ($_GET['page'] == "plats" ))){
			     include("plats.html");
				  }                               
    		  ?>                
                       
              
               <?php                 
				if( isset($_GET['page']) and $_GET['page'] == "music" ){
			     include("music_groupe.html");
				  }                               
    		  ?>   
              
               <?php                 
				if( isset($_GET['page']) and $_GET['page'] == "delices" ){
			     include("delices.html");
				  }                               
    		  ?>           
              
              
                <?php                 
				if( isset($_GET['page']) and $_GET['page'] == "livre_or" ){
			     include("activebook/index.php");
				 }                               
    		  ?>  
              
              
				</div>                    
        </div>
     <!-- end of main column -->               
        
        <div class="cleaner"></div>            
    </div> <!-- end of content -->      
</div> 
<!-- end of content wrapper -->      

<div id="templatemo_footer">
    
	     <ul class="footer_menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Templates</a></li>
            <li><a href="http://www.koflash.com" target="_blank">Gallery</a></li>
            <li><a href="http://www.flashmo.com" target="_blank">Flash</a></li>
            <li><a href="#">About</a></li>
            <li class="last_menu"><a href="#">Contact</a></li>
        </ul>
        
    	Copyright © 2048 <a href="#">Your Company Name</a> | Designed by <a href="galerie.php" target="_parent">Free CSS Templates</a> | 
        Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | Downloaded from <a href="http://www.mytemplatez.com">Free Templates</a>
           
</div> <!-- end of container -->  



</body>
</html>