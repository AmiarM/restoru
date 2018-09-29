<?php 

session_start();

header("Cache-Control: no-cache");

require(dirname(__FILE__).'/config.php');
require(dirname(__FILE__).'/fonction.php');

if( !empty($_GET['page']) && ctype_digit($_GET['page']) ) {

	$texte = htmlentities(safe_addslashes(isset ($_POST['name'])));
	
	$pageselect = $_GET['page'];
	
	$retour 		= mysql_query('SELECT COUNT(*) AS id FROM '.DB_TABLE);
	$donnees 		= mysql_fetch_array($retour);
	$totalDescom 	= $donnees['id'];
	$nombreDePages  = ceil($totalDescom / $nombredecom);
	
	if (isset($pageselect)) {
		$page = $pageselect;
	}
	else {
		$page = 1;
	}
	
	$premiercom 	= ($page - 1) * $nombredecom;
	$requete 		= 'SELECT * FROM '.DB_TABLE.' ORDER BY id DESC LIMIT ' . $premiercom . ', ' . $nombredecom;
	$ReadAllQuery 	= mysql_query ($requete) or die('Error SQL ('.$requete.'):<br />'.mysql_error().'<br /><br />');
}
?>
<input name="page" type="hidden"  id="page" value="<?php if (!isset($_GET['page'])) { echo 1 ; }else { echo $pageselect ; }?>" />
<div class="centrer">
  <div id="formulaire">
    <div class="poster" id="poster" style="background-image:url(activebook/img/add.png)">Ovrir le panel</div>
    <div class="success" style="display:none"></div>
    <div class="erreur" style="display:none"></div>
    <div class="divpost">
	  <input name="email" type="text" class="ib_input" id="email" value="Your email" onblur="if(this.value == '') { this.value='Your email'}" onfocus="if (this.value=='Your email') {this.value=''} else {(this.value=='Your email')}" /><br />
      <input name="pseudo" type="text" class="ib_input" id="pseudo" value="Your name" onblur="if(this.value == '') { this.value='Your name'}" onfocus="if (this.value=='Your name') {this.value=''} else {(this.value=='Your name')}" /><br />
      <span> <span class="emoticone" id="em_oui"><img src="activebook/img/emoticones/oui.gif" /></span> <span class="emoticone" id="em_p"><img src="activebook/img/emoticones/p.gif" /></span> <span class="emoticone" id="em_non"><img src="activebook/img/emoticones/non.gif" /></span> <span class="emoticone" id="em_loveit"><img src="activebook/img/emoticones/loveit.gif" /></span><span class="emoticone" id="em_bigsmile"><img src="activebook/img/emoticones/big_smile.gif" /></span><span class="emoticone" id="em_wink"><img src="activebook/img/emoticones/wink.gif" /></span></span>
      <textarea class="ib_textearea" rows="5" cols="10" name="message" id="message" onblur="if(this.value == '') { this.value='Write your comment here...'}" onfocus="if (this.value=='Write your comment here...') {this.value=''} else {(this.value=='Write your comment here...')}" >Write your comment here...</textarea>
      <br />
      <input type="button" class="ib_button" id="menu1" value="Add Comment" />
      <?php 
	  if (isset($_SESSION['admin'])) { ?>
      <a class="tooltips" href="javascript:void(0)">
     		<img class="btnadmin" id="deco" src="activebook/img/deco.png" alt="Log out" />
            <span class="tooltip" style="display: none;">Log out</span>
      </a>
      <?php } else { ?>
      <a class="tooltips" href="javascript:void(0)">
     		<img class="btnadmin" id="admin" src="activebook/img/admin.gif" alt="Administration" />
            <span class="tooltip" style="display: none;">Administration</span>
      </a>
      <?php } ?>
    </div>
  </div>
  <div id="loading"></div>
  <div id="result" >
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<?php
		while($boucle_taverne = mysql_fetch_assoc($ReadAllQuery)) {

			$jour	= date('d',$boucle_taverne['temp']);
			$mois	= date('m',$boucle_taverne['temp']);
			$annee	= date('Y',$boucle_taverne['temp']);
			$heure	= date('H:i',$boucle_taverne['temp']);
	?>
      <tr class="<?php if ( $boucle_taverne['etat'] == 1 ) { echo 'admincolor'; } ?>">
        <td>
			<table class="com_global" border="0" cellpadding="5" cellspacing="5" width="100%" style=" <?php if ( $boucle_taverne['etat'] == 1 ) { echo 'background-color:'.$adminbgcolor; } ?>">
            <tr>
            <td class="avatar" valign="top"><?php if ( !empty($boucle_taverne['email']) ) { echo gravatar($boucle_taverne['email'], 60); } else { echo '<img src="activebook/img/avatar.jpg" />'; }?></td>
              <td  class="commentaire" >
                <strong>
                	<a class="tooltips" href="mailto:<?php echo stripslashes($boucle_taverne['email']); ?>">
						<?php resume(stripslashes($boucle_taverne['auteur']),20); ?>
               			<span class="tooltip" style="display: none;"><?php echo stripslashes($boucle_taverne['email']); ?></span>
					</a>
                </strong>
                <span class="date"><?php echo $jour ; ?>
                <?php 
					switch($mois) {
					
					   case 1 : $lemois = "Jan" ; break; 
					   case 2 : $lemois = "Fev" ; break;  
					   case 3 : $lemois = "Mar" ; break; 
					   case 4 : $lemois = "Avr" ; break; 
					   case 5 : $lemois = "Mai" ; break; 
					   case 6 : $lemois = "Juin" ; break; 
					   case 7 : $lemois = "Juil" ; break; 
					   case 8 : $lemois = "Aout" ; break;  
					   case 9 : $lemois = "Sep" ; break; 
					   case 10 : $lemois = "Oct" ; break; 
					   case 11 : $lemois = "Nov" ; break; 
					   case 12 : $lemois = "Dec" ; 
					}
					echo $lemois ; 
				?>
                <?php echo $annee ; ?> <?php echo " &agrave; ".$heure ; ?><br />
                <?php if ( isset($_SESSION['admin']) ) { ?>
                <img src="activebook/img/edit.png"  width="16" height="16" align="absmiddle" class="update" id="<?php echo $boucle_taverne['id'] ?>" /> <img src="activebook/img/delete.png"  width="16" height="16" align="absmiddle" class="delete" id="<?php echo $boucle_taverne['id'] ?>" />
                <?php } ?>
                </span>
                <p id="commentaire">
				<?php
					if ( isset($_GET['id']) ) {
						
						if ( $boucle_taverne['id'] == $_GET['id'] ) {
							echo '<textarea class="updatemes" rows="5" cols="10" name="updatemes" id="'.$boucle_taverne['id'].'">';
							echo utf8_encode(wordwrap($boucle_taverne['message'], 100, "\n", true));
							echo '</textarea>'; 
						}
					}
					else {
						
						$txtfinal = utf8_encode(nl2br(wordwrap($boucle_taverne['message'], 142, "\n", true)));
						$txtfinal = bbcode($txtfinal);
						$txtfinal = stripslashes($txtfinal);
						
						echo $txtfinal;
					} 
				?>
                </p>
                </td>
            </tr>
          </table></td>
      </tr>
 		<?php } //fin de la boucle ?>
    </table>
    <div class="pagination">
	<?php   
		for ($i = 1 ; $i <= $nombreDePages ; $i++) { //impression des pages restantes
                echo '<span class="changepage" id="'.$i.'">' . $i . '</span>';
        }
    ?>
	</div>
    <div class="comment_count">
    	<p>There is <?php  get_comment_count() ?> comments</p>
    </div>
    <div class="clear"></div>
  </div>
</div>