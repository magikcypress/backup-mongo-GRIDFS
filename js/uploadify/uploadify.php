<?php
/*
Uploadify v2.1.0
Release Date: August 24, 2009

Copyright (c) 2009 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);

        try {

        $today = date("Y-m-d H:i:s");

        include("../../actions/connect.php");
        $c = new ConnectDB();
        $gridfs = $c->findata();

        if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {

          //$id = $gridfs->storeUpload('Filedata', array("metadata" => array("date" => new MongoDate())));
          $id = $gridfs->storeUpload('Filedata');
          $date = date('Y-M-d h:i:s');
          $metadata = array('$set' => array("comment"=>"New insert", "date"=>$date));
          $critere = array('_id' => $id);
          $gridfs->comment->update($critere, $metadata);
        } else {
          throw new Exception('Invalid file upload');
        }
        $c->close();

        } catch (MongoConnectionException $e) {
          die('Error connecting to MongoDB server');
        } catch (MongoException $e) {
          die('Error: ' . $e->getMessage());
        }


		//move_uploaded_file($tempFile,$targetFile);
		//chmod($targetFile, 0644);
		echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>