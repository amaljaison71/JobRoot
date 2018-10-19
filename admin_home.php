<?php
	/* Database connectivity for ADMINISTRATOR */
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{

		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

		/* Retrieve values from employer table */
		$sql="select * from employer";
		$employer=mysqli_query($con,$sql) or die('Error in the sql query1');

		/* Retrieve values from jobseeker table */
		$sql="select * from jobseeker";
		$jobseeker=mysqli_query($con,$sql) or die('Error in the sql query5');

		/* Retrieve values from jobs table */
		$sql="select * from jobs";
		$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');

		/* Retrieve applied candidates from applied_candidates table */
		$sql="select * from applied_candidates";
		$applied_candidates=mysqli_query($con,$sql) or die('Error in the sql query3');

		/* Retrieve selected candidates from applied_candidates table */
		$sql="select * from applied_candidates where flag='1'";
		$selected_candidates=mysqli_query($con,$sql) or die('Error in the sql query4');

		/* Close db connection */
		mysqli_close($con);
	}

?>

<!-- Header -->
<?php
	include('admin_header.php');
?>
<div id="main">
	<form method="get" action="#" enctype="multipart/form-data">
		<!-- Main -->
		<div id="main">

	<!-- Introduction -->
			<section id="intro" class="main">
				<div class="spotlight">
						<div class="card">
							<div class="container">
								<h4><b>Jobseekers</b></h4>
								<p><span id="para">
									<?php
									 if (mysqli_num_rows($jobseeker)==0) { echo "0"; }
									 else
									 {
										 echo mysqli_num_rows($jobseeker);
									 }
									?>
								</span></p>
							</div>
						</div>

						<div class="card" style="margin-left: 14px">
							<div class="container">
								<h4><b>Employers</b></h4>
								<p><span id="para">
									<?php
									 if (mysqli_num_rows($employer)==0) { echo "0"; }
									 else
									 {
										 echo mysqli_num_rows($employer);
									 }
									?>
								</span></p>
							</div>
						</div>

						<div class="card" style="margin-left: 14px">
							<div class="container">
								<h4><b>Jobs</b></h4>
								<p><span id="para">
									<?php
									 if (mysqli_num_rows($jobs)==0) { echo "0"; }
									 else
									 {
										 echo mysqli_num_rows($jobs);
									 }
									?>
								</span></p>
							</div>
						</div>

						<div class="card" style="margin-left: 14px">
							<div class="container">
								<h4><b>Applied Candidates</b></h4>
								<p><span id="para">
									<?php
									 if (mysqli_num_rows($applied_candidates)==0) { echo "0"; }
									 else
									 {
										 echo mysqli_num_rows($applied_candidates);
									 }
									?>
								</span></p>
							</div>
						</div>

						<div class="card" style="margin-left: 14px">
							<div class="container">
								<h4><b>Selected Candidates</b></h4>
								<p><span id="para">
									<?php
									 if (mysqli_num_rows($selected_candidates)==0) { echo "0"; }
									 else
									 {
										 echo mysqli_num_rows($selected_candidates);
									 }
									?>
								</span></p>
							</div>
						</div>
					</div>
				</section>

			<!-- Second Section -->
				<section id="second" class="main special">
					<header class="major">
						<h2>Categories</h2>
						<p>The following are the category of jobs available</p>
					</header>
					<ul class="statistics">
						<li class="style1">
							<span class="icon fa-code-fork"></span>
							<strong></strong> Web developer
						</li>
						<li class="style2">
							<span class="icon fa-folder-open-o"></span>
							<strong></strong> Systems analyst
						</li>
						<li class="style3">
							<span class="icon fa-signal"></span>
							<strong></strong> Technical support
						</li>
						<li class="style4">
							<span class="icon fa-laptop"></span>
							<strong></strong> Software tester
						</li>
						<li class="style5">
							<span class="icon fa-diamond"></span>
							<strong></strong> Network engineer
						</li>
						<li class="style5">
							<span class="icon fa-diamond"></span>
							<strong></strong> Backend developer
						</li>
					</ul>
				</section>
			</div>
		</form>
	</div>	

<!-- Footer -->
<?php
	include('employer_footer.php');
?>
