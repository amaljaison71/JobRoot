<?php
	session_start();

	/* Database connectivity for employer */
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{

		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

		/* Retrieve values from jobs table */
		$sql="select distinct post from jobs";
		$search_post=mysqli_query($con,$sql) or die('Error in the sql query0');

		$sql="select distinct location from jobs";
		$search_location=mysqli_query($con,$sql) or die('Error in the sql query1');

		$dt = date("Y-m-d");
		$sql="select * from jobs where deadline <='" . $dt . "'";
		$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');

		if (isset($_GET['search']))
		{
			if(isset($_GET['post']) && isset($_GET['location']))
			{
				$sql="select * from jobs where post='".$_GET['post']."' AND location='".$_GET['location']."' AND deadline <='" . $dt . "'";
				$jobs=mysqli_query($con,$sql) or die('Error in the sql query3');
			}
			else if(isset($_GET['post']) OR isset($_GET['location']))
			{
				if(isset($_GET['post']))
				{
					$sql="select * from jobs where post='".$_GET['post']."' AND deadline <='" . $dt . "'";
					$jobs=mysqli_query($con,$sql) or die('Error in the sql query3');
				}
				else
				{
					$sql="select * from jobs where location='".$_GET['location']."' AND deadline <='" . $dt . "'";
					$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');
				}
			}
		}

		if(isset($_GET['view']))
		{
			$_SESSION['job_id']=$_GET['view'];
			header('location:view_job_details.php');
		}
		if(isset($_GET['apply']))
		{
			$_SESSION['job_id']=$_GET['apply'];
			header('location:jobseeker_test.php');
		}
	}

?>


<?php
	include('jobseeker_header.php');
?>

<!-- Main -->
	<div id="main">

		<form method="get" action="#" enctype="multipart/form-data">
			<!-- Introduction -->
			<div id="main">
				<section class="main special">
					<div class="row gtr-uniform">
				    <div class="col-12">
				      <div class="row gtr-uniform">
				        <div class="col-5">
				          <select name="post">
				            <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select Post-</i></font></option>
				            <?php
				            while($row = mysqli_fetch_array($search_post))
				            {
				              echo '<option value="' . $row['post'] . '">' . $row['post'] . ' </option>';
				            }
										mysqli_data_seek($search_post,0);
				            ?>
				          </select>
				        </div>
				        <div class="col-5">
				          <select name="location">
				            <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select Location-</i></font></option>
				            <?php
				            while($row = mysqli_fetch_array($search_location))
				            {
				              echo '<option value="' . $row['location'] . '">' . $row['location'] . ' </option>';
				            }
										mysqli_data_seek($search_location,0);
				            ?>
				          </select>
				        </div>
								<div class="col-0010" style="margin-top:7px;">
									<button type="submit" class="primary" name="search">Search</button>
								</div>
				      </div>
				    </div>
				  </div>
				</section>
			</div>

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
								echo '<button type="submit" class="primary" name="view" value="' . $row['job_id'] . '">View</button> <button type="submit" class="primary" name="apply" value="' . $row['job_id'] . '">Apply</button>';
							echo '</div>';
						}
						mysqli_data_seek($jobs,0);
					}
					?>
				</section>
			</div>
		</form>
	</div>

<?php
	include('home_footer.php');
?>

<?php
  /* Close db connection */
  mysqli_close($con);
?>
