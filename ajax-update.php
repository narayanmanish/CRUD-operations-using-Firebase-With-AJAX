<?php

include('dbcon.php');
    $key=$_POST['id'];
  	 $f_name=$_POST['first_name'];
  	  $l_name=$_POST['last_name'];
  	   $email=$_POST['email'];
  	    $phone=$_POST['phone'];


   $updateData = [
                 'firstname'=>$f_name,
                 'lastname'=>$l_name,
                 'email'=>$email,
                 'phone'=>$phone
             ];
             echo print_r($updateData);
             $ref_table='contacts/'.$key;
 $update=$database->getReference($ref_table)->update($updateData);
   if ($update) {
  	echo "Contact Updated Sucessfully";
  	
  }
  else
  {
  	echo "Contact Not update";
  
  }

?>
