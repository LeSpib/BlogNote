<?php

function script_valide_mail($espace) 
  { // Script pour validation des courriels (composite de plusieurs éléments vus sur le web)
  html($espace.'<script> <!-- Script pour validation des courriels -->');
  html($espace.'function valide_mail(champs) ');
  html($espace.'  {');
  html($espace.'  if (!champs.value.match(\'^[-_\.0-9a-zA-Z]{1,}@[-_\.0-9a-zA-Z]{1,}[\.][0-9a-zA-Z]{2,}$\')) '); 
  html($espace.'    { ');
  html($espace.'    if (champs.value != \'\') '); 
  html($espace.'      { ');
  html($espace.'      alert("Adresse électronique invalide"); ');
  html($espace.'      champs.focus(); ');  
  html($espace.'  } } } ');
  html($espace.'</script>');
  }

function script_icone_multiple()
  { // Script pour afficher une liste d\'identifiants sur la base de début de noms
  $pagerequete = 'requetes-pour-script.php';
  global $typemax;
  html('<script> <!-- Script pour afficher une liste d\'identifiants sur la base de début de noms-->');  
  html('function changeicone(iden,type)');
  html('  {');
  html('  var xhr_object = null;');
  html('  if(window.XMLHttpRequest) // Firefox');
  html('    xhr_object = new XMLHttpRequest();');
  html('  else if(window.ActiveXObject) // Internet Explorer');
  html('    xhr_object = new ActiveXObject("Microsoft.XMLHTTP");');
  html('  else');
  html('    {');
  html('    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");');
  html('    return;');
  html('    }');
  html('  xhr_object.open("POST", "'.$pagerequete.'", true);');
  html('  xhr_object.onreadystatechange = function()');
  html('    {');
  html('    if(xhr_object.readyState == 4) eval(xhr_object.responseText);');
  html('    }');
  html('  xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");');
  html('  var data = "id="+iden+"&traite=icone";');
  html('  xhr_object.send(data);');
  html('  var icone = 0;');
  html('  if (type=='.$typemax.')');
  html('    icone=0;');
  html('  else');
  html('    icone=type+1;');
  html('  $("#type"+iden).attr("src","img/"+icone+".png");');
  html('  $("#type"+iden).attr("onclick","changeicone("+iden+","+icone+");");');
  html('  }');
  html('</script>');
  }

function script_icone_multiple_bis()
  { // Script pour afficher une liste d\'identifiants sur la base de début de noms
  $pagerequete = 'requetes-pour-script.php';
  global $typemax;
  html('<script> <!-- Script pour afficher une liste d\'identifiants sur la base de début de noms-->');  
  html('function changeiconebis(type)');
  html('  {');
  html('  var xhr_object = null;');
  html('  if(window.XMLHttpRequest) // Firefox');
  html('    xhr_object = new XMLHttpRequest();');
  html('  else if(window.ActiveXObject) // Internet Explorer');
  html('    xhr_object = new ActiveXObject("Microsoft.XMLHTTP");');
  html('  else');
  html('    {');
  html('    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");');
  html('    return;');
  html('    }');
  html('  var icone = 0;');
  html('  if (type=='.$typemax.')');
  html('    icone=0;');
  html('  else');
  html('    icone=type+1;');
  html('  $("#type").attr("src","img/"+icone+".png");');
  html('  $("#type").attr("onclick","changeiconebis("+icone+");");');
  html('  $("#typevide").attr("value",icone);');
  html('  }');
  html('</script>');
  }

  
// requetes-pour-script.php?id=4&traite=icone

function script_liste_adherents($champs1,$champs2,$macro,$annee,$espace)
  { // Script pour afficher une liste d\'identifiants sur la base de début de noms
  $pagerequete = 'requetes-pour-script.php';
  html($espace.'<script> <!-- Script pour afficher une liste d\'identifiants sur la base de début de noms-->');  
  html($espace.'function '.$macro);
  html($espace.'  {');
  html($espace.'  var l1 = document.principal.'.$champs2.'.value;');
  html($espace.'  var l2 = document.principal.'.$champs1);
  html($espace.'  if(l1.length<2)');
  html($espace.'    {');
  html($espace.'    l2.options.length = 0;');
  html($espace.'    l2.options[l2.options.length] = new Option(" ","0")');
  html($espace.'    }');
  html($espace.'  else');
  html($espace.'    {');
  html($espace.'    var xhr_object = null;');
  html($espace.'    if(window.XMLHttpRequest) // Firefox');
  html($espace.'      xhr_object = new XMLHttpRequest();');
  html($espace.'    else if(window.ActiveXObject) // Internet Explorer');
  html($espace.'      xhr_object = new ActiveXObject("Microsoft.XMLHTTP");');
  html($espace.'    else');
  html($espace.'      {');
  html($espace.'      alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");');
  html($espace.'      return;');
  html($espace.'      }');
  html($espace.'    xhr_object.open("POST", "'.$pagerequete.'", true);');
  html($espace.'    xhr_object.onreadystatechange = function()');
  html($espace.'      {');
  html($espace.'      if(xhr_object.readyState == 4) eval(xhr_object.responseText);');
  html($espace.'      }');
  html($espace.'    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");');
  html($espace.'    var data = "nom="+escape(l1)+"&traite=adhe&annee='.$annee.'&adresse=document.principal.'.$champs1.'";');
  html($espace.'    xhr_object.send(data);');
  html($espace.'  } }');
  html($espace.'</script>');
  }

