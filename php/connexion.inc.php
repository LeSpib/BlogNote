<?php
// Ensemble des variables
require_once("a-charger/variables-locales.inc.php"); // Fichier avec les variables propres à chaque environnement (base, bacasable, maison...)
require_once("php/variables-generales.inc.php");     // Variables classiques
require_once("php/variables-nettoyees.inc.php");     // Variables des formulaires que l'on définit au besoin à vide.

// Appel des fonctions de base
require_once("php/fonctions-session.inc.php");       // Fonctions pour MySQL et sessions
require_once("php/fonctions-gere.inc.php");          // Fonctions courantes
require_once("php/fonctions-gere-date.inc.php");     // Fonctions courantes pour les dates et horaires
require_once("php/fonctions-html.inc.php");          // Fonctions HTML
require_once("php/fonctions-tableaux.inc.php");      // Fonctions des formulaires
require_once("php/fonctions-script.inc.php");        // Fonctions pour javascript
require_once("php/fonctions-affiche.inc.php");       // Fonctions de présentation
require_once("php/fonctions-presentation.inc.php");  // Fonctions de présentation

// Connexion à MySQL
$connexion   = Connexion(NOM,PASSE,BASE,SERVEUR);

// Variables fondamentales
// $session     = ControleAcces ($page, $_POST, session_id(), $connexion);
// $utilisateur = UtilisateurSession(session_id(),$connexion);
// if ($session == '') exit; // si la session est invalide, on affiche rien de plus

// $droit       = NiveauDroit($utilisateur,$connexion);
// $droitinf    = GereDroit($droit,DROITINF);
// $droitsec    = GereDroit($droit,DROITSEC);
// $droitdir    = GereDroit($droit,DROITDIR);
// $droitadm    = GereDroit($droit,DROITADM);
// $droitsup    = GereDroit($droit,DROITSUP);

// Récupération des variables en entrée et retraitements usuels
extract($_REQUEST, EXTR_PREFIX_ALL|EXTR_REFS, 'nouv');

if (!$nouv_annee) $nouv_annee=date('Y');
?>