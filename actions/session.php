<?php

//echo $_POST['email'];
//echo $_POST['password'];

    // Register
     if(!empty($_POST['email']) and $_POST['silly_hidden_login_text'] == "starkyethutchauclubdorotheeunmercredimatin")
     {
            $c = new Mongo("127.0.0.1:27017");         // Connect
            $db = $c->backupfile2;                // Select DB
            //$db->authenticate("user","password");        // Authenticate to MongoDB
            $collection = $c->backupfile2->users;
            $data = array( "email" => $_POST['email'], "password" => $_POST['password']);
            $collection->insert( $data );

            $c->close();                                // Disconnect from Server

	  echo "yes";
     }  else
     	  echo "no";

    // Login
     if(!empty($_POST['email']) and !empty($_POST['password'])
     {
            $c = new Mongo("127.0.0.1:27017");         // Connect
            $db = $c->backupfile2;                // Select DB
            //$db->authenticate("user","password");        // Authenticate to MongoDB
            $collection = $c->backupfile2->users;
            $obj = $collection->findOne();

            $c->close();                                // Disconnect from Server

	  echo "yes";
     }  else
     	  echo "no";


?>
