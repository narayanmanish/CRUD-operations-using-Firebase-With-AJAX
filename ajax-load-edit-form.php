
					<?php
					include('dbcon.php');
					
						$key_child=$_POST['eid'];
						$ref_table='contacts';
						$getdata=$database->getReference($ref_table)->getChild($key_child)->getValue();
						$output="";
						if ($getdata>0) 
						{
							
							 $output.="
							 	<input type='hidden' name='key' id='key' value='{$key_child}'>
						<div class='form-group mb-3'>
							<label>First Name</label>
							<input type='text' class='form-control' value='{$getdata['firstname']}' name='fname' id='fname'>
						</div>
						<div class='form-group mb-3'>
							<label>Last Name</label>
							<input type='text' class='form-control' value='{$getdata['lastname']}' name='lname' id='lname'>
						</div>
						<div class='form-group mb-3'>
							<label>Email</label>
							<input type='email' class='form-control' value='{$getdata['email']}' name='emaile' id='emaile'>
						</div>
						<div class='form-group mb-3'>
							<label>Phone No</label>
							<input type='number' class='form-control' value='{$getdata['phone']}' name='phonee' id='phonee'>
						</div>
						<div class='form-group mb-3'>
							<button type='submit' name='update_contact' id='update_contact' class='btn btn-primary'>Update Contact</button>
						</div>";
				
							
							
						}
						else
						{
							$output.="<h4>No Record found";
							
						}
					
					echo $output;
					?>
		