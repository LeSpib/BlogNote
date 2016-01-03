<?php
/**
 * Fichier crée le 03/01/2016 par YT
 * Codage : UTF8
 * Fonctions gérant des dates et temps
 **/

function tempsFr($date)
{   // Format de date français (avec horaire)
    list($annee, $mois, $temp) = explode("-", $date);
    list($jour, $temp2) = explode(" ", $temp);
    list($heure, $minute, $seconde) = explode(":", $temp2);
    if ($annee==1904)
        return '';
    else
        return $jour . '-' . $mois . '-' . $annee .' ('.$heure.'h'.$minute.')';
}

function supprimeHeure($temps)
{   // Suppression de l'horaire d'un temps pour ne garder que la date
    if (strpos($temps,' ')===false)
    {
        $date = $temps;
    }
    else
    {
        list($date, $heure) = explode(" ", $temps);
    }
    return $date;
}

function annee($date)
{   // Restitution de l'année
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $annee = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $annee = $date;
    }
    else
    {   // extraction de l'année
        $date = supprimeHeure($date);
        list($annee, $mois, $jour) = explode("-", $date);
    }
    return $annee;
}

function mois($date)
{   // Restitution du mois
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $mois = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $mois = $date;
    }
    else
    {   // extraction du mois
        $date = supprimeHeure($date);
        list($annee, $mois, $jour) = explode("-", $date);
    }
    return $mois;
}

function jour($date)
{ // Restitution du jour
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $jour = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $jour = $date;
    }
    else
    {   // extraction du jour
        $date = supprimeHeure($date);
        list($annee, $mois, $jour) = explode("-", $date);
    }
    return $jour;
}

function dateFr($date)
{ // Format de date français [jj-mm-aaaa]
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $resultat = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $resultat = $date;
    }
    else
    {   // extraction de la date
        $date = supprimeHeure($date);
        list($annee, $mois, $jour)  = explode("-", $date);
        $resultat = $jour . '-' . $mois . '-' . $annee;
    }
    return $resultat;
}

function dateComplete($date)
{ // Format de date français [jour jj mois aaaa]
    global $jours_liste;
    global $mois_liste;
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $resultat = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $resultat = $date;
    }
    else
    {   // extraction de la date
        $date = supprimeHeure($date);
        list($annee, $mois, $jour)  = explode("-", $date);
        $timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
        $jourFr  = $jours_liste[date("w",$timestamp)+1];
        $resultat = $jourFr .' '. intval($jour) . ' ' . $mois_liste[intval($mois)] . ' ' . $annee;
    }
    return $resultat;
}
  
function dateTexteCoursFr($date)
{   // Conversion date SQL longue en date française texte
    global $moiscourts_liste;
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $resultat = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $resultat = '';
    }
    else
    {
        $date = supprimeHeure($date);
        list($annee, $mois, $jour) = explode("-", $date);
        if ($jour<10) $jour = $jour+0;
        if ($jour==1) $jour = $jour.'er';
        $resultat = $jour . ' ' . $moiscourts_liste[$mois+0];
    }
    return $resultat;
}

function horaireSeul($date)
{   // Récupération d'un horaire sans les secondes
    if ($date=='')
    {
        return '-';
    }
    else
    {
        list($date, $horaire) = explode(" ", $date);
		list($heure, $minute, $seconde) = explode(":", $horaire);
        if ($heure==0)
        {
            return "-";
        }
        else
        {
            return $heure . ':' . $minute; 
        }
    }
}

function horaire($horaire)
{   // Récupération d'un horaire sans les secondes
    if ($horaire=='')
    {
        return '-';
    }
    else
    {
        list($heure, $minute, $seconde) = explode(":", $horaire);
        if ($heure==0)
        {
            return "-";
        }
        else
        {
            return $heure . ':' . $minute; 
        }
    }
}

function dateJourSemaine($date)
{   // Restitution du nom du jour d'une date
    global $jours_liste;
    if ((empty($date)) or ($date=="NULL"))
    {   // la date est vide
        $resultat = '';
    }
    elseif (strpos($date,'-')===false) 
    {   // la date proposée n'a pas de format classique
        $resultat = '';
    }
    else
    {   // extraction de la date
        $date = supprimeHeure($date);
        list($annee, $mois, $jour) = explode("-", $date);
        $timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
        $resultat  = $jours_liste[date("w",$timestamp)+1];
    }
    return $resultat;
}

function heure($horaire)
{ // Récupération de l'heure d'un horaire
    if ((empty($horaire)) or ($horaire=="NULL"))
        $heure='';
    else
        list($heure,$minute,$seconde) = explode(":", $horaire);
    return $heure;
}

function minute($horaire)
{ // Récupération des minutes d'un horaire
    if ((empty($horaire)) or ($horaire=="NULL"))
        $minute='';
    else
        list($heure,$minute,$seconde) = explode(":", $horaire);
    return $minute;
}

