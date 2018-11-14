<?php
	session_start();
	/* Database connectivity for employer */
	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

	/* Load values into select box */
  $sql="select job_id,title from jobs where empid=(select empid from employer where email='".$_SESSION['email']."')";
  $jobs=mysqli_query($con,$sql) or die('Error in the sql query1');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['view']))
		{
			$_SESSION['jsid']=$_POST['view'];
			header('location:employer_view_jobseeker_profile.php');
		}
	}

?>


<?php
	include('employer_header.php');
?>

<!-- Main -->
<div id="main">
  <form method="post">
    <div id="main">
      <!-- Content -->
      <section id="qualificationdetails" class="main">
        <h2>SELECTED CANDIDATES </h2>
        <div class="row gtr-uniform">
          <div class="col-12">
            <select name="jobid" onchange="this.form.submit()">
              <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select a Job-</i></font></option>
              <?php
                while($row = mysqli_fetch_array($jobs))
                {
                  echo '<option value="' . $row['job_id'] . '">' . $row['title'] . '</option>';
                }
              ?>
            </select>
          </div>
          <?php
            /* Load values into form upon change in select */

            if(isset($_POST["jobid"]))
            {
              /* Load values into form upon change in select */
              $jobid=$_POST['jobid'];
							/* Retrieve applied candidates from applied_candidates table */
							$sql="select * from applied_candidates where job_id=$jobid AND flag=1  order by score DESC";
							$applied_candidates=mysqli_query($con,$sql) or die('Error in the sql query2');
            }
          ?>

					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th>ID</th>
									<th>FIRST NAME</th>
									<th>LAST NAME</th>
									<th>EMAIL</th>
									<th>SCORE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($_POST["jobid"]))
									{
										if(mysqli_num_rows($applied_candidates)==0)
										{
											echo "Noting to Show..!";
										}
										else
										{
											while($row = mysqli_fetch_array($applied_candidates))
											{
												/* Retrieve values from jobseeker table */
												$sql="select fname,lname,email from jobseeker where jsid='".$row[1]."'";
												$js=mysqli_query($con,$sql) or die('Error in the sql query3');
												$row2=mysqli_fetch_row($js);

												echo '<tr>';
													echo '<td>' . $row[0] . '</td>';
													echo '<td>' . $row2[0] . '</td>';
													echo '<td>' . $row2[1] . '</td>';
													echo '<td>' . $row2[2] . '</td>';
													echo '<td>' . $row[3] . '</td>';
													echo '<td> <button type="submit" class="primary" name="view" value="' . $row[1] . '">View</button></td>';
												echo '</tr>';
											}
										}
									}
								?>
							</tbody>
						</table>
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