function script_liste_profes($champs1,$champs2,$macro,$espace)
  { // Script pour afficher une liste de professions sur la base d\'un début de frappe
  $pagerequete = 'requetes-pour-script.php';
  html($espace.'<script> <!-- Script pour afficher une liste de professions sur la base d\'un début de frappe-->');
  html($espace.'function '.$macro);
  html($espace.'  {');
  html($espace.'  var l1 = document.principal.'.$champs2.'.value;');
  html($espace.'  var l2 = document.principal.'.$champs1);
  html($espace.'  if(l1.length<2)');
  html($espace.'    {');
  html($espace.'    l2.options.length = 0;');
  html($espace.'    l2.options[l2.options.length] = new Option(" ","0")');
  html($espace.'    }');
  html($espace.'  else');
  html($espace.'    {');
  html($espace.'    var xhr_object = null;');
  html($espace.'    if(window.XMLHttpRequest) // Firefox');
  html($espace.'      xhr_object = new XMLHttpRequest();');
  html($espace.'    else if(window.ActiveXObject) // Internet Explorer');
  html($espace.'      xhr_object = new ActiveXObject("Microsoft.XMLHTTP");');
  html($espace.'    else');
  html($espace.'      {'); 
  html($espace.'      alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");');
  html($espace.'      return;');
  html($espace.'      }');
  html($espace.'    xhr_object.open("POST", "'.$pagerequete.'", true);');
  html($espace.'    xhr_object.onreadystatechange = function()');
  html($espace.'      {');
  html($espace.'      if(xhr_object.readyState == 4) eval(xhr_object.responseText);');
  html($espace.'      }');
  html($espace.'    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");');
  html($espace.'    var data = "nom="+escape(l1)+"&traite=prof&adresse=document.principal.'.$champs1.'";');
  html($espace.'    xhr_object.send(data);');
  html($espace.'  } }');
  html($espace.'</script>');
  }

function script_aidevisuelle($espace)
  {   
  html($espace.'<script> <!-- Script pour gérer les aides visuelles -->');
  html($espace.'function addLoadEvent(func) {');
  html($espace.'  var oldonload = window.onload;');
  html($espace.'  if (typeof window.onload != "function") {');
  html($espace.'    window.onload = func;');
  html($espace.'  } else {');
  html($espace.'    window.onload = function() {');
  html($espace.'      oldonload();');
  html($espace.'      func();');
  html($espace.'} } }');
  html($espace.'function prepareInputsForHints() {');
  html($espace.'  var inputs = document.getElementsByTagName("input");');
  html($espace.'  for (var i=0; i<inputs.length; i++){');
  html($espace.'    if (inputs[i].parentNode.getElementsByTagName("span")[0]) {');
  html($espace.'      inputs[i].onfocus = function () {');
  html($espace.'        this.parentNode.getElementsByTagName("span")[0].style.display = "inline";');
  html($espace.'      }');
  html($espace.'      inputs[i].onblur = function () {');
  html($espace.'        this.parentNode.getElementsByTagName("span")[0].style.display = "none";');
  html($espace.'      }');
  html($espace.'    }');
  html($espace.'  }');
  html($espace.'  var selects = document.getElementsByTagName("select");');
  html($espace.'  for (var k=0; k<selects.length; k++){');
  html($espace.'    if (selects[k].parentNode.getElementsByTagName("span")[0]) {');
  html($espace.'      selects[k].onfocus = function () {');
  html($espace.'        this.parentNode.getElementsByTagName("span")[0].style.display = "inline";');
  html($espace.'      }');
  html($espace.'      selects[k].onblur = function () {');
  html($espace.'        this.parentNode.getElementsByTagName("span")[0].style.display = "none";');
  html($espace.'      }');
  html($espace.'    }');
  html($espace.'  }');
  html($espace.'}');
  html($espace.'addLoadEvent(prepareInputsForHints);');
  html($espace.'</script>');
  }

function script_test($espace)
  { // Script pour la gestion des niveaux scolaires
  html($espace.'<script> <!-- Script pour la gestion du lien salle/info salle-->');
  html($espace.'  var s = document.principal.infopiece;');
  html($espace.'  for (var prop in s)');
  html($espace.'  {document.write("", prop, " = ","", s[prop],"",", ");}');
  html($espace.'</script>');
  }  

  
?>