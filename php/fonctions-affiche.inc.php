<?php  
/**
 * Fichier crée le 03/01/2016 par YT
 * Codage : UTF8
 * Fonctions gérant des affichages
 **/

// Gestion de correction d'affichage de valeurs des bases
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


// Fonctions d'affichage locales
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

function afficheLiens()
{
	global $connexion;
	html('<div id="liens" class="rubrique">');
	html('<h1>P\'tits liens</h1>');
	html('<ul>');

	$requete = "SELECT * FROM liens ORDER BY li_titre";
	$resultat = ExecRequete($requete,$connexion);
	$objet = ObjetSuivant($resultat);   
	do
    {
		html('<li><a href="'. $objet->li_adresse.'">'. $objet->li_titre .'</a></li>');
    }
	while ($objet=ObjetSuivant($resultat));
	html('</ul>');
	html('</div>');
}

function afficheCitations()
{
	global $connexion;
	html('<div id="citations" class="rubrique">');
	html('<h1>P\'tite citation</h1>');
	$requete = "SELECT ci_texte, ci_auteur, ci_lienauteur, ci_source, ci_liensource from citations ORDER BY rand() LIMIT 0,1";
	$resultat = ExecRequete($requete,$connexion);
	$objet = ObjetSuivant($resultat);   
	html('<div class="texte">'. $objet->ci_texte .'</div>');
	if (empty($objet->ci_lienauteur))
	{
		html('<div class="auteur">'. $objet->ci_auteur .'</div>');
	}
	else
	{
		html('<div class="auteur"><a href="'. $objet->ci_lienauteur .'">'. $objet->ci_auteur .'</a></div>');
	}
	if (!empty($objet->ci_source))
	{
		if (empty($objet->ci_liensource))
		{
			html('<div class="source">'. $objet->ci_source .'</div>');
		}
		else
		{
			html('<div class="source"><a href="'. $objet->ci_liensource .'">'. $objet->ci_source .'</a></div>');
		}
	}
	html('</div>');
}

function afficheBlogNotes()
{
	global $connexion;
	html('<div class="rubrique">');
	html('<h1>P\'tits blog\'notes divins</h1>');
	html('</div>');
}

function afficheArchives()
{
	global $connexion;
	html('<div class="rubrique">');
	html('<h1>P\'tites archives</h1>');
	html('</div>');
}

function afficheStats()
{
	global $connexion;
	html('<div class="rubrique">');
	html('<h1>P\'tites statistiques</h1>');
	html('</div>');
}

function afficheProfil()
{
	global $connexion;
	html('<div id="profil" class="rubrique">');
	html('<h1>Le P\'tit Noteur</h1>');
	html('<img alt="Le Spib" height="80" src="//www.lespib.infini.fr/blog/avatar2.gif" width="80"/>');
	html('<b>Le Spib</b><br /> ');
	html('Homo Sapiens (ça en jette tout de suite, le «sapiens»). Je dirai même Homo Sapiens Ptitbritannicum, économiquement mixte.');
	html('</div>');
}
?>