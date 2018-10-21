<?php
  session_start();
	/* Database connectivity for jobseeker */

	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');


  /* Retrieve values from applied_candidates table */
	$sql="select * from applied_candidates where jsid='".$_SESSION['id']."' AND flag='1'";
	$applied_jobs=mysqli_query($con,$sql) or die('Error in the sql query1');


	 /* Close db connection */
	 mysqli_close($con);
?>

<!-- Header -->
<?php
  include('jobseeker_header.php');
?>

<!-- Main -->
<div id="main">

  <form method="get" action="#" enctype="multipart/form-data">
    <!-- Introduction -->
    <div id="main">

      <section id="applied_jobs" class="main">
        <h4>SELECTED FOR INTERVIEW</h4>
        <div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>JOB TITLE</th>
								<th>POST</th>
                <th>EMPLOYER</th>
								<th>LOCATION</th>
								<th>SCORE</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($applied_jobs)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($applied_jobs))
									{
                    /* Retrieve values from jobs table */
                  	$sql="select empid,title,location,post from jobs where job_id='".$row[2]."'";
                  	$job=mysqli_query($con,$sql) or die('Error in the sql query2');
                    $row2=mysqli_fetch_row($job);

                    /* Retrieve values from employer table */
                  	$sql="select cname from employer where empid='".$row2[0]."'";
                  	$job=mysqli_query($con,$sql) or die('Error in the sql query3');
                    $row3=mysqli_fetch_row($job);

										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row2[1] . '</td>';
											echo '<td>' . $row2[3] . '</td>';
											echo '<td>' . $row3[0] . '</td>';
                      echo '<td>' . $row2[2] . '</td>';
                      echo '<td>' . $row[3] . '</td>';
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
				</div>
      </section>

    </div>
  </from>
</div>


<!-- Footer -->
<?php
  include('employer_footer.php');
?>
