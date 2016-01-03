<?php  // Fonctions utilisées pour gérer des affichages. 

// Gestion de correction d'affichage de valeurs des bases

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

function Pourcentage($valeur)
  {
  if ($valeur)
    return (round($valeur*1000)/10).'%';
  else 
    return '-';
  }

function TraduitCategorie($valeur)
  {
  global $categories_liste;
  return $categories_liste[$valeur];
  }

function TraduitOuiNon($valeur)
  {
  if ($valeur=='')
    return '';
  elseif ($valeur=="0")
    return 'Non';
  elseif ($valeur=="1")   
    return 'Oui';
  }

function FORMexcel($texte0,$texte1,$minimal)
  { // Bouton d'export Excel
  html('<form method="post" action="bordereau.php">');
  $vide='';
  $dec = FormCache('texte0',$texte0,$vide,$vide);
  $dec = FormCache('texte1',$texte1,$vide,$vide);
  $dec = FormCache('minimal',$minimal,$vide,$vide);
  html('<center><input type="submit" value="Export Excel" class="boutonlarge"></center>');
  html('</form>');
  }

function InfoCompteur($compteur, $aucun, $un, $pluriel)
  { // Gestion de l'information des compteurs.
  if ($compteur==0) 
    html('<br><center><b>'.$aucun.' trouvé.</b></center><br>');
  else 
    {
    if ($compteur==1) 
      html('<br><center><b>'.$un.'</b> trouvée.</center><br>');
    else 
      html('<br><center><b>'.$compteur.' '. $pluriel.'</b> trouvées.</center><br>');
  } }

function LienEdition($id)
{ // Lien d'édition avec icône
    $page="action-modif.php";
    $titre="Editer cette action";
    $image="img/edition.png"; 
    return '<a href="'.$page.'?id='.$id.'"><img src="'.$image.'" alt="'.$titre.'" border="0"></a>';  
}

function LienReport($id,$periojours,$periomois)
{ // Lien d'édition avec icône
    $page="actions.php";
    $titre="Editer cette action";
    $image="img/report.png"; 
    return '<a href="'.$page.'?id='.$id.'&reportaction=1&periojours='.$periojours.'&periomois='.$periomois.'"><img src="'.$image.'" alt="'.$titre.'" border="0"></a>';  
}

function LienValidation($id)
{ // Lien de report avec icône
    $page="actions.php";
    $titre="Valider cette action";
    $image="img/validation.png";
    return '<a href="'.$page.'?id='.$id.'&validaction=1"><img src="'.$image.'" alt="'.$titre.'" border="0"></a>';  
}

function LienSuppression($id)
{ // Lien de report avec icône
    $page="action-suppr.php";
    $titre="Reporter cette action";
    $image="img/suppression.png";
    return '<a href="'.$page.'?id='.$id.'" alt="'.$titre.'"><img src="'.$image.'" alt="'.$titre.'" border="0"></a>';  
}

function AfficheMessage($message,$messageinfo,$avecligne)
  {
  if ($avecligne)
    {
    Ligne();
    html('<center><b class="alerte">'.$message.'</b></center>');
    html('<center><b>'.$messageinfo.'</b></center>');
    Ligne();  
    }
  else
    {
    html('<center><b class="alerte">'.$message.'</b></center>');
    html('<center><b>'.$messageinfo.'</b></center><br>');
  } }
  
function AfficheMAJ($texte1,$texte2,$date1,$date2,$saisie1,$saisie2,$couleur)
  {
  html('<center><font size="1">');
  html('Mise à jour '.$texte1.' le <font color="'.$couleur.'">'.TempsFr($date1).'</font> par <b>'.$saisie1.'</b>');
  if ($date2)
    html('  - Mise à jour '.$texte2.' le <font color="'.$couleur.'">'.TempsFr($date2).'</font> par <b>'.$saisie2.'</b>');
  html('</font></center>');
  }
  
function Icones($id,$code)
  {
  return '<img src="img/'.$code.'.png" id="type'.$id.'" onclick="changeicone('.$id.','.$code.');">';
  }

function TitreAction($titre,$note)
  {
  if ($note=='')
    return '<b>'.$titre.'</b>';
  else
    return '<b>'.$titre.'</b> - '.TronqueChaine($note,60);
  }

function afficheActions ($texterequete,$titre,$saisie,$nbtotal,$connexion)
{
    $resultat = ExecRequete("SELECT ".$texterequete,$connexion);
    $compteur = MYSQL_NUM_ROWS($resultat);
    if ($compteur>0)
    {
        $objet = ObjetSuivant($resultat);    
        $titre = $titre." &nbsp;&nbsp;—&nbsp;&nbsp; ".$compteur." / ".$nbtotal;
        html('<div class="titrelisteaction">'.$titre.'</div>');
        TableIni('970','rien');
        do
        { // On ne gère pas ici l'en-tête de tableau, ce que les fonctions font en temps normal.
            LigneIni('');
            Cellule2('Action',$objet->id,20,'corpsc1,centre',$saisie);
            Cellule2('Type',Icones($objet->id,$objet->type),16,'corpsnt1',1);
            Cellule2('Catégorie',traduitcategorie($objet->categorie),80,'corps1',1); /*corpstc1*/
            Cellule2('Projet',$objet->projet,120,'corps1',1);
            Cellule2('Titre',TitreAction($objet->titre,$objet->note),'','corpsg1',1); /*corpst1*/
            Cellule2('Qui',$objet->qui,70,'corps1',1);
            Cellule2('Evénement',DateLisible($objet->date),70,'corps1',1);
            Cellule2('Création',DateTexteCoursFr($objet->datesaisie1),20,'corps1',$saisie);
            Cellule2('Modification',DateTexteCoursFr($objet->datesaisie9),20,'corps1',$saisie);
            Cellule2('Edit.',LienEdition($objet->id),16,'corpsnt1',1);
            //Cellule2('Actions',LienEdition($objet->id).' '.LienReport($objet->id,$objet->periojours,$objet->periomois)
			//         .' '.LienValidation($objet->id).' '.LienSuppression($objet->id),76,'corpsnt2',1);
            Cellule2('Report',LienReport($objet->id,$objet->periojours,$objet->periomois),16,'corpsnt1',1);
            Cellule2('Valid.',LienValidation($objet->id),16,'corpsnt1',1);
            Cellule2('Suppr.',LienSuppression($objet->id),16,'corpsnt1',1);
            LigneFin();
        } 
    while ($objet=ObjetSuivant($resultat));
    TableFin(1,0);
    }
}
  
?>