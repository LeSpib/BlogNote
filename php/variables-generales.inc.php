<?php // Variables communes aux différentes pages)

// Variables non tabulées

$page          = basename($_SERVER["SCRIPT_NAME"]);
$cejour        = date('Y-m-d');
$cemoment      = date('H:i');
$cetemps       = date('Y-m-d H:i:s');
$anneeancienne = 1904;
$anneeref      = 2012;
$couleur       = "#000000";
$titretablarg  = '50%';
$typemax       = 9;

// Variables spécifiques gérées le plus en souvent par passage en référence.
$lien          = $page.'?';  // lien obtenu par concaténation pour les tris.
$espace        = '';         // décalage de l'affichage des balises HTML. 

// Variables tabulées

$qualites_liste = array('','M.','Mme','Mlle');
$sexes_liste = array('','Homme','Femme');
$ouinons_liste = array('','Oui','Non');
$jours_liste = array('','dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
$moiscourts_liste = array('','janv.','fév.','mars','avril','mai','juin','juil.','août','sept.','oct.','nov.','déc.');
$mois_liste = array('','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
$types_liste = array('Actions à définir','Actions premières','Actions en attente',
                     'Actions déléguées','Actions planifiées','Actions réalisées',
                     'Projets en cours','Projets éventuels','Projets réalisés',
                     'Documentation');

$categories_liste = array('','Associatif','Personnel','Professionnel','Collectif','Usuel');

?>