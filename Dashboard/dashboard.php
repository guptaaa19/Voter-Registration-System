<?php
	session_start();
	$voterdata = $_SESSION['voterdata'];
	$conn = mysqli_connect('localhost', 'root', '', 'voterdatabase');

	$query = "SELECT * FROM addcandidate";
	$result = mysqli_query($conn, $query);

	if ($_SESSION['voterdata']['status'] == 0) {
		$status = '<b style="color:green;">Not Voted</b>';
	} else {
		$status = '<b style="color:red;">Voted</b>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style>
		.nav-item a {
			color: whitesmoke;
		}
		.nav-item a:hover {
			background: #dc3545;
			color: whitesmoke;
			border-radius: 7px;
		}
		#main-sec {
			box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
		}
		.card {
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 15px;
		}
		.btn-vote {
			background-color: #28a745;
			color: white;
		}
		.btn-vote[disabled] {
			background-color: #6c757d;
		}
		.carousel-caption h1, .carousel-caption h2, .carousel-caption h3 {
			background: rgba(0, 0, 0, 0.6);
			padding: 10px;
			border-radius: 10px;
		}
	</style>
</head>

<body>
	<div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none; right:0; width:100%; background-color: rgba(0,0,0,0.5);" id="rightMenu">
		<button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large" style="background: #ff5c5c; color: white; border: none; margin: 10px;">Close &times;</button>
		<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
			<div class="container" style="max-width: 400px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); padding: 30px;">
				<h2 class="text-center" style="color: #007bff; font-weight: bold;">Admin Login</h2>
				<p class="text-center text-muted">Enter your information to proceed</p>
				<hr class="mb-4">
				<form action="Admin Login/Adminlogin.php" method="post">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label" style="color: #333;">Username</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter your username" required>
					</div>
					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label" style="color: #333;">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter your password" required>
					</div>
					<div class="mb-3 form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label text-muted" for="exampleCheck1">Remember me</label>
					</div>
					<div class="d-grid gap-2">
						<button class="btn btn-primary" type="submit" style="background-color: #007bff; border: none; transition: background-color 0.3s;">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		// Function to close the sidebar
		function closeRightMenu() {
			document.getElementById("rightMenu").style.display = "none";
		}
	</script>
</body>

	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand"><i class="fa fa-fw fa-globe"></i> Online Voting System</a>
			<ul class="nav justify-content-center">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-fw fa-search"></i> Search</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-fw fa-envelope"></i> Contact us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../Voter login Form/login.html"><i class="fa fa-sign-out"></i> Logout</a>
				</li>
			</ul>
			<form class="nav-item">
				<a class="nav-link" type="submit" onclick="openRightMenu()"><i class="fa fa-fw fa-user"></i> Admin Login</a>
			</form>
		</div>
	</nav>

	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="Image/background.jfif" class="d-block w-100" height="350px" alt="...">
				<div class="carousel-caption d-md-block">
					<h1 class="logo"><span>Vote From</span> Home</h1>
					<h2 class="logo">अपना वोट, <span>अपना कर्तव्य</span></h2>
					<h3>
						Vote from Home—where I can cast my vote from the comfort of my sofa, still in my pajamas, wondering if I’ll ever find my remote.
					</h3>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="card mb-3">
					<div class="card-header bg-warning text-dark text-center">
						<marquee>You can only vote for one candidate</marquee>
					</div>
					<div class="row g-0">
						<div class="col-md-4">
							<img src="../VoterImg/<?php echo $voterdata['photo'] ?>" class="img-fluid rounded-circle" alt="Voter Image">
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title text-primary">Voter Detail</h5>
								<p class="card-text">
									<li>Name: <?php echo $voterdata['name'] ?></li>
									<li>Mobile No: <?php echo $voterdata['mobile'] ?></li>
									<li>Aadhar No: <?php echo $voterdata['cnic'] ?></li>
								</p>
								<h5 class="card-title">Status: <?php echo $status ?></h5>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-8">
				<table class="table" id="main-sec">
					<thead class="table-dark">
						<tr>
							<th scope="col">Candidate Detail</th>
							<th scope="col">Symbol</th>
							<th scope="col">Photo</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td>
									<li>Candidate Name: <?php echo $row['cname'] ?></li>
									<li>Party Name: <?php echo $row['cparty'] ?></li>
									<li>Total Votes: <?php echo $row['votes'] ?></li><br>
									<form action="Admin Login/vote.php" method="post">
										<input type="hidden" name="gvotes" value="<?php echo $row['votes'] ?>">
										<input type="hidden" name="gid" value="<?php echo $row['id'] ?>">
										<?php if ($_SESSION['voterdata']['status'] == 0) { ?>
											<button type="submit" class="btn btn-vote">Vote</button>
										<?php } else { ?>
											<button disabled type="button" class="btn btn-danger">Vote</button>
										<?php } ?>
									</form>
								</td>
								<td><img src="Admin Login/Image/<?php echo $row['symbol'] ?>" width="40%" class="rounded-circle"></td>
								<td><img src="Admin Login/Image/<?php echo $row['photo'] ?>" width="70%" class="rounded"></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		function openRightMenu() {
			document.getElementById("rightMenu").style.display = "block";
		}

		function closeRightMenu() {
			document.getElementById("rightMenu").style.display = "none";
		}
	</script>
</body>
</html>