function dateSQL($jour,$mois,$annee)
{   // Concaténation de jj, mm, aaaa en ['aaaa-mm-jj'] (SQL)
    if ((($jour==0) or ($mois==0)) or ($annee==0))
        return "NULL";
    else 
        return "'".$annee."-".$mois."-".$jour."'";
}

function dateFrSQL($date)
{ // Conversion de l'année [jj/mm/aaaa] en [aaaa-mm-jj] (SQL)
    if ((empty($date)) or ($date=="NULL"))
        return "NULL";
    else
    {
        list($jour, $mois, $annee) = explode("/", $date);
        return dateSQL($jour,$mois,$annee);
    }
}

function dateSQLFr($date)
{ // Récupération de l'année
    if ((empty($date)) or ($date=="NULL"))
        return "";
    else
    {
        list($annee, $mois, $jour) = explode("-", $date);
        if ((($jour==0) or ($mois==0)) or ($annee==0))
            return "";
        else 
            return $jour."/".$mois."/".$annee;
    }
}

function dureeMinute($heuredebut, $heurefin)
{ // Calcule la durée en minute
    $duree = mktime(heure($heurefin), minute($heurefin), 0, 0, 0, 1)
             - mktime(heure($heuredebut), minute($heuredebut), 0, 0, 0, 1);
    $duree = round($duree/60);
    return $duree;
}

function ageActuel($date1,$date2)
{ // Calcul d'âge
    if (((mois($date1)==mois($date2)) and (jour($date2)<jour($date1))) or (mois($date2)<mois($date1)))
        $age = annee($date2) - annee($date1) - 1;
    else
        $age = annee($date2) - annee($date1);   
    if ($age>100) $age=''; // Pour éviter les dates fausses.
    return $age;
}

function traduitJour($valeur)
{ // Conversion d'un numéro d'ordre en jour.
    global $jours_liste;
    if ($valeur=='')
        return '';
    else
        return $jours_liste[$valeur];
}

function dateLisible($date)
{
    if ($date=='')
        return '';
    else 
    {
        global $cejour;
        list($annee, $mois, $jour) = explode("-", $date);  // Attention, ne gère pas la présence d'une heure.
        $timestamp1 = mktime (0, 0, 0, $mois, $jour, $annee);

        list($annee, $mois, $jour) = explode("-", $cejour);  // Attention, ne gère pas la présence d'une heure.
        $timestamp2 = mktime (0, 0, 0, $mois, $jour, $annee);

        if ($timestamp1==$timestamp2)
            return 'aujourd\'hui';
        else if ($timestamp1<$timestamp2)
            return dateTexteCoursFr($date); // '<div class="retard">'.DateTexteCoursFr($date).'</div>';
        else if ($timestamp1 - $timestamp2 < 24*60*60*2)
            return 'demain';
        else if ($timestamp1 - $timestamp2 < 8*24*60*60)
            return dateJourSemaine($date);
        else
            return dateTexteCoursFr($date);
    }
}

function minutesLisible($minutes)
{
    if ($minutes==0)
        return "-";
    else
    {
        $heures = floor($minutes/60);
        $minutes = $minutes - $heures*60 ;
        if ($minutes<1)
            return $heures . "h00";
        else if ($minutes<10)
            return $heures . "h0" . $minutes ;
        else
            return $heures . "h" . $minutes ;
    }
}

function DateFr2($date)
  { // Conversion date SQL longue en date française courte
  list($annee, $mois, $temp) = explode("-", $date);
  list($jour, $temp2) = explode(" ", $temp);
  if (($annee==1904) || ($annee==''))
    return '';
  else
    return $jour . '-' . $mois . '-' . $annee ;
  }

function DateFr3($date)
  { // Conversion date SQL longue en date française longue YT: Intérêt à vérifier...
  list($annee, $mois, $temp) = explode("-", $date);
  list($jour, $temp2) = explode(" ", $temp);
  if (($annee==1904) || ($annee==''))
    return '';
  else
    return $jour . '-' . $mois . '-' . $annee .' '.$temp2;
  }

function DateTexteFr($date)
  { // Conversion date SQL longue en date française texte
  global $mois_liste;
  list($annee, $mois, $temp) = explode("-", $date);
  list($jour, $temp2) = explode(" ", $temp);
  if (($annee==1904) || ($annee==''))
    return '';
  else
    return $jour . ' ' . $mois_liste[$mois-1] . ' ' . $annee ;
  }

function DateNonSQL($date)
  {
  list($avant, $date, $apres) = explode("'", $date);
  if (strlen($avant)<=1)
    return $date;
  else
    return $avant; // En l'absence de '', la date est dans la première chaine.
  }
?>