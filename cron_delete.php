<?php

include("actions/connect.php");
include("actions/functions.php");

// Forbidden : Delete all files
$data = display_data();
$nb = count($data[0]);
for ($i=0; $i<$nb; $i++) {
   foreach ($data as $value) {
	delete_file($value[$i][0]);
   }
}
?>
