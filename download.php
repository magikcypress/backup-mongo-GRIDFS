<?php

    include("actions/connect.php");
    $c = new ConnectDB();
    $grid = $c->findata();

    $ask = $_REQUEST['file'];

    $file = $grid->findOne(array('filename' => $ask));
    $files = $grid->fs->files;
    $file1 = $files->findOne(array('filename' => $ask));
    $id = $file->file['_id'];

    if ( (substr($ask,-3) == 'zip') 
	|| (substr($ask,-3) == 'odt')
	|| (substr($ask,-3) == 'ods')
	|| (substr($ask,-3) == 'odp')
	|| (substr($ask,-3) == 'xls')
	|| (substr($ask,-3) == 'doc')
	|| (substr($ask,-3) == 'docx')
	|| (substr($ask,-3) == 'ppt')
	|| (substr($ask,-3) == 'pptx')
	|| (substr($ask,-3) == 'pdf') ) {
       /* Any file types you want to be downloaded can be listed in this */
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename='.$ask);
       header('Content-Transfer-Encoding: binary');
       $cursor = $grid->fs->chunks->find(array("files_id" => $id))->sort(array("n" => 1));
       foreach($cursor as $chunk) {
          echo $chunk['data']->bin;
       }
    }
    else {
       header('Content-Type: '.$file1["contentType"]);
       echo $file->getBytes();
    }

    $c->close();                                // Disconnect from Server
    exit(0);
?>

