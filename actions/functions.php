<?php
/**
 * display_data PHP function
 *
 */
function display_data() {

         try {

           $c = new ConnectDB();
           $cursor = $c->findalldata();

           foreach ($cursor as $obj) {
                   $object[] = array($obj->getFilename(), $obj->getSize());
           }
           return array($object);

           $c->close();

         } catch (MongoConnectionException $e) {
              die('Error connecting to MongoDB server');
         } catch (MongoException $e) {
              die('Error: ' . $e->getMessage());
         }
}

/**
 * formatBytes PHP function
 * 
 */	
function format_bytes($bytes, $precision = 2) {
           $units = array('B', 'KB', 'MB', 'GB', 'TB');

           $bytes = max($bytes, 0);
           $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
           $pow = min($pow, count($units) - 1);

           $bytes /= pow(1024, $pow);

           return round($bytes, $precision) . ' ' . $units[$pow];
} 	

/**
 * delete_file PHP function
 * 
 */	 
function delete_file($filename) {

         try {
                $c = new ConnectDB();
                $c->removedata($filename);

                $c->close();
                echo "yes";

          } catch (MongoConnectionException $e) {
                die('Error connecting to MongoDB server');
          } catch (MongoException $e) {
                die('Error: ' . $e->getMessage());
          }
     
}

if(!empty($_GET['filedel'])) {
        include("connect.php");
	delete_file($_GET['filedel']);
} else {
        //echo "Error";
}



     
