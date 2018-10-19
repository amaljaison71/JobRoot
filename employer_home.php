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

		/* Close db connection */
		mysqli_close($con);
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

							<!-- Job List -->
							<section id="job_list" name="job_list" class="main">
								<h2>Jobs</h2>
								<?php
								if (mysqli_num_rows($jobs)==0) { echo "Noting to Show..!"; }
								else
								{
									$n=0;
									while($row = mysqli_fetch_array($jobs))
									{
										echo '<div class="alert" style="margin-top: 24px">';
										  echo '<h3><b>' . $row['title'] . '</b></h3>';
											echo '<h3><b>' . $row['location'] . '</b></h3>';
											echo '<h3><b>' . $row['deadline'] . '</b></h3>';
											echo '<h4><i>Description</i></h4>';
											echo '<h4>' . $row['short_desc'] . '</h4>';
										  echo '<input type="button" name="as" class="primary" value="Edit job">';
										echo '</div>';
										$n = $n + 1;
										if($n == 5) break;;
									}
								}
								?>
							</section>

							<!-- Applied Candidates List -->
							<section id="applied_candidates_list" name="job_list" class="main">
								<h2>Applied Candidates</h2>
								<?php
								if (mysqli_num_rows($applied_candidates)==0) { echo "Noting to Show..!"; }
								else
								{
									$n=0;
									while($row = mysqli_fetch_array($applied_candidates) && $n < 5)
									{
										$con=mysqli_connect("localhost","root","");
										$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
										$sql="select * from jobseeker where jsid='".$row[1]."'";
										$jobseeker=mysqli_query($con,$sql) or die('Error in the sql query5');
										$js_row = mysqli_fetch_array($jobseeker);
										$sql="select * from jobs where job_id='".$row[2]."'";
										$jobs2=mysqli_query($con,$sql) or die('Error in the sql query5');
										$job_row = mysqli_fetch_array($jobs2);
										echo '<div class="alert" style="margin-top: 24px">';
										  echo '<h3><b>$js_row["name"]</b></h3>';
											echo '<h3><b>$job_row[2]</b></h3>';
											echo '<h3><b>$row[3]</b></h3>';
										  echo '<input type="button" name="as" class="primary" value="Invite">';
										echo '</div>';
										$n = $n + 1;
									}
								}
								?>
							</section>

							<!-- Selected Candidates List -->
							<section id="selected_candidates_list" name="job_list" class="main">
								<h2>Selected Candidates</h2>
								<?php
								if (mysqli_num_rows($selected_candidates)==0) { echo "Noting to Show..!"; }
								else
								{
									$n=0;
									while($row = mysqli_fetch_array($selected_candidates) && $n < 5)
									{
										$con=mysqli_connect("localhost","root","");
										$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
										$sql="select * from jobseeker where jsid='".$row[1]."'";
										$jobseeker=mysqli_query($con,$sql) or die('Error in the sql query5');
										$js_row = mysqli_fetch_array($jobseeker);
										$sql="select * from jobs where job_id='".$row[2]."'";
										$jobs2=mysqli_query($con,$sql) or die('Error in the sql query5');
										$job_row = mysqli_fetch_array($jobs2);
										echo '<div class="alert" style="margin-top: 24px">';
										  echo '<h3><b>$js_row["name"]</b></h3>';
											echo '<h3><b>$job_row[2]</b></h3>';
											echo '<h3><b>$row[3]</b></h3>';
										  echo '<input type="button" name="as" class="primary" value="Invite">';
										echo '</div>';
										$n = $n + 1;
									}
								}
								?>
							</section>
						</div>
						</form>
					</div>

<?php
	include('employer_footer.php');
?>
