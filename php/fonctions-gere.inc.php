<?php

function AccesPossible($utilisateur,$droitmin)
  {
  if (!$droitmin) 
    {
    $messageinfo = ucfirst($utilisateur).'</b>, vos droits ne vous permettent pas d\'accéder à cette page.<br>'
               .'Contacter l\'administrateur pour étendre ceux-ci si besoin est.<b>';
    AfficheMessage($message,$messageinfo,1);  
    exit;
  } }

// Gestion des règles d'apostrophes.
function GereQuote($texte)
{
	if (!get_magic_quotes_gpc())
		return addslashes($texte);
	else
		return $texte;
}
  
// Différents calculs.
function ControleEMail($email)
  { // Contrôle d'un mail par une expression régulière (...à décrypter...)
  return eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email);
  }
 
function ValeurSemiAuto($manuel,$auto)
  { // Récupération des minutes d'un horaire
  if ($manuel!='')
    return $manuel;
  else 
    return $auto;
  }

function FiltreCoords($coords)
  {// Gestion de filtres de coordonnées
  $resultat=array();
  if (($coords==1) OR (($coords==2) OR ($coords==5)))
    $resultat[]=1;
  else
    $resultat[]=0;
  if (($coords==1) OR (($coords==4) OR ($coords==6)))
    $resultat[]=1;
  else
    $resultat[]=0;
  if (($coords==1) OR (($coords==3) OR (($coords==5) OR ($coords==6))))
    $resultat[]=1;
  else
    $resultat[]=0;
  return $resultat;    
  }
  
// Autres
function NiveauDroit($utilisateur,$connexion)
  { // Gestion des droits
  $requete  = "SELECT in_droits FROM internautes WHERE in_pseudo='$utilisateur'";
  $resultat = ExecRequete($requete,$connexion);
  $objet    = ObjetSuivant($resultat);
  return $objet->in_droits;
  }

function GereDroit($droit,$droitref)
  {// Gestion des droits
  if ($droit>=$droitref)
    return 1;
  else
    return 0;
  }
  
function EstEntete($valeur)
  {
  if (!$valeur)
    return 1;
  else
    return 0;
  }  

function GereStyleEnTete($entete,$style1,$style2)
  {
  if ($entete==1)
    return $style1;
  else
    return $style2;
  } 

function AdressePropre($valeur,$valeurnulle,$npai)
  {
  if (($npai==1) || ($valeur==$valeurnulle)) 
    return ''; 
  else 
    return strtoupper($valeur);
  }
function GereScolaire($scol1,$scol2)
  {
  if ($scol1) return $scol1;
  if ($scol2) return $scol2;
  }

function GereChampsDoubles($id,$connexion)
  { // Mise à jour de la table adhérents quand la table adhésions est modifiée.
  $requete = "SELECT * FROM adhesions WHERE ad_adherent='$id' AND ad_etat='1' ORDER BY ad_annee DESC ";
  $resultat = ExecRequete($requete,$connexion);
  $compteur = MYSQL_NUM_ROWS($resultat);
  if ($compteur>1)  
    $requete3 ="UPDATE personnes SET pe_ancien='1' WHERE pe_id='$id'";
  else
    $requete3 ="UPDATE personnes SET pe_ancien='0' WHERE pe_id='$id'";
  $resultat3 = ExecRequete($requete3,$connexion);  

  if ($compteur>0)  
    {
    $objet=ObjetSuivant($resultat);
    $requete2 ="UPDATE personnes SET pe_annee9='$objet->ad_annee' WHERE pe_id='$id'";
    $resultat = ExecRequete($requete2,$connexion);  
    }
  else
    {
    $objet=ObjetSuivant($resultat);
    $requete2 ="UPDATE personnes SET pe_annee9='0' WHERE pe_id='$id'";
    $resultat = ExecRequete($requete2,$connexion);  
  } }

function GereSortie18($id,$datenaissance,$annee, $connexion)
  {
  if (ageactuel($datenaissance,date("Y-m-d"))> 17);
    {
    $requete2 = "UPDATE adhesions SET ad_sortie='1'"
              ." WHERE ad_adherent ='$id' AND ad_annee='$annee' AND ad_etat='1'";
    $resultat2 = ExecRequete($requete2,$connexion);
  } }

