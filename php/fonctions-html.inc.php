<?php // Fonctions utilisées pour gérer les balises HTML

/*
 *  Gestion minimale des lignes HTML  
 */

function html($ligne) 
{ // Pour un HTML lisible (dans le doc PHP et dans le fichier HTML créé)
    global $espace;
    echo "$espace$ligne \n";
}

/*
 *  Gestion des champs de formulaire  
 */

function INPUThid($champs,$valeur)
{ // Gestion des INPUT HIDDEN
    html('<input type="hidden" name="'.$champs.'" value="'.$valeur.'">');
}

function INPUTtexte($champs,$valeur,$style,$taille,$specifique,$verrou)
{ // Gestion des INPUT TEXTE
    html('<input type="text" name="'.$champs.'" size="'.$taille.'"' 
         .' maxlenght="40" class="'.$style.'"' 
         .' value="'.stripslashes($valeur).'"'.$specifique.''.$verrou.'>');
    if ($verrou != '')   FormCache($champs,$valeur,'');
}

// YT : vérifier l'intérêt compte tenu de INPUTtexte
function INPUTtextedis($champs,$valeur,$style,$taille,$specifique,$verrou)
{ //  Gestion des INPUT TEXTE vérouillés
    html('<input type="text" name="'.$champs.'" size="'.$taille.'"' 
         .' maxlenght="40" class="'.$style.'"' 
         .' value="'.$valeur.'"'.$specifique.' disabled>');
}

function INPUTpasse($champs,$valeur,$style,$taille)
{ // Gestion des INPUT PASSWORD
    html('<input type="password" name="'.$champs.'" size="'.$taille.'"'
         .' maxlenght="40" class="'.$style.'" value="'.$valeur.'">');
}

function INPUTtexteA($champs,$valeur,$style,$col,$row,$verrou)
{ // Sélection : texte double
    html('<textarea type="text" name="'.$champs.'" cols="'.$col.'"' 
         .' rows="'.$row.'" class="'.$style.'"'.$verrou.'>'.$valeur
         .'</textarea>');
	  if ($verrou!='')  FormCache($champs,$valeur,$vide);
}		

function INPUTcoche($champs,$valeur,$reference,$verrou)
{ // Bouton : coche
    if ($reference==$valeur)   
		$valide='checked="checked"';
    else
		$valide='';
	html('<input type="checkbox" name="'.$champs.'" value="'.$reference
         .'" '.$valide.$verrou.'>');
	  if ($verrou!='')  FormCache($champs,$valeur,$vide);
}	

function select($champs,$valeur,$lis1,$lis2,$nb,$paszero,$plusun,$speci,$verrou)
{ // Gestion des SELECT
    html('<select name="'.$champs.'" id="'.$champs.'" size="1"'.$speci
         .$verrou.'>');
    for ($i=$paszero;$i<$nb+$plusun;$i++)
    {
        if ($lis1[$i] == '')  $lis1[$i] = $i;
        if ($lis1[$i] == $valeur)
           $sel = ' selected';
        else
           $sel = '';
        html('<option value="'.$lis1[$i].'"'.$sel.'>'.$lis2[$i]
             .$texte.'</option>');
    }
    html('</select>');
    if ($verrou!='')  FormCache($champs,$valeur,'');
}

function SELECTanneesco ($champs,$valeur,$vide,$verrou)
{ // YT: revoir le code
    $anneemax = date("Y");
    html('<select name="'.$champs.'" size="1"'.$verrou.'>');
    list($annee, $mois, $jour) = explode("-", $valeur);
    if ($vide==1)
    {
        if ($annee == 0) 
            html('  <option value="0" selected></option>');
        else
            html('  <option value="0"></option>');
    }
    for ($i=$anneemax;$i>=2000;$i--)
    {
        if ($i == $annee) 
            html('  <option value="'.$i.'" selected>'.scolaire($i).'</option>');
        else
            html('  <option value="'.$i.'">'.scolaire($i).'</option>');
    }
    html('</select>');
}

