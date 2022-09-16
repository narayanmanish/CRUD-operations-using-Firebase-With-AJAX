<?php 
session_start();
include('include/header.php');
?>
<div class="container">
	<div class="row ">
		<div class="col-md-12" id="success-message">
          
			<div class="card">
				<div class="card-header">
					<h4>PHP Firebase CRUD With AJAX
						<!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Add Contacts
                        </button>
					</h4>
				</div>
				<div class="card-body">

					<table class="table table-bordered table-striped" id="table-data">
						
					</table>
				</div>
			</div>
		</div>
	</div>


</div>
<!-- insert Modal start -->
<div class="modal fade" id="exampleModal"  >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Contacts</h5>
        
      </div>
      <div class="modal-body">
        <form id="addForm">
						<div class="form-group mb-3">
							<label>First Name</label>
							<input type="text" class="form-control" name="f_name" id="f_name" required>
						</div>
						<div class="form-group mb-3">
							<label>Last Name</label>
							<input type="text" class="form-control" name="l_name" id="l_name">
						</div>
						<div class="form-group mb-3">
							<label>Email</label>
							<input type="email" class="form-control" name="email" id="email">
						</div>
						<div class="form-group mb-3">
							<label>Phone No</label>
							<input type="number" class="form-control" name="phone" id="phone">
						</div>
						<div class="form-group mb-3">
							<input type="submit" name="save_contact" id="save_contact" class="btn btn-primary" value="Save Contact">
						</div>
					</form>
      </div>
    </div>
  </div>
</div>
<!-- insert Modal end -->




<!-- update Modal  start-->
<div class="modal fade" id="exampleModaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Contacts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <div id="modal-form">
          
        </div>
						</div>
      </div>
    </div>
  </div>
</div>
<!-- update Modal end-->


<?php include('include/footer.php') ?>


<script type="text/javascript">
	//fetch data
	     
		
			function load(){
           $.ajax({
            url:"ajax-load.php",
            type:"POST",
            success: function(data)
            {
            	$("#table-data").html(data);
            }
           });
           }
	
	
	load();


 // Insert New Records
    $(document).on("click","#save_contact",function(e){
    	e.preventDefault();
      var fname = $("#f_name").val();
      var lname = $("#l_name").val();
      var emai = $("#email").val();
      var phon = $("#phone").val();
   
        $.ajax({
          url: "ajax-insert.php",
          type : "POST",
          data : {first_name:fname, last_name: lname, email:emai, phone:phon},
          success : function(data){
            if(data){
            	   $("#addForm")[0].reset();
            	alert(data);  
              $("#exampleModal").modal('hide');
              load().ajax.reload();
            }
            else{
              alert("Records Not Insert");
            }

          }

        });
     

    });

       //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var studentId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : studentId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

 //Show edit form data
    $(document).on("click",".edit-btn", function(){
      var id = $(this).data("eid");

      $.ajax({
        url: "ajax-load-edit-form.php",
        type: "POST",
        data: {eid: id },
        success: function(data) {
          $("#modal-form").html(data);
        }
      })
    });

    //Save Update Form
      $(document).on("click","#update_contact", function(){
        var Id = $("#key").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var emai = $("#emaile").val();
        var phon = $("#phonee").val();
        $.ajax({
          url: "ajax-update.php",
          type : "POST",
          data : {id: Id, first_name: fname, last_name: lname, email: emai, phone: phon},
          success: function(data) {
            if(data){
              alert(data);  
              $("#exampleModaledit").modal('hide');
              load().ajax.reload();
            }
          }
        })
      });
</script>
