<?php
//
// Gestion des principales fonctions MySQL
//

function Connexion($pNom,$pMotPasse, $pBase, $pServeur)
{ // Connexion à MySQL et infos sur les premières anomalies.
    // Connexion serveur
    $connexion = mysql_connect($pServeur,$pNom,$pMotPasse); // Plutôt que pconnect
    if (!$connexion)
    {
        html('La connexion au serveur '.$pServeur.' est impossible.');
        exit;
    }
    if (!mysql_select_db($pBase,$connexion)) // Connexion à la base
    {
        html('L\'accès à la base $pBase est impossible.');
        html('<b>Message de MySQL :</b> '.mysql_error($connexion));
        exit;
    }
	mysql_query("SET NAMES 'utf8'") ;
    return $connexion; // Retour de la variable de connexion
}

function ExecRequete ($requete,$connexion)
{ // Exécution d'une requête
    $resultat=mysql_query($requete,$connexion);
    if ($resultat) 
        return $resultat;
    else
    {
    html('<b> Erreur dans l\'exécution de la requête '.$requete.'.</b><br>');
    html('<b> Message d\'erreur de MySQL :</b> '. mysql_error($connexion));
    exit;
}   }

function ObjetSuivant($resultat)
{ // Récupération de l'objet suivant lors d'une extraction
    return mysql_fetch_object($resultat);
}

function LigneSuivante($resultat)
{ // Récupération de la ligne suivante lors d'une extraction
    return mysql_fetch_assoc($resultat);
}

function InsertionNouvelId ($table,$requete,$connexion)
{ // Blocage de table pour création d'un identifiant
    // http://blog.christophelebot.fr/
    //        2006/03/27/recuperer-dernier-auto-increment-mysql-avec-php/
    $resultat = ExecRequete("LOCK TABLES " . $table . " WRITE",$connexion);
    $resultat = ExecRequete("SET AUTOCOMMIT = 0",$connexion);
    $resultat = ExecRequete($requete,$connexion);
    $resultat = ExecRequete("SELECT LAST_INSERT_ID()",$connexion);
    $id = mysql_result($resultat,0,0); 
    $resultat = ExecRequete("COMMIT",$connexion);
    $resultat = ExecRequete("UNLOCK TABLES",$connexion);
    return $id;
}


//
// Gestion des sessions
//
function ControleAcces($page, $info_login, $id_session, $bd)
{ // Fonction de contrôle d'accès
	if (isSet($info_login['login']))
		$login = $info_login['login'];
	else
		$login = "";

	// Recherche de la session
	$session_courante = ChercheSession($id_session,$bd);
	// Cas 1: Vérification de la session courante
    $test=false;
	if (is_object($session_courante))
    { // La session existe. Est-elle valide ?
		if (SessionValide($session_courante,$bd))
		{ // On renvoie l'objet session
			return $session_courante;
		}
		else 
		{
			FormIdentification($page,$login,$bd);
			html('<br><center><b>Votre session n\'est pas (ou plus) valide.</b></center>');
			PiedPage();
			$test=true;
	} 	}
	if (isSet($info_login['login']))
    { // Cas 2.a: pas de session mais login et mot de passe
		// Court-circuit si trois essais ont été fait dans le passé.
		if (CompteEssais($info_login['login'],$bd)==3)
		{
			FormIdentification($page,$login,$bd);
			html('<br><center><b>Votre identification a été bloqué après trois essais infructueux. Contactez le webmestre.</b></center>');
			PiedPage();
			$test=true;      
		}
		else
		{
			// Une paire email/mot de passe existe. Est-elle correcte ?
			if (CreerSession ($bd, $info_login['login'],$info_login['motdepasse'], $id_session))
			{ // On renvoie l'objet session   //echo "Identification correcte<p>\n";
				return ChercheSession ($id_session, $bd);
			}
			else 
			{
				FormIdentification($page,$login,$bd);
				html('<br><center><b>Votre identification a échoué.</b></center>');
				$internaute = ChercheInternaute ($info_login['login'], $bd);
				if (CompteEssais($info_login['login'],$bd)==2)
					html('<center>Attention, il vous reste un essai pour pouvoir vous identifier.</center>');
				elseif (CompteEssais($info_login['login'],$bd)==3)
					html('<center>Votre identifiant a été bloqué suite à trois essais faux.</center>');
				elseif (is_object($internaute))  // L'internaute est connu, le mot de passe est donc faux.
					html('<center>Le mot de passe est incorrect.</center>');
				else   // L'internaute n'est pas connu, cela génère l'erreur.
					html('<center>L\'utilisateur '.$info_login['login'].' est inconnu.</center>');
				PiedPage();
				$test=true;
    } 	} 	}
	// Cas 2.b : il faut afficher le formulaire, en proposant
	// l'email comme valeur par défaut.   
	if ($test!=true)
    {
		FormIdentification($page,$login,$bd);
		PiedPage();
}   } 
  
