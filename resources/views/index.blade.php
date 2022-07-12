<!DOCTYPE html>
<html>
<head>
	<title>User App</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

	<div class="container" style="margin-top: 50px;">

		<button id="hideAndShowAddUserForm" class="btn btn-primary">Add User</button>
		<div id="addUserArea" style="width: 500px; background: cyan; padding: 16px; border-radius: 8px; display: none;">
			<form action="" method="POST" enctype="multipart/form-data" id="AddUserForm">
				@csrf
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>E-mail</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" />
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Profile Image</label>
							<input type="file" name="profile_img" id="profile_img" class="form-control" accept="image/*" />
						</div>
					</div>
					<div class="col-md-12" id="loader" style="display: none;">
						<img src="loader.gif" style="height: 50px; width: 50px; margin:16px;">
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit" name="addSubmitBtn" id="addSubmitBtn" class="form-control">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div id="allUsersListsArea">
			<table class="table">
				<thead>
					<th>S.NO.</th>
					<th>IMAGE</th>
					<th>NAME</th>
					<th>E-mail</th>
					<th>PASSWORD</th>
					<th>EDIT</th>
					<th>REMOVE</th>
				</thead>
				<tbody>
					@foreach($all_users as $i)
					<tr>
						<td>{{$loop->iteration}}</td>
						<td><img src="my_images/{{$i->profile_img}}" style="height: 50px; width: 50px; border-radius: 8px;"></td>
						<td>{{$i->name}}</td>
						<td>{{$i->email}}</td>
						<td>{{$i->password}}</td>
						<td><a href="edit_user/{{$i->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a></td>
						<td><a href="delete_user/{{$i->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>


	</div>



<!-------------------------custom script------------------------->
<script type="text/javascript">
	$(document).ready(function(){
		//hide and show user addition form
		$("#hideAndShowAddUserForm").click(function(){
			$("#addUserArea").toggle(1000);
		})

		//user add form submit
		$("#addSubmitBtn").click(function(e){
			e.preventDefault();
			
			var name = $("#name").val();
			var email = $("#email").val();
			var password = $("#password").val();
			var profile_img = $("#profile_img").val();

			if(name == "")
			{
				showPopUp('Hey ','Please enter your name!','error',2000);
			}
			else if(email == "")
			{
				showPopUp('Hey '+name,'Please enter your email!','error',2000);
			}
			else if(password == "")
			{
				showPopUp('Hey '+name,'Please enter your password!','error',2000);
			}
			else if(profile_img == "")
			{
				showPopUp('Hey '+name,'Please choose your profile image!','error',2000);
			}
			else{
				$("#loader").show();

				var formData = new FormData($("#AddUserForm")[0]);

				$.ajax({
					url:"add_user_form_submit",
					method:"post",
					data:formData,
					cache:false,
					contentType:false,
					processData:false,
					dataType:"html",
					success:function(response){
						$("#loader").hide(1000);
						if(response == 1){
							showPopUp('Hey '+name,'You have successfully created your account!','success',2000);
							setTimeout(window.open('/','_self'),5000);
						}
						else{
							showPopUp('Hey '+name,'Something went wrong, Please try again!','error',2000);
						}
					}
				});
			}

		});
		function showPopUp($title,$text,$icon,$timer){
			swal({
                title: $title,
	            text: $text,
	            icon: $icon,
	            button: "Ok",
	            timer: $timer
       		 });
		}
	});
</script>

</body>
</html>