/*
 *  Gestion des champs de formulaire   -> VuYT
 */ 


// <table>
function TableIni($large,$style)
{
  global $espace;
  if ($large=='') html('<table class="'.$style.'" align="center">');
  else            html('<table width="'.$large.'" class="'.$style.'" align="center">');
  $espace .= '  ';
}

function TableFin($tr,$saut)
{
    global $espace;
    if ($tr==1) LigneFin();
    $espace = substr($espace,1,strlen($espace)-2); 
    html('</table>');
    if ($saut!='')  html('<br>');
    html('');
}

// <tr>
function LigneIni($style)
{
    global $espace;
    if ($style)     html('<tr class="'.$style.'">');
    else            html('<tr>'); 
    $espace .= '  ';
}

function TRdebut($titre)
{ // Fonction utilisée pour coder les débuts de liste.
    global $titretablarg;
    LigneIni('corps1');
    CelluUni($titre,'',$titretablarg,''); // Un des rares paramètres figés dans le code. Modifiable à merci.
    CelluIni('','','');
}

function TRfin() 
{ // Fonction utilisée pour coder les fins de liste.
    CelluFin();
    LigneFin();
}

function LigneMil($style)
{
    global $espace;
    $espace = substr($espace,1,strlen($espace)-2); 
    html('');
    if ($style)     html('</tr><tr class="'.$style.'">');
    else            html('</tr><tr>'); 
    html('');
    $espace .= '  ';
}

function LigneFin()
{
    global $espace;
    $espace = substr($espace,1,strlen($espace)-2); 
    html('</tr>'); 
}

// <td>
function Cellule($titre,$valeur,$lien,$tri,$entete,$condition)
{
    if ($condition==1)
    {
        if ($entete==0)
        {
            if ($valeur=='') $valeur='&nbsp;';
            CelluUni($valeur,'','','');
        }
    else
        CelluleEntete($titre,$lien,$tri);
    }
}

function Cellule2($titre,$valeur,$large,$style,$condition)
{
    if ($condition==1)
    {
        if ($valeur=='') $valeur='&nbsp;';
        CelluUni($valeur,'',$large,$style);
    }
}

function CellulePres($numero,$titre,$champs,$participation,$valeur,$semaine,$lien,$tri,$entete,$condition,$espace)
  {
  $presences_liste = array('','P','A','E');
  if ($condition==1)
    {
    if ($entete==0)
      {
      if ($semaine<$titre)
        {
        CelluIni('','','',$espace);
        Select($champs.'1['.$numero.']',$valeur,$presences_liste,$presences_liste,4,0,0,'','disabled',$espace.'    ');
        CelluFin($espace); 
        }
      else
        {
        CelluIni('','','',$espace);
        Select($champs.'1['.$numero.']',$valeur,$presences_liste,$presences_liste,4,0,0,'',$verrou,$espace.'    ');
        INPUThid($champs.'2['.$numero.']',$participation);
        INPUThid($champs.'3['.$numero.']',$titre);
        CelluFin($espace); 
        }
      }
    else
      CelluleEntete($titre,$lien,$tri,$espace);
    }
  return $espace;
  }

function CellulePres2($titre,$numero,$champs,$valeur,$participation,$lien,$tri,$entete,$verrou,$condition,$espace)
  {
  $presences_liste = array('','P','A','E');
  if ($condition==1)
    {
    if ($entete==0)
      {
      CelluIni('','','',$espace);
      Select($champs.'1['.$numero.']',$valeur,$presences_liste,$presences_liste,4,0,0,'',$verrou,$espace.'    ');
      INPUThid($champs.'2['.$numero.']',$participation);
      INPUThid($champs.'3['.$numero.']',$titre);
      CelluFin($espace);
      }
    else
      CelluleEntete($titre,$lien,$tri,$espace);
    }
  return $espace;
  }

