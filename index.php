<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "ManageUser";

$connection = mysqli_connect($host, $user, $pass, $database);

//collect form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$doj = $_POST['doj'];
$salary = $_POST['salary'];


if ($firstname && $lastname && $email && $address && $doj && $salary) {
	$sql = " INSERT INTO users (firstname, lastname, email, address, doj, salary) VALUES ('$firstname', '$lastname','$email','$address', '$doj', '$salary')";
	mysqli_query($connection, $sql);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/2507d0bfa1.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">

				<div class="table-title">

					<div class="row">

						<div class="col-sm-6">
							<h2>Manage <b>Users</b></h2>
						</div>

						<div class="col-sm-6">


							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"> <span>Add New User</span></a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Address</th>
							<th>Date of Joining</th>
							<th>Salary</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$select = "SELECT * FROM users";

						$query =  mysqli_query($connection, $select);

						while ($row = mysqli_fetch_array($query)) {

						?>
							<tr>
								<td><?php echo $row['No'] ?></td>
								<td><?php echo $row['firstname'] ?></td>
								<td><?php echo $row['lastname'] ?></td>
								<td><?php echo $row['email']  ?></td>
								<td><?php echo $row['address'] ?></td>
								<td><?php echo $row['doj'] ?></td>
								<td> <?php echo $row['salary'] ?></td>
								<td>
									<a href="#editEmployeeModal" class="edit editbtn" data-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></a>
									<a href="#deleteEmployeeModal" onclick="<?php $id = $row['No'] ?>" class="delete deletebtn" data-toggle="modal"><i class="fa-solid fa-trash-can"></i></a>
								</td>
							</tr>
						<?php
						}

						?>

					</tbody>
				</table>

			</div>
		</div>
		<!-- Add Modal HTML -->
		<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="index.php" method="POST">
						<div class="modal-header">
							<h4 class="modal-title">Add User</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group row">
								<div class="col">
									<label>First Name</label>
									<input type="text" name="firstname" class="form-control" required>
								</div>
								<div class="col">
									<label>Last Name</label>
									<input type="text" name="lastname" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" name="address" required></textarea>
							</div>
							<div class="form-group">
								<label>Date of Joinig</label>
								<input type="date" class="form-control" name="doj" required>
							</div>

							<div class="form-group">
								<label>Salary</label>
								<input type="number" class="form-control" name="salary" required>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-success" value="Add">
						</div>
					</form>
				</div>
			</div>
		</div>


		<script>
			$(document).ready(function() {

				$("#submit").click(function() {

					var firstName = $("#firstname").val();
					var lastName = $("#lastname").val();
					var email = $("#email").val();
					var message = $("#message").val();

					if (firstName == '' || lastName == '' || email == '' || message == '') {
						alert("Please fill all fields.");
						return false;
					}

					$.ajax({
						type: "POST",
						url: "store.php",
						data: {
							firstName: firstName,
							lastName: lastName,
							email: email,
							message: message
						},
						cache: false,
						success: function(data) {
							alert(data);
						},
						error: function(xhr, status, error) {
							console.error(xhr);
						}
					});

				});

			});
		</script>

		<!-- Edit Modal HTML -->
		<div id="editEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="editcode.php" id="editform" method="POST">
						<div class="modal-header">
							<h4 class="modal-title">Edit User</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group row">

								<input type="hidden" name="update_id" id="update_id">

								<div class="col">
									<label>First Name</label>
									<input type="text" name="firstname" id="firstname" class="form-control" required>
								</div>
								<div class="col">
									<label>Last Name</label>
									<input type="text" name="lastname" id="lastname" class="form-control" required>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" id="email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" name="address" id="address" required></textarea>
							</div>
							<div class="form-group">
								<label>Date of Joinig</label>
								<input type="date" class="form-control" name="doj" id="doj" required>
							</div>

							<div class="form-group">
								<label>Salary</label>
								<input type="text" class="form-control" name="salary" id="salary" required>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" name="updatedata" class="btn btn-info" value="Save">
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Delete Modal HTML -->
		<div id="deleteEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="deletecode.php" method="POST">
						<div class="modal-header">
							<h4 class="modal-title">Delete User</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<input type="hidden" name="delete_id" id="delete_id">
							<p>Are you sure you want to delete these Records?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" name="deletedata" class="btn btn-danger" value="Delete">
						</div>
					</form>
				</div>
			</div>
		</div>


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- Edit script -->
		<script>
			$(document).ready(function() {

				$('.editbtn').on('click', function() {

					$tr = $(this).closest('tr');
					var data = $tr.children("td").map(function() {
						return $(this).text();
					}).get();

					console.log(data);
					$('#update_id').val(data[0]);
					$('#firstname').val(data[1]);
					$('#lastname').val(data[2]);
					$('#email').val(data[3]);
					$('#address').val(data[4]);
					$('#doj').val(data[5]);
					$('#salary').val(data[6]);

				});
			});
		</script>


		<!-- delete script -->
		<script>
			$(document).ready(function() {
				$('.deletebtn').on('click', function() {
					$tr = $(this).closest('tr');
					var data = $tr.children("td").map(function() {
						return $(this).text();
					}).get();

					$('#delete_id').val(data[0]);

				});
			});
		</script>


		<?php
		mysqli_close($connection);
		?>

	</div>


</body>

</html>