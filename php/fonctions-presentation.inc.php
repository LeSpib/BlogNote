<?php  // Fonctions utilisées pour gérer des affichages. 

function EntetePage($titrehaut,$titre,$academie,$age,$style,$utilisateur,$droitmin,$droit,$connexion)
  { // En-tête des pages
  $style='entete_'.$style;
  html('<html>');
  html('<head>');
  html('<title>' . $titrehaut . '</title>');
  html('<link rel="stylesheet" type="text/css" href="css/presentation-101.css" media="screen">');
  // html('<link rel="stylesheet" type="text/css" href="css/presentation2.css" media="print">');
  html('<link rel="icon" type="image/gif" href="'.LOGO.'">');
  html('<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />  ');
  html('<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>');
  html('<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>');
  html('<script type="text/javascript" src="development-bundle/ui/i18n/jquery.ui.datepicker-fr.js"></script>');
  html('<script type="text/javascript">');
  html('  $(function(){');
  html('  // Datepicker');
  html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
  html('  });');
  html('');
  html('</script>');
  html('<script type="text/javascript">');
  html(' function clique(id){alert("Clic :"+ id +"!");}');
  html('</script>');
  script_icone_multiple();
  script_icone_multiple_bis();
  
  html('</head>');
  html('');  
  html('<body>');
  if ($titre)
    {
//    script_valide_mail(''); // vérification de l'orthographe des mails.
//    script_aidevisuelle(''); // Lancement de l'aide visuelle.
//    html('<table class="'.$style.'" width="100%" align="center">');
//    html('  <tr  align="center">');
//    if ($academie)
//      {
//      html('    <td class="'.$style.'" width="18%">' .$academie. '</td>');
//      html('    <td class="'.$style.'" width="64%" border="1">' .$titre. '</td>');  
//      html('    <td class="'.$style.'" width="18%">' .$age. '</td>');
//      }
//    else
//      html('    <td class="'.$style.'" width="100%" border="1">' .$titre. '</td>');  
//    html('  </tr>');
//    html('</table>');
//    html('');  
//    html('<div id="section">');

//    html('<div id="menu">');

//    html('Ceci est le menu et j\'ai envie de tester sa longueur, voir s\'il tient bien la route.');


    // Liens vers fonctionnalités avec usage d'une requête.
//     html('<div id="facultatif">');
//    $requete  = "SELECT * FROM structures WHERE st_droits<=$droit ORDER by st_id";
//    $resultat = ExecRequete($requete,$connexion);
//    $objet    = ObjetSuivant($resultat);
//    html('  <center><a href="' .$objet->st_page. '">' .$objet->st_titre. '</a>');
//    while ($objet=ObjetSuivant($resultat))
//      {
//      html('   - <a href="' .$objet->st_page. '">' .$objet->st_titre. '</a>');
//      }      
//     html('  </center>');
//     html('</div>');

//    html('</div>');
 
//    html('<div id="page">');
    
//    html('');
    }
  AccesPossible($utilisateur,$droitmin);
  }

// Autres...
function PiedPage()
{ // Pied des pages
    html('<br><br>');
    html('</div>'); // Fin du div page
    html('');
    html('</body>');
    html('</html>');
}

function Ligne()
{ // Ligne pour séparation
    html('<br><center><img src="img/barre.gif"></center></br>');
    html('');
}

?>