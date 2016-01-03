<?php
/**
 * Fichier crée le 03/01/2016 par YT
 * Codage : utf8
 * Page d'accueil du site
 **/

// Appels usuels
session_start();
require_once('php/connexion.inc.php');

// entetePage('', NOMBASE, '', $droit_le);

html('<html>');
html('<head>');
html('<title>Ptites Notes</title>');
html('<link rel="stylesheet" type="text/css" href="css/presentation.css" media="screen">');
html('</head>');
html('');  
html('<body>');

html('<div id="page">');
html('<div id="titrepage">');
html('<h1>Ptites Notes</h1>');
html('</div>');

html('<div id="textepage">');
$requete = "SELECT * FROM messages ORDER BY me_id DESC";
$resultat = ExecRequete($requete,$connexion);
// $nbactions = MYSQL_NUM_ROWS($resultat);	
$objet = ObjetSuivant($resultat);   
do
    {
	html('<div class="message">');
	html('<div class="entete">' . dateComplete($objet->me_date) .'</div>');	
	html('<div class="titre">' . $objet->me_titre .'</div>');
	html('<div class="texte">');
	html($objet->me_texte);
	html('</div>');
	html('<div class="signature">');
	html('Publié par '. $objet->me_auteur .' à '. horaireSeul($objet->me_date));
	html('</div>');
	html('</div>');
    }
while ($objet=ObjetSuivant($resultat));
html('</div>');
html('<div id="margepage">');
html('Un peu de marge.<br>Histoire de voir<br>Ce qui est faisable');
html('</div>');
html('<div id="vide"></div>');

html('<div id="finpage">');
html('</div>');
piedPage();
?>