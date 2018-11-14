<?php
	session_start();
	/* Database connectivity for employer registration */
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{

		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
		$email=$_SESSION['email'];

		/* Retrieve values from employer table */
		$sql="select * from employer where email='".$email."'";
		$emp=mysqli_query($con,$sql) or die('Error in the sql query1');
		$row=mysqli_fetch_row($emp);
		$empid=$row[0];
		$_SESSION['empid'] = $empid;

		/* Retrieve values from jobs table */
		$sql="select * from jobs where empid='".$empid."'";
		$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');

		/* Retrieve applied candidates from applied_candidates table */
		$sql="select * from applied_candidates where job_id in (select job_id from jobs where empid='".$empid."')";
		$applied_candidates=mysqli_query($con,$sql) or die('Error in the sql query3');

		/* Retrieve selected candidates from applied_candidates table */
		$sql="select * from applied_candidates where job_id in (select job_id from jobs where empid='".$empid."') AND flag='1'";
		$selected_candidates=mysqli_query($con,$sql) or die('Error in the sql query4');

	}

?>

<?php
	include('employer_header.php');
?>
				<!-- Main -->
					<div id="main">

						<form method="get" action="#" enctype="multipart/form-data">
						<!-- Introduction -->
						<div id="main">
							<section id="intro" class="main">
								<div class="spotlight">

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
						</div>
						</form>
					</div>

<?php
	include('employer_footer.php');
?>

<?php
  /* Close db connection */
  mysqli_close($con);
?>
