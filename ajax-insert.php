<?php
include('dbcon.php');
$f_name = $_POST["first_name"];
$l_name = $_POST["last_name"];
$email=$_POST['email'];
$phone=$_POST['phone'];

 $postData = [
                 'firstname'=>$f_name,
                 'lastname'=>$l_name,
                 'email'=>$email,
                 'phone'=>$phone
             ];
           
             $ref_table='contacts';
$postRef = $database->getReference($ref_table)->push($postData);


  if ($postRef) {
  		echo "Record Inserted Sucessfully";
  }
 
?>