function Identite($id,$connexion,$sujet)
  { // Restitution du nom et du prénom  
  //if ($sujet=="sa")
    //$texterequete = "SELECT sa_nom, sa_prenom, sa_datenaissance FROM salaries WHERE sa_id='$id'";
  //else
    $texterequete = "SELECT pe_nom, pe_prenom,pe_raisonsoc,pe_morale FROM personnes WHERE pe_id='$id'";
  return ObjetSuivant(ExecRequete($texterequete,$connexion));
  }

function GereOrdre($defaut,$tri,$senstri,$lien)
  {
  $ordre = $defaut;  
  if ($tri!='')      $ordre = " ORDER BY ".$tri;  
  if ($senstri==1)   $ordre.= " DESC";  
  $resultat=array();
  $resultat[]=$lien.'&senstri='.(1-$senstri);
  $resultat[]=$ordre;
  return $resultat;  
  }

function GereLimite($nonlimite)  
  {
  if ($nonlimite!=0)
    $limitation ="";
  else 
    $limitation = " LIMIT 0,1000";
  return $limitation;
  }
  
function GereNote($saisie,$domaine1,$domaine2)
  {
  if (($saisie) && ($domaine2!=''))
    return " AND (".$domaine1."_note1 like '%".$saisie."%' OR ".$domaine1."_note2 like '%".$saisie."%'"
                 ." OR ".$domaine2."_note1 like '%".$saisie."%' OR ".$domaine2."_note2 like '%".$saisie."%')";
  elseif ($saisie)
    return " AND (".$domaine1."_note1 like '%".$saisie."%' OR ".$domaine1."_note2 like '%".$saisie."%')";
  else
    return '';
  }

function GereNotePasVide($saisie,$domaine1,$domaine2)
  {
  if (($saisie) && ($domaine2!=''))
    return " AND ((".$domaine1."_note1!='' AND ".$domaine1."_note1 IS NOT NULL)"
                  . " OR (".$domaine1."_note2!='' AND ".$domaine1."_note2 IS NOT NULL)"
                  . " OR (".$domaine2."_note1!='' AND ".$domaine2."_note1 IS NOT NULL)"
                  . " OR (".$domaine2."_note2!='' AND ".$domaine2."_note2 IS NOT NULL))";
  elseif ($saisie)
    return " AND ((".$domaine1."_note1!='' AND ".$domaine1."_note1 IS NOT NULL)"
                  . " OR (".$domaine1."_note2!='' AND ".$domaine1."_note2 IS NOT NULL))";
  else
    return '';
  }

function GereCommentaire1($ajout,$domaine,$note,$utilisateur,$droit,$cejour,$cemoment)
  {// Gestion des deux commentaires possibles selon les droits.
  if ($ajout!='') // Il y a un commentaire
    $note = '[' .datefr($cejour). '(' .$cemoment. '):' .$utilisateur. '] ' .$ajout. '\r' .$note; 
  // On génère le bout de texte à insérer dans les requêtes
  return $domaine."_note='$note' ";
  }

function GereCommentaire2($ajout,$domaine,$note1,$note2,$utilisateur,$droitmin,$cejour,$cemoment)
  {// Gestion des deux commentaires possibles selon les droits.
  if ($ajout!='') 
    {// Il y a un commentaire
    if ($droitmin)
      $note2 = '[' .datefr($cejour). '(' .$cemoment. '):' .$utilisateur. '] ' .$ajout. '\r' .$note2; 
    else
      $note1 = '[' .datefr($cejour). '(' .$cemoment. '):' .$utilisateur. '] ' .$ajout. '\r' .$note1; 
    }
  // On génère le bout de texte à insérer dans les requêtes
  if ($droitmin)   // les habilités peuvent modifier les deux commentaires. Les autres un seul.
    return $domaine."_note1='$note1', ".$domaine."_note2='$note2' ";
  else
    return $domaine."_note1='$note1' ";
  }

function TronqueChaine($chaine,$taille)
  {
  if (strlen($chaine) > $taille)
    {
    $chaine = substr($chaine, 0, $taille);
    $last_space = strrpos($chaine, " ");
    $chaine = substr($chaine, 0, $last_space)."...";
    }
  return $chaine;
  }
?>