function ChercheSession ($id_session, $bd) 
{ // Recherche d'une session
    $requete  = "SELECT * FROM sessions WHERE se_id = '$id_session'";
    $resultat = ExecRequete($requete,$bd);
    return ObjetSuivant($resultat);
}

function SessionValide ($session, $bd)
{ // Vérification qu'une session est valide
	// Vérifions que le temps limite n'est pas dépassé
	$maintenant = date ("U");
	if ($session->se_temps < $maintenant)
    { // Destruction de la session
		session_destroy();
		$requete  = "DELETE FROM sessions WHERE se_id='$session->se_id'";
		$resultat = ExecRequete($requete,$bd);
		return false;
    }
	else // C'est bon !
		return true;
}

function UtilisateurSession ($id_session, $bd)
{
    $session = ChercheSession ($id_session, $bd); 
    if (!isset($session->se_pseudo)) 
	    return '';
    else
	    return $session->se_pseudo;
}

function CreerSession ($connexion, $login, $motdepasse, $id_session)
{ // Tentative de création d'une session
    $internaute = ChercheInternaute ($login, $connexion);
    // L'internaute existe-t-il ?
    if (is_object($internaute))
    { // Vérification du mot de passe
        if ($internaute->in_motdepasse == md5($motdepasse))
        { // On insère dans la table SessionWeb, pour une certaine durée.
            $maintenant = date ("U");
            $cejour = date('Y-m-d H:i:s');
            $temps = $maintenant + $internaute->in_duree; 
            $nom = trim($internaute->in_nom);
            $prenom = trim($internaute->in_prenom);
            $pseudo = trim($internaute->in_pseudo);
            $requete = "INSERT INTO sessions (se_id, se_login, se_nom"
                        . ", se_prenom, se_pseudo,se_temps,se_date)"
                        . " VALUES ('$id_session','$login','$nom'"
                        . ", '$prenom','$pseudo','$temps','$cejour')";       
            $resultat = ExecRequete($requete,$connexion);
            AnnuleEssais($login, $connexion);
            return true;
        }
        AugmenteEssais($login, $connexion);    
        return false;
    }      
    else
        return false;
}

function FormIdentification($page, $login_defaut="",$connexion)
{
    entetepage('Malleus','Malleus - Accès','','','','',1,1,$connexion);
    html('<br><br><br><br><br><br>');
    FormIni('ident','ident',$page,'post');
    TableIni('300','choix');
    FormTitre('Identification','titre1',2);
    FormTexte('Identifiant','login',$login_defaut,'texte',15,1);
    FormPasse('Mot de passe','motdepasse','','texte',15);
    FormulaireFin('ident','ident','Valider',1,1);
    html('');
}

//
// Partie internaute
//

