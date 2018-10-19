<?php
	session_start();
	/* Database connectivity for employer */
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{

		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
		$email=$_SESSION['email'];

		/* Retrieve values from employer table */
		$sql="select empid from employer where email='".$email."'";
		$emp=mysqli_query($con,$sql) or die('Error in the sql query1');
		$row=mysqli_fetch_row($emp);
		$empid=$row[0];
		$_SESSION['empid'] = $empid;

		/* Retrieve values from jobs table */
		$sql="select * from jobs where empid='".$empid."'";
		$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');

		/* Close db connection */
		mysqli_close($con);
		//header('location:employer_view_jobs.php');
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
				<!-- Job List -->
				<section id="job_list" name="job_list" class="main">
					<h2>Jobs</h2>
					<?php
					if (mysqli_num_rows($jobs)==0) { echo "Noting to Show..!"; }
					else
					{
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
