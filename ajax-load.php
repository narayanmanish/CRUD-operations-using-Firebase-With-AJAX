<?php
session_start();
  include('dbcon.php');

/* fetch the data form firebase database using ajax and print ----Start---*/
$output="";
$output.="<thead>
              <tr>
                <th>Sr No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Id</th>
                <th>Phone No</th>
                <th colspan=2 class='text-center'>Action</th>
              </tr>
            </thead>
            <tbody>";
               $ref_table='contacts';
              $fetchdata= $database->getReference($ref_table)->getValue(); 
              if ($fetchdata>0) 
              {    $i=0;
                foreach ($fetchdata as $key => $row) {
                                       $i++;
                                   $output.="<tr>
                                      <td>{$i}</td>
                                      <td>{$row['firstname']}</td>
                                      <td>{$row['lastname']}</td>
                                      <td>{$row['email']}</td>
                                      <td>{$row['phone']}</td>
                                      <td>
                                        
                                        <button class='edit-btn btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModaledit'   data-eid='{$key}'>Edit</button>
                                      </td>
                                      <td>
                                        
                                      <button Class='btn btn-danger btn-sm delete-btn'  data-id='{$key}'>Delete</button>
                                      </td>
                                     </tr>";
                 
                }
              }
              else
              {
                
               $output.= '<tr>
                  <td colspan="7">N Record Found</td>
                </tr>';
              
              }
            $output.="</tbody>";

echo  $output;

/* fetch the data form firebase database using ajax and print ----Start---*/



 if (isset($_POST['delete_btn']))
 {
 	$del_id=$_POST['delete_btn'];
 	$ref_table='contacts/'.$del_id;
 	$delete=$database->getReference($ref_table)->remove();
 	if ($delete) {
  	$_SESSION['status']="Contact Deleted Sucessfully";
  	header('Location: index.php');
  }
  else
  {
  	$_SESSION['status']="Contact Not Delete";
  	header('Location: index.php');
  }
 }





 if (isset($_POST['update_contact'])) {
 	 $key=$_POST['key'];
  	 $f_name=$_POST['f_name'];
  	  $l_name=$_POST['l_name'];
  	   $email=$_POST['email'];
  	    $phone=$_POST['phone'];


   $updateData = [
                 'firstname'=>$f_name,
                 'lastname'=>$l_name,
                 'email'=>$email,
                 'phone'=>$phone
             ];
             $ref_table='contacts/'.$key;
 $update=$database->getReference($ref_table)->update($updateData);
   if ($update) {
  	$_SESSION['status']="Contact Updated Sucessfully";
  	header('Location: index.php');
  }
  else
  {
  	$_SESSION['status']="Contact Not update";
  	header('Location: index.php');
  }



}


  if (isset($_POST['save_contact'])) {
  	 $f_name=$_POST['f_name'];
  	  $l_name=$_POST['l_name'];
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
  	$_SESSION['status']="Contact added Sucessfully";
  	header('Location: index.php');
  }
  else
  {
  	$_SESSION['status']="Contact Not added";
  	header('Location: index.php');
  }


  }
?>