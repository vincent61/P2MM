<head>
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Séparation</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="../Vue/base/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="menu-wrapper">
  <div id="menu">
  <ul>
    <li class="current_page_item"> <a href="../Vue/recherche.php">Recherche</a></li>
    <li><a href="../Vue/admin.php">Admin</a></li>
    </div>
  </ul>
  <!-- end #menu --> 
</div>
<div id="header-wrapper">
  <div id="header">
    <div id="logo">
      <h1><a href="#">Séparation</a></h1>
      <p>Procédé inventé par Pierre Fourny</p>
    </div>
  </div>
</div>


<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        ﻿﻿				<div id="sidebar">
					<ul>
						<li>
							<p><img src="/P2MM/Vue/ressources/petitLogo2.png" width="184" height="151" alt="" /></p>
						</li>
						<li>
							<h2>Categories</h2>
							<ul>
								<li><a href="../Controleurs/lettre.php">Lettres</a></li>
								<li><a href="../Controleurs/dictionnaire.php">Dictionnaires</a></li>
								<li><a href="../Controleurs/police.php">Polices</a></li>
								<li><a href="../Controleurs/langue.php">Langues</a></li>
								<li><a href="../Controleurs/codelettre.php">Codes lettres</a></li>
								<li><a href="../Controleurs/mot.php">Mots</a></li>
                                <li><a href="../Controleurs/motcode.php">Mots codes</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- end #sidebar -->          <div id="content">
          <div class="post">
            <h2 class="title">Dictionnaires</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset >
                <form action="../Controleurs/dictionnaire.php" enctype="multipart/form-data" method="post" onSubmit="return validForm(this)">
                  <b>Ajout:</b></br>
                  <p>Nom:
                    <input type="text" name="dictionnaire" />
                  </p>
                  <p> Langue:
                    <select name="langue" size="1">
                      <OPTION>Francaise                    </select>
                  </p>
                  <p>Fichier Dictionnaire:
                    <input type="file" accept=".csv" name="fichierDictionnaire" />
                  </p>
                  <p>Casse:
                    <input type="radio" name="casse" value="0" />
                    Majuscule
                    <input type="radio" name="casse" value="1" />
                    Minuscule </p>
                  <p>
                    <input type="submit" value="Ajouter" />
                  </p>
                </form>
              </fieldset>
              <table border='1'>
                <tr class="titre">
                  <th><u>Dictionnaires</u></th>
                  <th><u>Langue</u></th>
                  <th><u>Fichier Dictionnaire</u></th>
                  <th><u>Casse</u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                  <th><u></u></th>
                </tr>
                                <tr>
                                      <th>miniDico</th>
                    <th>Francaise</th>
                    <th>miniDico.csv</th>
                    <th>Minuscule</th>
                                        <th><a href="../Controleurs/dictionnaire.php?delete=miniDico"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?edit=miniDico"><img src='../Vue/ressources/edit.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?addMotsCode=miniDico"><img src='../Vue/ressources/arrow.png' height='20' width='20' /></a></th>
                                    </tr>
                                <tr>
                                      <th>test</th>
                    <th>Francaise</th>
                    <th>test.csv</th>
                    <th>Minuscule</th>
                                        <th><a href="../Controleurs/dictionnaire.php?delete=test"><img src='../Vue/ressources/supprimer.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?edit=test"><img src='../Vue/ressources/edit.png' height='20' width='20' /></a></th>
                    <th><a href="../Controleurs/dictionnaire.php?addMotsCode=test"><img src='../Vue/ressources/arrow.png' height='20' width='20' /></a></th>
                                    </tr>
                              </table>
            </div>
          </div>
        </div>
        <!-- end #content -->
        <div style="clear: both;">&nbsp;</div>
      </div>
    </div>
  </div>
  <!-- end #page --> 
</div>
<script type="text/javascript" src="/P2MM/functions.js" ></script>
<script type="text/javascript">
function validForm(form){
	var valid = true;
	var msg = "Saisir : \n";
	var displayPopUp = false;

	if (trim(form.elements['dictionnaire'].value) == ""){
		valid = false;
		msg = msg + "- Nom dictionnaire\n";
		displayPopUp = true;
	}

	if (trim(form.elements['fichierDictionnaire'].value) == ""){
		valid = false;
		msg = msg + "- Fichier dictionnaire\n";
		displayPopUp = true;
	}else{
	    var validExts = new Array(".csv");
	    var fileExt = form.elements['fichierDictionnaire'].value;
	    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));

	    if (validExts.indexOf(fileExt) < 0) {
	      alert("- Type de fichier sélectionné invalide, le type de fichier accepté est csv.");
	      valid = false;
	    }
	}

	if (checkRadioButton(form.elements['casse']) == false){
		valid = false;
		msg = msg + "- Casse\n";
		displayPopUp = true;
	}
	
	if (displayPopUp == true) alert(msg);
	return valid;
}
</script>
<div id="footer">
      <p class="tagline_left"> 2012  - <a href="#">P2MM</a></p>
<p class="tagline_right">Réalisé en collaboration avec l'UTC - Laura Daras, Maeva Guerry, Dany Ferreira, Gaëlle Raimbault, Vincent Mercier</p>
      <br class="clear">
</div>
</body>
</html>
</em></em>