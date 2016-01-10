<?php
/**
 * Fichier crée le 03/01/2016 par YT
 * Codage : utf8
 * Fonctions pour présentation
 **/

function entetePage($titrehaut)
{ // En-tête des pages
  html('<html>');
  html('<head>');
  html('<title>' . $titrehaut . '</title>');
  html('<link rel="stylesheet" type="text/css" href="css/presentation.css" media="screen">');
  // html('<link rel="stylesheet" type="text/css" href="css/presentation2.css" media="print">');
  html('<link rel="icon" type="image/gif" href="'.LOGO.'">');
  // html('<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />  ');
  // html('<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>');
  // html('<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>');
  // html('<script type="text/javascript" src="development-bundle/ui/i18n/jquery.ui.datepicker-fr.js"></script>');
  // html('<script type="text/javascript">');
  // html('  $(function(){');
  // html('  // Datepicker');
  // html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
  // html('  });');
  // html('');
  // html('</script>');
  // html('<script type="text/javascript">');
  // html(' function clique(id){alert("Clic :"+ id +"!");}');
  // html('</script>');
  //  script_icone_multiple();
  // script_icone_multiple_bis();
  html('</head>');
  html('');  
  html('<body>');
  html('<div id="page">');
  // AccesPossible($utilisateur,$droitmin);
}

// Autres...
function piedPage()
{ // Pied des pages
    html('<br><br>');
    html('</div>'); // Fin du div page
    html('');
    html('</body>');
    html('</html>');
}

function ligne()
{ // Ligne pour séparation
    html('<br><center><img src="img/barre.gif"></center></br>');
    html('');
}
?>