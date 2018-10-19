<?php
	session_start();
	/* Database connectivity for employer registration */
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
		$email=$_POST["email"];
		$password=$_POST["pswd"];

		/* Retrieve values from login table */
		$sql="select * from login where email='".$email."'";
		$res=mysqli_query($con,$sql) or die('Error in the sql query1');

		/* Validate username and password */
		$row=mysqli_fetch_row($res);
		if(($row[1]==$email) && ($row[2]==$password))
		{
			$_SESSION['email']=$email;
			$_SESSION['role']=$row[3];
			/* Show employer's home page */
			if($row[3]==2)
			{
				header('location:employer_home.php');
			}
			elseif ($row[3]==3)
			{
				header('location:jobseeker_home.php');
			}
			else
			{
				header('location:admin_home.php');
			}
		}
		else
		{
			echo "Invalid Login Credentials..!";
		}

		/* Close db connection */
		mysqli_close($con);
	}

?>

<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>




	</head>
	<body class="is-preload" style="background-image: url(images/background.jpg);background-size: 100% 100%;">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<a href="index.html"><h1><img src="images/logos.png" width="20%" height="20%" style="margin-left: 26px"></h1></a>
						<p>Sign in</p>
					</header>

				<!-- Main -->


						<!-- Content -->
							<section id="content" class="main" >

								<!-- Text -->


								<!-- Lists -->

<!-- Form -->
									<section>

										<form method="post" action="#" >
											<div class="row gtr-uniform">
												<div class="col-6" style="margin-left: 310px;">
													<input type="email" name="email" id="email" value="" placeholder="Email" />
												</div>

												<div class="col-6" style="margin-left: 310px;">
													<input type="password" name="pswd" id="pswd" value="" placeholder="Password" />
												</div>

												<div class="col-12" style="margin-left: 480px;>
													<ul class="actions">
														<li><input type="submit" value="Login" class="primary" /></li>

													</ul>
												</div>




											</div>



										</form>


								<!-- Buttons -->
									</div>

				<!-- Footer -->
					<footer id="footer">

						<section style="margin-left: 430px;">
							<h2 style="margin-left: 85px">Follow us on</h2>

							<ul class="icons">
								<li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>
						</section>

					</footer>

			</div>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
