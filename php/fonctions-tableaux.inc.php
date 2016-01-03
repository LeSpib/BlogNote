<?php // Fonctions utilisées pour gérer les tableaux et formulaires. 

function FormCache($champs,$valeur)
{ // Gestion des champs invisibles
    INPUThid($champs,$valeur);
    GereLien('&'.$champs.'='.$valeur);
}

function FormSimple($valeur,$colonnes)
{ // Formulaire : texte simple, sans titre.
    CelluUni('<b>'.$valeur.'</b>',$colonnes,'','');
}
  
function FormTitre($titre,$style,$colonnes)
{ // Formulaire : titre sur N colonnes.
    LigneIni($style);
    CelluUni('<b>'.$titre.'</b>',$colonnes,'','');
    LigneFin();
}
  
function FormVide($lignes)
{ // Fonction pour générer deux vides sur plusieurs lignes
    for($i=0;$i<$lignes;$i++)
    {
        FormCite('&nbsp;','');
    }
}

function FormCite($titre,$valeur)
{ // Formulaire : texte simple
    global $titretablarg;
    if ($valeur=='') $valeur='&nbsp;';
    LigneIni('corps1');
    CelluUni($titre,'',$titretablarg,''); 
    CelluUni($valeur,'','','');
    LigneFin();
}

