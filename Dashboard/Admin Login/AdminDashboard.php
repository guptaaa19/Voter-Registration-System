<?php 
	$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');
	$query = "SELECT * FROM addcandidate";
	$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

	<style>
		/* Global Styling */
		* {
			box-sizing: border-box;
		}
		body {
			font-family: 'Poppins', sans-serif;
			color: #333;
			background: linear-gradient(120deg, #FF5733, #FFD700, #008000);
			background-size: 200% 200%;
			animation: gradientShift 15s ease infinite;
			transition: background-color 0.3s, color 0.3s;
		}

		/* Gradient Animation */
		@keyframes gradientShift {
			0% { background-position: 0% 50%; }
			50% { background-position: 100% 50%; }
			100% { background-position: 0% 50%; }
		}

		/* Navbar Styling */
		.navbar {
			background-color: #007bff;
			border-radius: 12px;
		}
		.navbar-brand, .nav-item a {
			color: #ffffff !important;
			font-weight: 600;
		}
		.nav-item a:hover {
			color: #ffcb05 !important;
		}

		/* Centered Container Styling */
		.container-centered {
			max-width: 600px;
			margin: 0 auto;
			background: #ffffff;
			border-radius: 12px;
			box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
			padding: 20px;
			text-align: center;
		}

		.section-title {
			font-size: 1.8rem;
			font-weight: 600;
			color: #0056b3;
			margin-bottom: 20px;
		}

		/* Card and Form Styling */
		.card {
			border: none;
			background: #f8f9fa;
			border-radius: 12px;
			box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.15);
			margin: 0 auto;
			max-width: 400px;
		}
		.btn-primary {
			background-color: #007bff;
			border: none;
			transition: all 0.3s ease;
			width: 100%;
		}
		.btn-primary:hover {
			background-color: #0056b3;
			transform: scale(1.02);
		}

		/* Table Styling */
		.table-container {
			margin: 0 auto;
			max-width: 600px;
		}
		.table {
			border-radius: 10px;
			overflow: hidden;
		}
		.table thead {
			background-color: #0056b3;
			color: #ffffff;
		}
		.table th, .table td {
			text-align: center;
			vertical-align: middle;
		}
		.table img {
			border-radius: 8px;
			transition: transform 0.3s;
		}
		.table img:hover {
			transform: scale(1.1);
		}
	</style>
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="Image/Admin.png" width="30" alt="Admin" class="me-2"> Admin Panel
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item"><a class="nav-link" href="#Header">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="#AddCandidate">Add Candidate</a></li>
					<li class="nav-item"><a class="nav-link" href="#Total">Total Candidate</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Main Title -->
	<div class="container-centered text-center my-4">
		<h1 class="section-title">Vote From Home</h1>
		<h2 class="logo">अपना वोट, <span>अपना कर्तव्य</span> </h2>
		</div>

	<!-- Add Candidate Form -->
	<div id="AddCandidate" class="container-centered my-4">
		<h2 class="section-title">Add Candidate for Election</h2>
		<hr>
		<div class="card p-4">
			<form action="AddCanddiate.php" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="cname" class="form-label">Candidate Name</label>
					<input type="text" class="form-control" id="cname" name="cname" placeholder="Enter candidate's name" required>
				</div>
				<div class="mb-3">
					<label for="cparty" class="form-label">Party Name</label>
					<input type="text" class="form-control" id="cparty" name="cparty" placeholder="Enter party name" required>
				</div>
				<div class="mb-3">
					<label for="symbol" class="form-label">Select Symbol</label>
					<input type="file" class="form-control" id="symbol" name="symbol" required>
				</div>
				<div class="mb-3">
					<label for="photo" class="form-label">Select Photo</label>
					<input type="file" class="form-control" id="photo" name="photo" required>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>

	<!-- Total Candidates Table -->
	<div id="Total" class="container-centered my-4">
		<h2 class="section-title">Total List of Candidates</h2>
		<div class="table-container card p-4">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Candidate Name</th>
						<th>Party</th>
						<th>Photo</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = mysqli_fetch_assoc($result)) { ?>
						<tr>
							<td><?php echo $row['cname']; ?></td>
							<td><?php echo $row['cparty']; ?></td>
							<td><img src="Image/<?php echo $row['photo']; ?>" class="img-fluid" width="50"></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>
