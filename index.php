<?php
/**
 * Fichier crée le 03/01/2016 par YT
 * Codage : utf8
 * Page d'accueil du site
 **/

// Appels usuels
session_start();
require_once('php/connexion.inc.php');

entetePage(SITE);
html('<div id="titrepage">');
html('P\'tites Notes');
html('</div>');
html('<div id="filetpage">');
html('');
html('</div>');
html('<div id="filetpage2">');
html('');
html('</div>');

html('<div id="textepage">');
$requete = "SELECT * FROM messages ORDER BY me_id DESC";
$resultat = ExecRequete($requete,$connexion);
// $nbactions = MYSQL_NUM_ROWS($resultat);	
$objet = ObjetSuivant($resultat);   
$date="1900-01-01";
do
    {
	html('<div class="message">');
        if ($date!=dateFr($objet->me_date))
	    html('<div class="entete">' . dateComplete($objet->me_date) .'</div>');	
	html('<div class="titre">' . $objet->me_titre .'</div>');
	html('<div class="texte">');
	html($objet->me_texte);
	html('</div>');
	html('<div class="signature">');
	html('Publié par '. $objet->me_auteur .' à '. horaireSeul($objet->me_date));
	html('</div>');
	html('</div>');
	$date=dateFr($objet->me_date);
    }
while ($objet=ObjetSuivant($resultat));
html('</div>');

// La colonne de droite et ses rubriques
html('<div id="margepage">');

afficheCitations();
afficheLiens();
afficheBlogNotes();
afficheArchives();
afficheStats();
afficheProfil();

html('</div>');

// Le peu de code nécessaire pour ajuster les deux colonnes.
html('<div id="vide"></div>');

// La fin de page
html('<div id="finpage">');
html('</div>');
piedPage();
?>