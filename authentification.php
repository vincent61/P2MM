<?php

  // Definition des constantes et variables
  define('LOGIN','p2mm');
  define('PASSWORD','laseparation2013');
  $errorMessage = '';
 
  // Test de l'envoi du formulaire
  if(!empty($_POST)) 
  {
    // Les identifiants sont transmis ?
    if(!empty($_POST['login']) && !empty($_POST['password'])) 
    {
      // Sont-ils les m�mes que les constantes ?
      if($_POST['login'] !== LOGIN) 
      {
        $errorMessage = 'Mauvais login !';
      }
        elseif($_POST['password'] !== PASSWORD) 
      {  
        $errorMessage = 'Mauvais password !';
      }
        else
      {
        // On ouvre la session
        session_start();
        // On enregistre le login en session
        $_SESSION['login'] = LOGIN;
		$_SESSION['pwd']=PASSWORD;
        // On redirige vers le fichier admin.php
        header('Location: index.php?zone=admin');  
        exit();
      }
    }
      else
    {
      $errorMessage = 'Veuillez inscrire vos identifiants svp !';
    }
  }
  	include_once 'vue/base/header.php';
?>
  
<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
	  <div id="sidebar">
		<ul>
			<li>
				<p><img class = "logo" src="vue/ressources/petitLogo.png" width="151" height="151" alt="" /></p>
			</li>
		</ul>
        </div>
	  
        <div id="content">
          <div class="post">
            <h2 class="title">Connexion Admin</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
              <fieldset>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <fieldset>
        <legend>Identifiez-vous</legend>
        <?php
          // Rencontre-t-on une erreur ?
          if(!empty($errorMessage)) 
          {
            echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
          }
        ?>
       <p>
          <label for="login">Login :</label> 
          <input type="text" name="login" id="login" value="" />
        </p>
        <p>
          <label for="password">Password :</label> 
          <input type="password" name="password" id="password" value="" /> 
          <input type="submit" name="submit" value="Connexion" />
        </p>
      </fieldset>
    </form>
 </div>
          </div>
        </div>
        <!-- end #content -->
        <div style="clear: both;">&nbsp;</div>
      </div>
    </div>
  </div>
</html>
<?php
include "vue/base/footer.html";
?>