function CelluleEntete($titre,$lien,$tri)
{
    if ($tri)
        CelluUni('<a href="'.$lien.'&tri='.$tri.'">'.$titre.'</a>','','','');
    else if ($lien)
        CelluUni('<a href="'.$lien.'">'.$titre.'</a>','','','');
    else
        CelluUni($titre,'','','');
  }

function CelluUni($valeur,$colonne,$large,$style)
{ // Une cellule unique d'une table
    $balise = '<td';
    if ($colonne != '')  $balise.= ' colspan="'.$colonne.'"';
    if ($large != '')    $balise.= ' width="'.$large.'"';
    if ($style != '')    $balise.= ' class="'.$style.'"';
    html($balise.'>'.$valeur.'</td>'); 
}

function CelluIni($colonne,$large,$style)
{
    global $espace;
    $balise = '<td';
    if ($colonne!='')  $balise.= ' colspan="'.$colonne.'"';
    if ($large!='')    $balise.= ' width="'.$large.'"';
    if ($style!='')    $balise.= ' class="'.$style.'"';
    html($balise.'>'); 
    $espace .='  ';
}

function CelluMil($colonne,$large,$style,$espace)
  {
  $espace = substr($espace,1,strlen($espace)-2); 
  $balise = '</td><td';
  if ($colonne!='')  $balise.= ' colspan="'.$colonne.'"';
  if ($large!='')    $balise.= ' width="'.$large.'"';
  if ($style!='')    $balise.= ' class="'.$style.'"';
  html($espace.$balise.'>'); 
  return $espace.'  ';
  }

function CelluFin()
{
    global $espace;
    $espace = substr($espace,1,strlen($espace)-2); 
    html('</td>'); 
}

function FormIni($formulaire,$bouton,$page,$methode)  
{ // 
    html('<script language="JavaScript"><!-- document.'.$formulaire.'.'.$bouton.'.disabled=true; --></script>');
    html('<form name="'.$formulaire.'" method="'.$methode.'" action="'.$page.'" onSubmit="'.$bouton.'.disabled=true;">');
}

function FormFin($formulaire,$bouton,$titre,$droitmin)  
{
    if ($droitmin==1) html('<input class="boutonlarge" type="submit" name="'.$bouton.'" value="'.$titre.'">');
    html('</form>'); 
    html('<script language="JavaScript"><!-- document.'.$formulaire.'.'.$bouton.'.disabled=true; --></script>'); 
}

function TabletteIni($large,$style)
{
    global $espace;
    html('<td width="'.$large.'" style="vertical-align:top">');
    $espace .='  ';
    TableIni('100%',$style);
}

function TabletteFin()
{ //
    TableFin(0,0);
    CelluFin();
}

function FormulaireMil()  
{ //
    TabletteFin();
    TabletteIni('450','');
}

function FormBoutonIni($formulaire,$bouton,$page,$methode,$debut)  
{ // 
    if ($debut==1)
    {
        TableIni('','rien');
        LigneIni('');
    }
    CelluIni('','','');
    FormIni($formulaire,$bouton,$page,$methode);  
}

function FormBoutonFin($formulaire,$bouton,$titre,$fin,$droitmin)  
{ //
    FormFin($formulaire,$bouton,$titre,$droitmin);     
    CelluFin();
    if ($fin==1)  
    {
        LigneFin();
        TableFin(0,0);  
    }
}

function FormulaireIni($formulaire,$bouton,$page,$methode,$simple) 
{ //
    FormIni($formulaire,$bouton,$page,$methode);
    TableIni('','choix');
    if ($simple==0)  
    {
        LigneIni('');  // YT : modifié pour voir... (ano provenait de index.php)
        TabletteIni('450','');
    }
}

function FormulaireFin($formulaire,$bouton,$titre,$simple,$droitmin)  
{ //
    if ($simple != 1)
    {
        TabletteFin();
        LigneFin();
    }
    TableFin(0,0);
    html('<br>');
    TableIni('','rien');
    LigneIni('');
    CelluIni('','','');
    FormFin($formulaire,$bouton,$titre,$droitmin); 
    CelluFin();
    LigneFin();
    TableFin(0,0);
}

?>