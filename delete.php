<?php
    $c = new Mongo("127.0.0.1:27017");         // Connect
    $db = $c->backupfile2;                // Select DB
    $db->authenticate("user","password");        // Authenticate to MongoDB
    $grid = $db->getGridFS();                    // Initialize GridFS

    $filename = $_REQUEST["file"];                // Get requested filename

    $file = $grid->findOne($filename);             // Find file in GridFS
    $id = $file->file['_id'];                    // Get the files ID
    $grid->delete($id);                            // Delete the file

    $c->close();                                // Disconnect from Server
    exit(0);
?>