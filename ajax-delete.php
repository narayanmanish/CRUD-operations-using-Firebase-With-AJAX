	
<?php
include("dbcon.php");
	$del_id=$_POST['id'];
 	$ref_table='contacts/'.$del_id;
 	$delete=$database->getReference($ref_table)->remove();
 	if ($delete) {
  	echo 1;
  }
  else
  {
  	echo 0;
  }
  ?>