<?php 
	include("actions/connect.php");
	include("actions/functions.php");

	//if javascript is disabled, the ftp will still work
	if (isset($_FILES["file"])) {
		if ($_FILES["file"]["error"] > 0) {
		  $error = 'Error Uploading!';
		} else {
		    $count = '1';
		    $file_loc = $path . $_FILES["file"]["name"];
		    $base = $_FILES["file"]["name"];
		    while ( file_exists($file_loc) ) {
			$file_loc = $path . $count.'-'. $_FILES["file"]["name"];
			$base = $count.'-'. $_FILES["file"]["name"];
			$count++;

		    }
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Upload file Application Demo by LegeardWeb</title>
                <script type="text/javascript" src="js/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/uploadify/swfobject.js"></script>
		<script type="text/javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
		<script type="text/javascript" src="js/jquery.application.js"></script>
                <script type="text/javascript" src="js/jquery.carousel.min.js"></script>
                <script type="text/javascript" src="js/jquery.superbox.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
                <script type="text/javascript">
                     $(function(){
                        $("div.carousel").carousel();
                     });
                </script>
		
	</head>
	
	<body>
		<div id="body">
		<div id="msgbox"></div>
                <div id="top">
                        <a href="#login" rel="superbox[content][200x200]">Login</a> | <a href="#register" rel="superbox[content][200x200]">Register</a>

                        <div id="login">
                            <h2>Connectez vous</h2>
				<form action="#" method="post">
					<p>Adresse email : <input type="text" name="email" id="email" /></p>
                                        <p>Mot de passe : <input type="password" name="password" id="password" /></p>
					<p><input type="submit" name="submit" value="Login" /></p>
				</form>
                        </div>
                        <div id="register">
                            <h2>Enregistrez vous</h2>
				<form action="" method="post">
                                    <fieldset>
                                        <label for="email" id="name_label">Adresse email</label>
					<input type="text" name="email" id="email" />
                                        <label class="error" for="name" id="name_error">Ce champ est obligatoire.</label>
                                        <input type="hidden" name="silly_hidden_login_text" value="starkyethutchauclubdorotheeunmercredimatin" />
                                        <input type="submit" name="submit" class="button" value="Register" />
                                    </fieldset>
				</form>
                            <span></span>
                        </div>
                </div>
                <h2>Upload file Application Demo <span id="loader"><img src="img/loading.gif" alt="Loading..." /></span></h2>
                <p>Download tes fichiers avec facilit&eacute; ...</p>

                        <div id="sidebar">
                        <span>
				<!-- form to be replaced by uploadify -->
				<form id="mainftp" action="index.php" method="post" enctype="multipart/form-data">
					<p><input type="file" name="file" id="file" /></p>
					<p><input type="submit" name="submit" value="Upload" /></p>
				</form>

			<p>Cliquer sur 'Browser Files...' pour t&eacute;l&eacute;charger vos fichiers sur le serveur.<br/>
			Vous pouvez transf&eacute;rer des fichiers d'une taille de 520 Kb.</p>
                        </span>

                        <p>Developp&eacute; avec PHP, HTML, CSS, JQuery</p>
                        <p>Propuls&eacute; par Nginx et MongoDB</p>
			</div>
                
			<!-- whole div to be refreshed once uploadify is finished -->
			<div id="allfiles">
                        <h3>Liste</h3>
                        <ul class="tabs">
                            <li><a href="#">tout terrain</a></li>
                            <li><a href="#">&agrave; la vertical</a></li>
                            <li><a href="#">dans un carousel</a></li>
                        </ul>

                        <div class="clear"></div>
                        
                        <div class="panes">

                            <div class="tab">

                              <ul>
                              <?php
                                $data = display_data();
                                $nb = count($data[0]);
                                for ($i=0; $i<$nb; $i++) {
                                  foreach ($data as $value) { ?>
                                    <li><a href="download.php?file=<?php echo $value[$i][0]; ?>">
                                    <img src="download.php?file=<?php echo $value[$i][0]; ?>" alt="<?php echo $value[$i][0]; ?>" width="350px" height="235px" /></a>
                                    <cite><?php echo $value[$i][0]; ?>
                                    - <?php echo format_bytes($value[$i][1]); ?>
                                    <a href="javascript:delete_file('<?php echo $value[$i][0]; ?>');" class="delete" title="Supprimer">
                                    <img src="img/cancel.png" alt="Supprimer" /></a></cite></li>
                              <?php
                                  }
                                 }
                              ?>
                              </ul>

                            </div>

                            <div class="tab">

                            <table class="example" id="dnd-example">
                            <caption>Liste des fichiers.</caption>
                            <thead>
			     <tr>
			       <th>Titre</th>
			       <th>Date</th>
			       <th>Taille</th>
			       <th>&nbsp;</th>
			     </tr>
			       </thead>
			       <tbody>
                              <?php
                                $data = display_data();
                                $nb = count($data[0]);
                                for ($i=0; $i<$nb; $i++) {
                                  foreach ($data as $value) { ?>
                                    <tr id="node-<?php echo $i; ?>">
                                    <td><span class="file"><a href="download.php?file=<?php echo $value[$i][0]; ?>" rel="superbox[image]"><?php echo $value[$i][0]; ?></a> </td>
                                    <td>date</td>
                                    <td><?php echo format_bytes($value[$i][1]); ?></td>
                                    <td><a href="javascript:delete_file('<?php echo $value[$i][0]; ?>');" class="delete" title="Supprimer">
                                    <img src="img/cancel.png" alt="Supprimer" /></a></td>
                                    </tr>
                              <?php
                                  }
                                }
                              ?>

                                </tbody>
                             </table>

                             </div>

                            <div class="tab">

                            <div class="carousel">
                              <ul>
                              <?php
                                $data = display_data();
                                $nb = count($data[0]);
                                for ($i=0; $i<$nb; $i++) {
                                  foreach ($data as $value) { ?>
                                    <li><a href="download.php?file=<?php echo $value[$i][0]; ?>" rel="superbox[image]">
                                    <img src="download.php?file=<?php echo $value[$i][0]; ?>" alt="<?php echo $value[$i][0]; ?>" width="350px" height="235px" /></a>
                                    <cite><?php echo $value[$i][0]; ?><br />date
                                    - <?php echo format_bytes($value[$i][1]); ?>
                                    <a href="javascript:delete_file('<?php echo $value[$i][0]; ?>');" class="delete" title="Supprimer">
                                    <img src="img/cancel.png" alt="Supprimer" /></a></cite></li>
                              <?php
                                  }
                                }
                              ?>
                              </ul>
                            </div>

                            </div>

                        </div> <!-- panes -->

			</div> <!-- allfiles -->
	
		<div class="clear"></div>
		
		<p>Demo par <a href="http://www.legeardweb.com/">legeardweb.com</a></p>
		
		</div>

	  <script type="text/javascript">
                                $(function(){
                                $.superbox.settings = {
                                        boxId: "superbox", // Id attribute of the "superbox" element
                                        boxClasses: "", // Class of the "superbox" element
                                        overlayOpacity: .8, // Background opaqueness
                                        loadTxt: "Loading...", // Loading text
                                        closeTxt: "Fermer", // "Close" button text
                                        prevTxt: "Precedent", // "Previous" button text
                                        nextTxt: "Suivant" // "Next" button text
                                };
                                $.superbox();
                                });

                                // perform JavaScript after the document is scriptable.
                                $(function() {
                                        // setup ul.tabs to work as tabs for each div directly under div.panes
                                        $("ul.tabs").tabs("div.panes > div.tab");
                                });

                                $(function() {
                                    $('.error').hide();
                                    $(".button").click(function() {
                                      // validate and process form here

                                      $('.error').hide();
                                                var email = $("input#email").val();
                                                if (email == "") {
                                        $("label#email_error").show();
                                        $("input#email").focus();
                                        return false;
                                      }

                                    });
                                  });


	  </script>

</body>
</html>