function FormTexte($titre,$champs,$valeur,$style,$taille,$droitmin)
{ // Formulaire : texte simple
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTtexte($champs,$valeur,$style,$taille,'',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}  

function FormTexteDate($titre,$champs,$valeur,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : texte simple
  TRdebut($titre,$espace);
  $verrou = VerifieDroit($droitmin);
  INPUTtexte($champs,$valeur,$style,$taille,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }  

function FormTexteFige($titre,$champs,$valeur,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : texte simple
  TRdebut($titre,$espace);
  $verrou = VerifieDroit($droitmin);
  INPUTtextedis($champs,$valeur,$style,$taille,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur);
  }  

function FormTexte2($titre,$champs1,$champs2,$valeur1,$valeur2,$style,$taille,$droitmin)
{ // Formulaire : deux textes simples
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTtexte($champs1,$valeur1,$style,$taille,'',$verrou);
    INPUTtexte($champs2,$valeur2,$style,$taille,'',$verrou);
    TRfin();
    GereLien('&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2);
}  

function FormTexte3($titre,$champs1,$champs2,$champs3,$valeur1,$valeur2,$valeur3,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : trois textes simples
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style,$taille,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,$valeur2,$style,$taille,'',$verrou,$espace.'    ');
  INPUTtexte($champs3,$valeur3,$style,$taille,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2.'&'.$champs3.'='.$valeur3,$espace);
  }  

  
function FormVille($titre,$champs1,$champs2,$valeur1,$valeur2,$style,$taille,$droitmin)
{ // Formulaire : texte de ville (CP + nom)
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTtexte($champs1,$valeur1,'tel',6,'',$verrou);
    INPUTtexte($champs2,$valeur2,$style,$taille,'',$verrou);
    TRfin();
    GereLien('&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2);
  }  

function FormSecu($titre,$champs1,$champs2,$valeur1,$valeur2,$style,$taille,$droitmin,$lien,$espace)
  { // 
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style,$taille,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,$valeur2,'tel',3,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2,$espace);
  }  

function FormPasse($titre,$champs,$valeur,$style,$taille)
{ // Formulaire : texte simple
    TRdebut($titre);
    INPUTpasse($champs,$valeur,$style,$taille);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormQuaNom($titre,$champs,$valeur,$nom,$valnom,$pastous,$droitmin)
{ // Formulaire : qualité+nom
    global $qualites_liste;
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    Select($champs,$valeur,$qualites_liste,$qualites_liste,4,$pastous,0,'',$verrou);
    INPUTtexte($nom,$valnom,'texte',30,'',$verrou);
    TRfin(); 
}

function FormSexe($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { // Formulaire : sexe
  global $sexes_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$sexes_liste,3,$pastous,0,'',$verrou,$espace.'    ');
  TRfin($espace); 
  return GereRetours($lien,$lien,$espace);  
  }

function FormOuiNon($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { //
  global $ouinons_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$ouinons_liste,3,0,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormJourSem($titre,$champs,$valeur,$pastous,$droitmin,$lien,$espace)
  { //
  global $jours_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$jours_liste,9,$pastous,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien,$espace);  
  }

function FormCategorie($titre,$champs,$valeur,$pasvide,$pastous,$droitmin)
  { // Formulaire : académie
  global $categories_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre);
  Select($champs,$valeur,'',$categories_liste,6,$pastous,0,'',$verrou);
  TRfin();
  return GereLien('&'.$champs.'='.$valeur);
  }

function FormAcadem2($titre,$champs,$valeur,$impact,$pasvide,$aimp,$pastous,$droitmin,$lien,$espace)
  { // Formulaire : académie
  global $noacademie_liste;
  global $nomacademie_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  if ($impact)
    {
    script_lien_academie_salle('piece',$pastous,$espace);
    $macro=' onload="lien_academie_salle(this.options[this.selectedIndex].value);" onchange="lien_academie_salle(this.options[this.selectedIndex].value);"';
    }
  Select($champs,$valeur,$noacademie_liste,$nomacademie_liste,9,$pastous,$aimp,$macro,$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormCoti($titre,$champs,$valeur,$champs1,$champs2,$champs3,$valeur1,$annee,$pastous,$droitmin,$lien,$espace)
  { // Formulaire : cotisation
  global $cotiadhesions1_liste;
  global $cotiadhesions2_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace); 
  Select($champs,$valeur,$cotiadhesions1_liste[$annee],$cotiadhesions2_liste[$annee],6,$pastous,'','',$verrou,$espace.'    ');
  html(' le '); 
  INPUTtexte($champs1,jour($valeur1),'tel',1,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,mois($valeur1),'tel',1,'',$verrou,$espace.'    ');
  INPUTtexte($champs3,annee($valeur1),'tel',3,'',$verrou,$espace.'    ');  
  //  INPUTtexte($champs1,$valeur1,$style1,$taille1,'',$verrou,$espace.'    ');
  //SELECTdate($jour,$mois,$annee,$date,2000,$verrou,$espace.'    ');
  //SELECTdate($jour,$mois,$annee,$date,$datedebut,$verrou,$espace.'    ');
  //list($avant, $date, $apres) = explode("'", $date);
  //list($annee1, $mois1, $jour1) = explode("-", $date);
  //return GereRetours($lien,$lien.'&'.$jour.'='.$jour1.'&'.$mois.'='.$mois1.'&'.$annee.'='.$annee1,$espace);
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormDat($titre,$champs,$valeur,$code,$droitmin)
{ // Formulaire : cotisation
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    html('<script type="text/javascript">');
    html('  $(function(){');
    html('  // Datepicker');
    html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
    html('  $( "#date'.$code.'" ).datepicker( $.datepicker.regional[ "fr" ] );');
    html('  });');
    html('');
    html('</script>');

    INPUTtexte($champs,$valeur,'tel',9,' id="date'.$code.'"',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormCoti2($titre,$champs,$valeur,$champs1,$valeur1,$champs2,$valeur2,$annee,$code,$pastous,$droitmin)
{ // Formulaire : cotisation
    global $cotiadhesions1_liste;
    global $cotiadhesions2_liste;
    global $modecoti_liste;
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    html('<script type="text/javascript">');
    html('  $(function(){');
    html('  // Datepicker');
    html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
    html('  $( "#coti'.$code.'" ).datepicker( $.datepicker.regional[ "fr" ] );');
    html('  });');
    html('');
    html('</script>');

    Select($champs,$valeur,$cotiadhesions1_liste[$annee],$cotiadhesions2_liste[$annee],8,$pastous,'','',$verrou);
    html(' le '); 
    INPUTtexte($champs1,$valeur1,'tel',9,' id="coti'.$code.'"',$verrou);
    html(' en '); 
    Select($champs2,$valeur2,'',$modecoti_liste,7,0,'','',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormCotiTUG($titre,$champs,$valeur,$champs1,$valeur1,$champs2,$valeur2,$annee,$code,$pastous,$droitmin)
{ // Formulaire : cotisation
    global $cotiTUG1_liste;
    global $cotiTUG2_liste;
    global $modecoti_liste;
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    html('<script type="text/javascript">');
    html('  $(function(){');
    html('  // Datepicker');
    html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
    html('  $( "#cotitug'.$code.'" ).datepicker( $.datepicker.regional[ "fr" ] );');
    html('  });');
    html('');
    html('</script>');

    Select($champs,$valeur,$cotiTUG1_liste[$annee],$cotiTUG2_liste[$annee],5,$pastous,'','',$verrou);
    html(' le '); 
    INPUTtexte($champs1,$valeur1,'tel',9,' id="cotitug'.$code.'"',$verrou);
    html(' en '); 
    Select($champs2,$valeur2,'',$modecoti_liste,7,0,'','',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormCotiAbon($titre,$champs,$valeur,$champs1,$valeur1,$champs2,$valeur2,$annee,$code,$pastous,$droitmin)
{ // Formulaire : cotisation
    global $cotiAbon1_liste;
    global $cotiAbon2_liste;
    global $modecoti_liste;
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    html('<script type="text/javascript">');
    html('  $(function(){');
    html('  // Datepicker');
    html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
    html('  $( "#cotiabon'.$code.'" ).datepicker( $.datepicker.regional[ "fr" ] );');
    html('  });');
    html('');
    html('</script>');

    Select($champs,$valeur,$cotiAbon1_liste[$annee],$cotiAbon2_liste[$annee],5,$pastous,'','',$verrou);
    html(' le '); 
    INPUTtexte($champs1,$valeur1,'tel',9,' id="cotiabon'.$code.'"',$verrou);
    html(' en '); 
    Select($champs2,$valeur2,'',$modecoti_liste,7,0,'','',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormDistrib($titre,$champs,$valeur,$code,$pastous,$droitmin)
{ // Formulaire : cotisation
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    html('<script type="text/javascript">');
    html('  $(function(){');
    html('  // Datepicker');
    html('  $.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );');
    html('  $( "#distrib'.$code.'" ).datepicker( $.datepicker.regional[ "fr" ] );');
    html('  });');
    html('');
    html('</script>');

    INPUTtexte($champs,$valeur,'tel',9,' id="distrib'.$code.'"',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormNumero($titre,$champs,$valeur,$style,$taille,$droitmin)
{ // Formulaire : texte simple
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    html(' numéro '); 
    INPUTtexte($champs,$valeur,$style,$taille,'',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}  

function FormTrimestre($titre,$champs,$valeur,$pastous,$droitmin,$lien,$espace)
  { // Formulaire : coordonnées
  global $trimestres_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre);
  Select($champs,$valeur,'',$trimestres_liste,4,$pastous,'','',$verrou,$espace.'    ');     
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormCoords($titre,$champs,$valeur,$droitmin)
{ // Formulaire : coordonnées
    global $coords_liste;
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    Select($champs,$valeur,'',$coords_liste,7,0,'','',$verrou);     
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormCateg($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { // Formulaire : coordonnées
  global $categs_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,$categs_liste,$categs_liste,13,0,'','',$verrou,$espace.'    ');  
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormSolf($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { //
  global $niveauxsolfege_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,$niveauxsolfege_liste,$niveauxsolfege_liste,15,$pastous,'','',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormScol($titre,$champs1,$champs2,$valeur,$droitmin,$lien,$espace)
  { //
  global $niveauxscolaire_liste1;
  global $niveauxscolaire_liste2;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  script_niveau_scolaire($espace.'    ');  // gestion des trois combobox de niveau scolaire.
  Select($champs1,$valeur,$niveauxscolaire_liste1,$niveauxscolaire_liste1,11,$pastous,'',' onchange="niv1()"',$verrou,$espace.'    ');
  Select($champs2,$valeur,$niveauxscolaire_liste2,$niveauxscolaire_liste2,11,$pastous,'',' onchange="niv2()"',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien,$espace);  // Lien non géré proprement.
  }

function FormSorti($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { //
  global $droitsortie_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$droitsortie_liste,3,0,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormConnu($titre,$champs1,$champs2,$valeur,$style,$taille,$droitmin,$lien,$espace)
  { //
  global $connu_liste;
  $verrou = VerifieDroit($droitmin);
  if (strlen($valeur)>1) 
    {
    $valeur2=$valeur;
    $valeur=8;
    }
  else  
    $valeur2='';
  TRdebut($titre,$espace);
  Select($champs1,$valeur,'',$connu_liste,9,0,0,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,$valeur2,$style,$taille,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2,$espace);
  }

function FormMembre($titre,$champs,$valeur,$pastous,$droitmin,$lien,$espace)
  { //
  global $membres_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$membres_liste,6,$pastous,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormFonction($titre,$champs,$valeur,$pastous,$droitmin,$lien,$espace)
  { //
  global $membresvaleur_liste;
  global $membres_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,$membresvaleur_liste,$membres_liste,5,$pastous,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormPerio($titre,$champs,$valeur,$pastous,$droitmin,$lien,$espace)
  { //
  global $perios_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$perios_liste,7,$pastous,0,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }

function FormSpecial($titre,$champs,$valeur,$droitmin,$lien,$espace)
  { // Formulaire : coordonnées
  global $specialites_liste;
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  Select($champs,$valeur,'',$specialites_liste,9,0,'','',$verrou,$espace.'    ');     
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs.'='.$valeur,$espace);
  }


function FormCourriel($titre,$champs,$valeur,$style,$taille,$droitmin)
{ // Formulaire : courriel simple
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTtexte($champs,$valeur,$style,$taille,'" onblur="valide_mail(this)"',$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

	
function FormTexteA($titre,$champs,$valeur,$style,$col,$row,$droitmin)
{ // Formulaire : texte libre.
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTtexteA($champs,$valeur,$style,$col,$row,$verrou);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}	

function FormComme($titre,$champs1,$champs2,$champs3,$valeur1,$valeur2,$droitmin,$lien,$espace)
  { //
  $verrou = VerifieDroit($droitmin);
  $espace = LigneIni('corps1',$espace);
  $espace = CelluIni(3,'','',$espace);
  INPUTtexteA($champs1,$valeur1,'texte',90,3,$verrou,$espace);
  INPUTtexteA($champs2,$valeur2,'texte',90,3,$verrou,$espace);
  html($espace.'<br>'.$titre.' : ');
  INPUTtexteA($champs3,'','texte',160,1,$verrou,$espace);
  $espace = substr($espace,1,strlen($espace)-4); 
  TRfin($espace);
  return GereRetours($lien,$lien,$espace);
	}

function FormComme1($titre,$champs,$valeur,$col,$ligne,$droitmin,$nbespace)
  { //
  $verrou = VerifieDroit($droitmin);
  if ($titre)   $espace = CelluUni($titre,'','','',$espace);
  $espace = CelluIni('','','',$espace.'  ');
  INPUTtexteA($champs,$valeur,'texte',$col,$ligne,$verrou,$espace.'    ');
  $espace = substr($espace,1,strlen($espace)-2); 
  TRfin($espace);
	}

function FormComme2($champs,$valeur,$col,$ligne,$droitmin,$nbespace)
  { //
  $verrou = VerifieDroit($droitmin);
  $espace = CelluIni('','','',$espace.'  ');
  html('<center>');
  INPUTtexteA($champs,$valeur,'texte',$col,$ligne,$verrou,$espace.'    ');
  $espace = substr($espace,1,strlen($espace)-2); 
  html('</center>');
  TRfin($espace);
	}

function FormComme3($titre,$champs1,$champs2,$valeur1,$droitmin,&$lien)
{ // Commentaire servant pour les réseaux (pas besoin d'un double commentaire)
    $verrou = VerifieDroit($droitmin);
    LigneIni('corps1');
    CelluIni(3,'','');
    INPUTtexteA($champs1,$valeur1,'texte',60,15,$verrou);
    html('<br>'.$titre.' : ');
    INPUTtexteA($champs2,'','texte',45,1,$verrou);
    $espace = substr($espace,1,strlen($espace)-4); 
    TRfin();
    return GereRetours($lien,$lien);  // Lien non géré proprement.
}

function FormComme4($titre,$champs1,$champs2,$valeur1,$droitmin,$lien,$espace)
  { // Commentaire servant pour les réseaux (pas besoin d'un double commentaire)
  $verrou = VerifieDroit($droitmin);
  $espace = LigneIni('corps1',$espace);
  $espace = CelluIni(3,'','',$espace);
  INPUTtexteA($champs1,$valeur1,'texte',55,3,$verrou,$espace);
  html($espace.'<br>'.$titre.' : ');
  INPUTtexteA($champs2,'','texte',45,1,$verrou,$espace);
  //html('<span class="hint">Use your real name!</span>');
  $espace = substr($espace,1,strlen($espace)-4); 
  TRfin($espace);
  return GereRetours($lien,$lien,$espace);  // Lien non géré proprement.
	}

function FormCoche($titre,$champs,$valeur,$reference,$avertissement,$droitmin)
{ // Formulaire : coche
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    INPUTcoche($champs,$valeur,$reference,$verrou);
    if ($avertissement!='') html('  <i><div id="attention">'. $avertissement .'</div></i>');
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormElec($titre,$champs1,$valeur1,$reference1,$champs2,$valeur2,$reference2,$avertissement,$droitmin)
{ // Formulaire : coche
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    html('papier ');
    INPUTcoche($champs1,$valeur1,$reference1,$verrou);
    html(' / électronique ');
    INPUTcoche($champs2,$valeur2,$reference2,$verrou);
    if ($avertissement!='') html('  <i><div id="attention">'. $avertissement .'</div></i>');
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormCourriel2($titre,$champs1,$champs2,$valeur1,$valeur2,$reference,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : un mail et sa communicabilité
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style,$taille,'" onblur="valide_mail(this)"',$verrou,$espace.'    ');
  INPUTcoche($champs2,$valeur2,$reference,$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2,$espace);
  }  

function FormTel2($titre,$champs1,$champs2,$champs3,$champs4,$valeur1,$valeur2,$valeur3,$valeur4,$reference,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : deux téléphones et leur communicabilité.
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style,$taille,'',$espace.'    ');
  INPUTcoche($champs2,$valeur2,$reference,$espace.'    ');
  INPUTtexte($champs3,$valeur3,$style,$taille,'',$espace.'    ');
  INPUTcoche($champs4,$valeur4,$reference,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2.'&'.$champs3.'='.$valeur3.'&'.$champs4.'='.$valeur4,$espace);
  }  

function FormTel3($titre,$champs1,$champs2,$champs3,$valeur1,$valeur2,$valeur3,$reference,$style1,$style2,$taille1,$taille2,$droitmin,$lien,$espace)
  { // Formulaire : deux téléphones et leur communicabilité.
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style1,$taille1,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,$valeur2,$style2,$taille2,'',$verrou,$espace.'    ');
  INPUTcoche($champs3,$valeur3,$reference,$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2.'&'.$champs3.'='.$valeur3,$espace);
  }  

function FormVoie($titre,$champs1,$champs2,$champs3,$valeur1,$valeur2,$valeur3,$style,$taille,$droitmin,$lien,$espace)
  { // Formulaire : voie (numero + bis + nom de voie)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,'tel',3,'',$verrou,$espace.'    ');
  INPUTtexte($champs2,$valeur2,'tel',10,'',$verrou,$espace.'    ');
  INPUTtexte($champs3,$valeur3,$style,$taille,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2.'&'.$champs3.'='.$valeur3,$espace);
  } 
  
function FormAnneeSco($titre,$champs,$valeur,$droitmin)  
{ //
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    SELECTanneesco($champs,$valeur,0,$verrou);
	  if ($verrou!='')    FormCache($champs,$valeur);
    TRfin();
    GereLien('&'.$champs.'='.$valeur);
}

function FormAnneeSco2($titre,$champs1,$champs2,$valeur1,$valeur2,$droitmin) 
{ // Formulaire : Fourchette d'année
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre); 
    SELECTanneesco($champs1,$valeur1,1,$verrou);
    html('    - ');
    SELECTanneesco($champs2,$valeur2,1,$verrou);
    TRfin();
    GereLien('&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2);
}

function FormAges($titre, $champs1,$champs2,$valeur1,$valeur2,$style,$droitmin,$lien,$espace)
  { // Formulaire : âge
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  INPUTtexte($champs1,$valeur1,$style,2,'',$verrou,$espace.'    ');
  html($espace.'    - '); 
  INPUTtexte($champs2,$valeur2,$style,2,'',$verrou,$espace.'    ');
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur1.'&'.$champs2.'='.$valeur2,$espace);
  }

function FormDate($titre,$jour,$mois,$annee,$date,$datedebut,$droitmin,$lien,$espace)
  { // Formulaire : date simple  
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace); 
  SELECTdate($jour,$mois,$annee,$date,$datedebut,$verrou,$espace.'    ');
  TRfin($espace);
  list($avant, $date, $apres) = explode("'", $date);
  list($annee1, $mois1, $jour1) = explode("-", $date);
  return GereRetours($lien,$lien.'&'.$jour.'='.$jour1.'&'.$mois.'='.$mois1.'&'.$annee.'='.$annee1,$espace);
  }
 
function SELECTdate($jour,$mois,$annee,$date,$datedebut,$verrou,$espace)
  { // Sélection : date simple 
  $date = DateNonSQL($date);
  html($espace.'<select name="'.$jour.'" size="1"'.$verrou.'>');
    SELECTjour ($date,0,$espace);
  html($espace.'</select>');
  html($espace.'<select name="'.$mois.'" size="1"'.$verrou.'>');
    SELECTmois ($date,0,$espace);
  html($espace.'</select>');
  html($espace.'<select name="'.$annee.'" size="1"'.$verrou.'>');
    SELECTannee ($date,$datedebut,1,$espace);
  html($espace.'</select>');
  
	if ($verrou!='')
    {
    list($vala, $valm, $valj) = explode("-", $date);
    $espace = FormCache($jour,$valj,$vide,$espace);
    $espace = FormCache($mois,$valm,$vide,$espace);
    $espace = FormCache($annee,$vala,$vide,$espace);
  } }

function SELECTjour ($choix,$pastous,$espace)
	{ // Sélection : jour  
  list($annee, $mois, $jour) = explode("-", $choix);
	for ($i=$pastous;$i<32;$i++)
		{
 		if ($i<10) $j='0'.$i;
 		else $j=$i;
 		echo $espace.'<option value="'. $j .'"';
 		if ($i==$jour) echo ' selected';
 		if ($i==0) html("></option>");
    else html('>'. $j .'</option>');
	}	}

function SELECTmois ($choix,$pastous,$espace)
	{ // Sélection : mois 
	global $mois_liste;
  list($annee, $mois, $jour) = explode("-", $choix);
	for ($i=$pastous;$i<13;$i++)
		{
 		if ($i<10) $ii="0$i"; else $ii=$i;
 		echo $espace.'<option value="' . $ii . '"';
 		if ($i==$mois) echo ' selected';
 		if ($i==0) html("></option>");
 		else html('>' . $mois_liste[$i] . '</option>');
	} }

function SELECTannee ($choix,$anneemin,$inv,$espace)
	{ // Sélection : année
	$anneemax = date("Y");
  //list($avant, $choix, $apres) = explode("'", $choix);
  list($annee, $mois, $jour) = explode("-", $choix);
	if ($annee==0)
    html($espace.'<option value="0" selected></option>"');
  else
    html($espace.'<option value="0"></option>"');  
  if ($inv==1) 
    {
  	for ($i=$anneemax;$i>=$anneemin;$i--)
  		{
   		echo $espace.'<option value="' . $i . '"';
   	 	if ($i==$annee) echo ' selected';
 		  if ($i==0) html("></option>");
 		  else html('>'. $i .'</option>');
  	} } 
  else
    {
  	for ($i=$anneemin;$i<=$anneemax;$i++)
  		{
   		echo $espace.'<option value="' . $i . '"';
   	 	if ($i==$annee) echo ' selected';
 		  if ($i==0) html("></option>");
 		  else    		html('>'. $i .'</option>');
  }	}	}
  
function FormHoraires($titre,$heure,$minute,$valeur,$droitmin,$espace)
  { //
  $verrou = VerifieDroit($droitmin);
  $espace=str_repeat(' ',$nbespace);
  TRdebut($titre,$espace);
  SELECThoraire($heure,$minute,$valeur,$verrou,$espace.'    ');
  TRfin($espace);
  }

function FormHoraires2($titre,$h1,$m1,$h2,$m2,$valeur1,$valeur2,$droitmin,$espace)
  { //
  $verrou = VerifieDroit($droitmin);
  $espace=str_repeat(' ',$nbespace);
  TRdebut($titre,$espace);
  html($espace.'De &nbsp;');
  SELECThoraire($h1,$m1,$valeur1,$verrou,$espace.'    ');
  html($espace.'&nbsp; à &nbsp;');
  SELECThoraire($h2,$m2,$valeur2,$verrou,$espace.'    ');
  TRfin($espace);
  }

function SELECThoraire($heure,$minute,$horaire,$verrou,$espace)
  { // Sélection : date simple 
  SELECTheure ($heure,$horaire,$verrou,$espace);
  html($espace.' :');
  SELECTminute ($minute,$horaire,$verrou,$espace);
  }

function SELECTheure ($champs,$choix,$verrou,$espace)
	{ // Sélection : heure 
  html($espace.'<select name="'.$champs.'" size="1"'.$verrou.'>');
  list($heure, $minute, $seconde) = explode(":", $choix);
	echo $espace.'<option value="0"';
	if ($heure==0) echo ' selected';
  html('>-</option>');
  for ($i=8;$i<24;$i++)
		{
 		if ($i<10) $j='0'.$i;
 		else $j=$i;
 		echo $espace.'<option value="'. $j .'"';
 		if ($i==$heure) echo ' selected';
    html('>'. $j .'</option>');
    }	
  html($espace.'</select>');
 	if ($verrou!='')  $espace = FormCache($champs,$heure,$vide,$espace);
  }

function SELECTminute ($champs,$choix,$verrou,$espace)
	{ // Sélection : minute 
  html($espace.'<select name="'.$champs.'" size="1"'.$verrou.'>');
  list($heure, $minute, $seconde) = explode(":", $choix);
	for ($i=0;$i<60;$i=$i+5)
		{
 		if ($i<10) $j='0'.$i;
 		else $j=$i;
 		echo $espace.'<option value="'. $j .'"';
 		if ($i==$minute) echo ' selected';
    html('>'. $j .'</option>');
  	}
  html($espace.'</select>');
 	if ($verrou!='')  $espace = FormCache($champs,$minute,$vide,$espace);
	}

// Combobox sur base de requêtes SQL
function FormContact($titre,$champs1,$champs2,$valeur2,$macro,$connexion,$taille,$morale,$droitmin)
{ //
    $verrou = VerifieDroit($droitmin);
    TRdebut($titre);
    script_liste_personnes($champs1,$champs2,$macro,$morale,$espace.'    ');
    if ($valeur2!='')
    {
        $requete  = "SELECT pe_id, pe_nom, pe_prenom FROM personnes WHERE pe_id='$valeur2'";
        $resultat = ExecRequete($requete,$connexion);
        $objet    = ObjetSuivant($resultat);
        html('    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="' . $valeur2 .'" selected">' 
         . $objet->pe_nom. ' '. $objet->pe_prenom . '</option></select>');
        INPUTtexte($champs2,'','texte',$taille,' onkeyup="'.$macro.'"',$verrou);
  	    if ($verrou!='')    FormCache($champs1,$valeur2);
    }
    else
    {
        html('    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="0"> </option></select>');
        INPUTtexte($champs2,$valeur2,'texte',$taille,' onkeyup="'.$macro.'"',$verrou);
  	    if ($verrou!='')    FormCache($champs2,$valeur2);
    }
    TRfin();
}

function FormAdherent($titre,$champs1,$champs2,$valeur2,$macro,$connexion,$taille,$annee,$droitmin,$lien,$espace)
  { //
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  script_liste_adherents($champs1,$champs2,$macro,$annee,$espace.'    ');
  if ($valeur2!='')
    {
    $requete  = "SELECT pe_id, pe_nom, pe_prenom FROM personnes WHERE pe_id='$valeur2'";
    $resultat = ExecRequete($requete,$connexion);
    $objet    = ObjetSuivant($resultat);
    html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="' . $valeur2 .'" selected">' 
         . NumeroFormel($objet->pe_id). ' - ' .$objet->pe_nom. ' '. $objet->pe_prenom . '</option></select>');
    INPUTtexte($champs2,'','texte',$taille,' onkeyup="'.$macro.'"',$verrou,$espace.'    ');
  	if ($verrou!='')           $espace = FormCache($champs1,$valeur2,$vide,$espace);
    }
  else
    {
    html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="0"> </option></select>');
    INPUTtexte($champs2,$valeur2,'texte',$taille,' onkeyup="'.$macro.'"',$verrou,$espace.'    ');
  	if ($verrou!='')           $espace = FormCache($champs2,$valeur2,$vide,$espace);
    }
  TRfin($espace);
  }

function FormProfession($titre,$champs1,$champs2,$valeur2,$macro,$connexion,$taille,$droitmin,$lien,$espace)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  script_liste_profes($champs1,$champs2,$macro,$espace.'    ');
  if ($valeur2!='')
    {
    $requete = "SELECT me_poste FROM metiers WHERE me_id='$valeur2'";
    $resultat = ExecRequete($requete,$connexion);
    $objet=ObjetSuivant($resultat);
    html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="' . $valeur2 .'" selected">' . $objet->me_poste . '</option></select>');
    INPUTtexte($champs2,'','texte',$taille,' onkeyup="'.$macro.'"',$verrou,$espace.'    ');
    if ($verrou!='')    $espace = FormCache($champs1,$valeur2,$vide,$espace);
    }
  else
    {
    html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'><option value="0"> </option></select>');
    INPUTtexte($champs2,$valeur2,'texte',$taille,' onkeyup="'.$macro.'"',$verrou,$espace.'    ');
  	if ($verrou!='')    $espace = FormCache($champs2,$valeur2,$vide,$espace);
    }
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur2,$espace);
  }

function FormProjet($titre,$champs1,$valeur,$connexion,$pastous,$droitmin)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre);
  $requete  = "SELECT ac_id, ac_titre FROM actions WHERE ac_type>5 and ac_type <8 ORDER BY ac_titre";
  $resultat = ExecRequete($requete,$connexion);
  $objet    = ObjetSuivant($resultat);
  html('    <select name="'.$champs1.'" '.$verrou.'>');
  if (!$pastous)  html('      <option value="0"></option>');
  do
    {
    $selected="";
    if ($objet->ac_id==$valeur) $selected="selected";
    html('      <option value="' . $objet->ac_id .'" '.$selected.'>' . $objet->ac_titre . '</option>');
    }
  while ($objet=ObjetSuivant($resultat));
  html('    </select>');
  if ($verrou!='')    FormCache($champs1,$valeur,$vide);
  TRfin();
  return GereLien('&'.$champs1.'='.$valeur);
  }

function FormEnseignant($titre,$champs1,$valeur,$connexion,$pastous,$bouton,$droitmin,$lien,$espace)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  $requete = "SELECT sa_id, sa_nom, sa_prenom FROM salaries WHERE sa_etat=1 AND sa_enseignant=1 ORDER BY sa_nom, sa_prenom";
  $resultat = ExecRequete($requete,$connexion);
  $objet=ObjetSuivant($resultat);
  html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'>');
  if (!$pastous)  html($espace.'      <option value="0"></option>');
  do
    {
    $selected="";
    if ($objet->sa_id==$valeur) $selected="selected";
    html($espace.'      <option value="' . $objet->sa_id .'" '.$selected.'>' . $objet->sa_nom .' '. $objet->sa_prenom . '</option>');
    }
  while ($objet=ObjetSuivant($resultat));
  html($espace.'    </select>');
  if ($bouton!=0)   html($espace.'&nbsp;&nbsp;'.LienEdition($valeur,'','sa'));
  if ($verrou!='')    $espace = FormCache($champs1,$valeur,$vide,$espace);
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur,$espace);
  }

function FormPresence($titre,$champs1,$valeur,$connexion,$bouton,$droitmin,$lien,$espace)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  $requete = "SELECT ho_id,ho_source,ho_trimestre,ho_annee FROM horaires ORDER BY ho_source,ho_trimestre";
  $resultat = ExecRequete($requete,$connexion);
  $objet=ObjetSuivant($resultat);
  html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'>');
  html($espace.'      <option value="0"></option>');
  do
    {
    $selected="";
    if ($objet->ho_id==$valeur) $selected="selected";
    html($espace.'      <option value="'.$objet->ho_id.'" '.$selected.'>Horaire '.$objet->ho_source
         .' - '.TraduitTrimestreCourt($objet->ho_trimestre).'-'.$objet->ho_annee.'</option>');
    }
  while ($objet=ObjetSuivant($resultat));
  html($espace.'    </select>');
  if ($bouton!=0)   html($espace.'&nbsp;&nbsp;'.LienEdition($valeur,'','pr'));
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur,$espace);
  }

function FormPiece($titre,$champs1,$valeur,$academie,$connexion,$pastous,$bouton,$droitmin,$lien,$espace)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  
  if (!$academie)
    $requete  = "SELECT pi_id, pi_nom FROM pieces ORDER BY pi_nom";
  else
    $requete  = "SELECT pi_id, pi_nom FROM pieces WHERE (pi_id like '$academie%' OR pi_id=1) ORDER BY pi_id";
  $resultat = ExecRequete($requete,$connexion);
  $objet    = ObjetSuivant($resultat);
  script_lien_salle_infosalle('infopiece',$espace);
  $macro=' onchange="lien_salle_infosalle(this.options[this.selectedIndex].value);"';
  html($espace.'    <select name="'.$champs1.'" id="'.$champs1.'" class="test"'.$verrou.$macro.'>');
  if (!$pastous)  html($espace.'      <option value="0"></option>');
  do
    {
    $selected="";
    if ($objet->pi_id==$valeur) $selected="selected";
    html($espace.'      <option value="' . $objet->pi_id .'" '.$selected.'>' . $objet->pi_nom .'</option>');
    }
  while ($objet=ObjetSuivant($resultat));
  html($espace.'    </select>');
  if ($bouton!=0)   html($espace.'&nbsp;&nbsp;'.LienEdition($valeur,'','pi'));
  if ($verrou!='')    $espace = FormCache($champs1,$valeur,$vide,$espace);
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur,$espace);
  }
  
function FormCoursColl($titre,$champs1,$valeur,$connexion,$pastous,$droitmin,$lien,$espace)
  { // Liste des professions pour combobox (avec requête et scripts liés)
  $verrou = VerifieDroit($droitmin);
  TRdebut($titre,$espace);
  
  $requete  = "SELECT ma_id, ma_matiere FROM matieres ORDER BY ma_id";
  $resultat = ExecRequete($requete,$connexion);
  $objet    = ObjetSuivant($resultat);
  html($espace.'    <select name="'.$champs1.'" class="test"'.$verrou.'>');
  if (!$pastous)
    html($espace.'      <option value="0"></option>');
  do
    {
    $selected="";
    if ($objet->ma_id==$valeur) $selected="selected";
    html($espace.'      <option value="' . $objet->ma_id .'" '.$selected.'>' . $objet->ma_matiere .'</option>');
    }
  while ($objet=ObjetSuivant($resultat));
  html($espace.'    </select>');
  if ($verrou!='')    $espace = FormCache($champs1,$valeur,$vide,$espace);
  TRfin($espace);
  return GereRetours($lien,$lien.'&'.$champs1.'='.$valeur,$espace);
  }

// Fonctions courantes pour les présentations.
function VerifieDroit($droitmin)
  {
  if ($droitmin)
    return '';
  else
    return ' disabled'; // Droit dit "dur", seul le niveau du droit compte.
  }

function GereRetours($lienpur,$lien)
{
    if ($lienpur!='') return $lien;  
}

function GereLien($ajout)
{
    global $lien;
    $lien .= $ajout;  
}
?>