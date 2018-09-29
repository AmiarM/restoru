<div align='center' style='width:550px; margin-left:auto; margin-right:auto;'>
<?php

if (function_exists('ini_set'))
	ini_set("memory_limit",'64M'); // la création de vignettes peut-être lourde...


// VOUS POUVEZ MODIFIER CETTE PARTIE SELON VOS PRÉFÉRENCES:
$folder = 'images';   // Dossier contenant les images
$mini = 'mini';    // Dossier contenant les miniatures
$nbimg = 20;      // Nombre d'images par page
$hautmini = 75;  // Hauteur des miniatures
$largmini = 100; // Largeur des miniatures
$larg = 600; // Largeur de l'image
	
	
if (!isset($_GET['galerie']) AND !isset($_GET['img'])) // Si on ne cherche pas à afficher une galerie ni une image particulière...
{

	$i = 0;
	echo '<h3>Galeries</h3><table><tr>';

	$files = scandir($folder);
	
	if ($files)
	{
		@$max = count($files);
		$i = 0;
		$j = 0;
		while($i < $max)
		{
			if ($files[$i] != '.' AND $files[$i] != '..' AND $files[$i] != 'Thumbs.db' AND $files[$i] != 'perso')// par exemple, on  affichera pas le contenu du dossier "perso"
			{
				$thumb = array();
				$thumb = scandir($folder . '/' . $files[$i]);
				
				echo '<td align="center">';
				echo '<a href="galerie.php?galerie=' . $folder . '/' . $files[$i] . '" target="_self">';
				echo '<img src="' . $folder . '/' . $files[$i] . '/' . $mini . '/' . $thumb[2] . '" width="130" height="100" border="0" alt="' . $thumb[2] . '" />';
				echo '</a><br /><a href="galerie.php?galerie=' . $files[$i] . '/' . $files[$i] . '" target="_self">' . $files[$i] . '</a>';
				echo '</td>';
			
				$j++; // Pour afficher 4 images par lignes.
				if (($j/4) == 1)
				{
					echo '</tr><tr>';
					$j = 0;
				}
			}
			$i++; 
		}
	}
	
	echo '</tr></table><br /><br />';
}
elseif (!isset($_GET['img'])) // Si on veut afficher une galerie...
{

	$galerie = str_replace($folder . '/', '', $_GET['galerie']); // On extrait le nom de la galerie

	echo '<h3>Galerie - ' . $galerie . '</h3>Cliquez sur une image pour la voir en plus grand.<br />';

	if (isset($_GET['id']))   // id = page affichée
		$id = $_GET['id'];
	else
		$id = 1;


	$glop = $id * $nbimg; // Pour la pagination...
	$glup = ($id-1) * $nbimg;
	$row = 0;


	$files = scandir($folder . '/' . $galerie); // On "scanne" la galerie...
	
	if ($files)
	{
		@$max = count($files); // On compte le nombre de fichiers présents dans le dossier, pour la boucle qui suit.
		$i = 0;
		while($i < $max)
		{
			if ($files[$i] != '.' AND $files[$i] != '..' AND $files[$i] != 'Thumbs.db' AND $files[$i] != 'mini' AND $files[$i] != 'perso')// par exemple, on  affichera pas le contenu du dossier "perso"
			{
			$row = $row+1;
			if ($row<=$glop && $row>$glup)     // affiche que les images comprises entre [(id -1) * nb images] et [id*nb images]
			{
					if (!file_exists($folder . '/' . $galerie . '/' . $mini . '/' . $files[$i]))   // vérifie si une miniature est déjà présente, auquel cas, pas besoin d'en recréer
					{
						if (!file_exists($folder . '/' . $galerie . '/' . $mini)) // Si le dossier des miniatures n'existe pas, on le crée.
							@mkdir ($folder . '/' . $galerie . '/' . $mini, 0755);
						
						$Image = $folder . '/' . $galerie . '/' . $files[$i];
						$ratio = 100;
						// création de la miniature
						$src = imagecreatefromjpeg($Image);
						$size = getimagesize($Image);

						if ($size[0] > $size[1])
						{
							$im = imagecreatetruecolor(round(($ratio/$size[1])*$size[0]), $ratio);
							imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio/$size[1])*$size[0]),$ratio, $size[0], $size[1]);
						}
						else
						{
							$im = imagecreatetruecolor($ratio, round(($ratio/$size[0])*$size[1]));
							imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($size[1]*($ratio/$size[0])), $size[0], $size[1]);
						}
						
						$miniature = $folder . '/' . $galerie . '/' . $mini . '/' . $files[$i];

						imagejpeg($im, $miniature);
						chmod($miniature,0755); // CHMOD des vignettes crées
						
					}
				
				$nom = substr($files[$i], 0, strlen($Fichier) - 4); // On extrait le nom de l'image de son nom complet
				echo '<a href="galerie.php?img=' . $folder . '/' . $galerie . '/' . $files[$i] . '" target="_self">';
				echo '<img src="' . $folder . '/' . $galerie . '/' . $mini . '/' . $files[$i] . '" border="0" width="' . $largmini . '" height=' . $hautmini . '" alt="' . $nom. '" onmouseover="document.getElementById(\'titreimg\').style.visibility=\'visible\'; document.getElementById(\'titreimg\').innerHTML = \'' . $nom . '\';" onmouseout="document.getElementById(\'titreimg\').innerHTML = \'<br />\';" /></a>';

			}
			}
			$i++; 
		}
	}
	
	echo '<br /><div id="titreimg"><br /></div>';

	if ($row == 1)
		echo 'Il y a ' . $row . ' image enregistr&eacute;e';

	if ($row == 0)
		echo 'Il n\'y a aucune image enregistr&eacute;e';

	if($row != 1 AND $row != 0)
		echo 'Il y a '.$row.' images enregistr&eacute;es';

	echo '<br /><br />';

	if ($id > 1) // Affichage des N* de page
		echo '<a href="galerie.php?id=' . ($id - 1) . '&amp;galerie=' . $galerie . '">[pr&eacute;c&eacute;dent]</a>&nbsp;-&nbsp;';
	else
		echo '[pr&eacute;c&eacute;dent] - ';

	for ($i=1; $i <= ceil($row/$nbimg); $i++)
	{
		if ($i != $id)
			echo '<a href="galerie.php?id=' . $i . '&amp;galerie=' . $galerie . '">' . $i . '</a>&nbsp;';
		else
			echo '[' . $i . '] ';
	}

	if ($id*$nbimg < $row)
		echo '- <a href="galerie.php?id=' . ($id + 1) . '&amp;galerie=' . $galerie . '">[suivant]</a>';
	else
		echo '- [suivant]';

	echo '<br /><br /><a href="galerie.php">Retour aux galeries</a><br /></div>';
}
else
{
	echo '<br />';
	$img = $_GET['img'];

	$nom = strstr($img, '/');
	$nom = strstr(substr($nom, 1, strlen($nom)), '/'); // Obtenir le nom de l'image: c'est bof, mais j'ai pas trouvé plus simple ;)
	$nom = substr($nom, 1, strlen($nom) - 5);

	echo '<a href="' . $img . '" target="_blank" border="0"><img src="' . $img . '" alt="' . $nom . '" width="' . $larg . '" border="0" alt="' . $nom . '"></a>';
	echo $nom . '<br /><br />Les images sont redimensionn&eacute;es. Pour les voir avec leur taille r&eacute;elle, cliquez dessus.';
	echo '<br /><br /><a href="javascript:history.back()"><b>Retour</b></a>';
}
?>
</div>