function FormInternaute($mode, $inter, $connexion) 
  {
  // On traite les caractères spéciaux HTML
  // foreach ($inter as $nom => $valeur)
  //  $inter[$nom] = htmlSpecialChars($inter[$nom]);
   
  html('<form method="post" action="session-validation.php">');
  html('<input type="hidden" name="mode" value="'.$mode.'" size="0" maxlength="0">');
  html('<table class="choix" align="center" width="250">');

  if ($mode == MAJ) 
    html('<input type="hidden" name="login" value="'.$inter['login'].'" size="0" maxlength="0">');
  else
    {
    html('  <tr align="center">');
    html('    <td><b>Identifiant</b></td>');
    html('    <td><INPUT type="text" class="texte" name="login" value="'.$inter['login'].'" size="10" maxlenght="40"></td>');
    html('  </tr><tr align="center">');
    }
  html('  <tr align="center">');
  html('    <td><b>Nom</b></td>');
  html('    <td><INPUT type="text" class="texte" name="nom" value="'.$inter['nom'].'" size="10" maxlenght="40"></td>');
  html('  </tr><tr align="center">');
  html('    <td><b>Prénom</b></td>');
  html('    <td><INPUT type="text" class="texte" name="prenom" value="'.$inter['prenom'].'" size="10" maxlenght="40"></td>');
  html('  </tr><tr align="center">');
  html('    <td><b>Pseudo</b></td>');
  html('    <td><INPUT type="text" class="texte" name="pseudo" value="'.$inter['pseudo'].'" size="10" maxlenght="40"></td>');
  html('  </tr><tr align="center">');
  html('    <td><b>Session (secondes)</b></td>');
  html('    <td><INPUT type="text" class="texte" name="duree" value="'.$inter['duree'].'" size="10" maxlenght="40"></td>');

  if ($mode == INSERTION)
    {
    html('  </tr><tr align="center">');
    html('    <td><b>Mot de passe</b></td>');
    html('    <td><INPUT type="password" class="texte" name="motdepasse" value="" size="10" maxlenght="40"></td>');
    html('  </tr><tr align="center">');
    html('    <td><b>Confirmation</b></td>');
    html('    <td><INPUT type="password" class="texte" name="confpasse" value=""" size="10" maxlenght="40"></td>');
    }
  html('  </tr><tr>');
  if ($mode == INSERTION)
    html('    <td colspan="2" align="center"><input type="submit" name="maj" value="Mettre à jour"></td>'); 
  else
    html('    <td colspan="2" align="center"><input type="submit" name="insere" value="Inscrire"></td>');     

  html('  </tr>');
  html('</table>');
  html('</form>');
  html('');
  }

function ControleInter ($tableau)
  { // Fonction de contrôle avant insertion/MAJ dans Internaute
  $message = "";
  // On vérifie que les champs importants ont été saisis
  if ($tableau['login']=="") 
    $message = "Vous devez saisir votre login !<BR>";
  if (isSet ($tableau['motdepasse']))
    {
    if ($tableau['motdepasse']=="" 
    or $tableau['confpasse']=="" 
    or $tableau['confpasse'] != $tableau['motdepasse'])
      $message .= "Vous devez saisir un mot de passe et le confirmer à l'identique!<BR>";
    }
  if ($tableau['prenom']=="") 
    $message .= "Vous devez saisir votre prénom !<BR>";
  if ($tableau['nom']=="") 
    $message .= "Vous devez saisir votre nom !<BR>";
  if ($tableau['pseudo']=="") 
    $message .= "Vous devez saisir un pseudo !<BR>";
  if ($tableau['duree']=="") 
    $message .= "Vous devez saisir une durée de session !<BR>";
  return $message;
  }

function ChercheInternaute ($login, $bd) //function ChercheInternaute ($login, $bd, $format=FORMAT_OBJET) 
{ // Recherche d'un internaute avec son login
    $requete  = "SELECT * FROM internautes WHERE in_login = '$login'";
    $resultat = ExecRequete($requete,$bd);
    //if ($format == FORMAT_OBJET)
    return ObjetSuivant ($resultat);
    //else return LigneSuivante ($resultat);    
}

function CompteEssais($login, $connexion) 
  { // Recherche d'un internaute avec son login
  $requete  = "SELECT in_essai FROM internautes WHERE in_login = '$login'";
  $objet = ObjetSuivant(ExecRequete($requete,$connexion));
  return $objet->in_essai;
  }

function AugmenteEssais($login, $connexion) 
  { // Recherche d'un internaute avec son login
  $essais = compteEssais($login,$connexion);
  if ($essais>3)
    $essais=3;
  else
    $essais++;
  $requete  = "UPDATE internautes SET in_essai =".$essais." WHERE in_login = '$login'";
  $resultat = ExecRequete($requete,$connexion);
  }

function AnnuleEssais($login, $connexion) 
  { // Recherche d'un internaute avec son login
  $requete  = "UPDATE internautes SET in_essai = 0 WHERE in_login = '$login'";
  $resultat = ExecRequete($requete,$connexion);
  }
  
?>