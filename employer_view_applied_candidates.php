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

		/* Retrieve applied candidates from applied_candidates table */
		$sql="select * from applied_candidates where job_id in (select job_id from jobs where empid='".$empid."') order by score DESC";
		$applied_candidates=mysqli_query($con,$sql) or die('Error in the sql query3');

		/* Close db connection */
		mysqli_close($con);
		//header('location:employer_view_applied_candidates.php');
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
				<section id="applied_candidates_list" name="applied_candidates_list" class="main">
					<h2>Applied Candidates</h2>
					<?php
					if (mysqli_num_rows($applied_candidates)==0) { echo "Noting to Show..!"; }
					else
					{
						while($row = mysqli_fetch_array($applied_candidates))
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
