
<?php

session_start();
include_once 'vue/base/header.php';
session_unset ();  
// On detruit notre session
session_destroy ();
?>
<html>
<div id="wrapper"> 
  <!-- end #header -->
  <div id="page">
    <div id="page-bgtop">
      <div id="page-bgbtm">
        <div id="content">
          <div class="post">
            <h2 class="title">Deconnexion</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
			<p>Vous etes deconnecte.</p>
			</div>
          </div>
        </div>
        <!-- end #content -->
        <div style="clear: both;">&nbsp;</div>
      </div>
    </div>
  </div></div>
 <?php
include "vue/base/footer.html";
?>
</html>

