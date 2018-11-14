<?php
  session_start();
	/* Database connectivity for jobseeker */

	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

	/* Retrieve values from jobseeker table */
	$sql="select * from jobseeker where jsid='".$_SESSION['jsid']."'";
	$jobseeker=mysqli_query($con,$sql) or die('Error in the sql query1');
  $js_row=mysqli_fetch_row($jobseeker);

  /* Retrieve values from jobseeker_education_details table */
	$sql="select * from jobseeker_education_details where jsid='".$_SESSION['jsid']."'";
	$js_edu=mysqli_query($con,$sql) or die('Error in the sql query2');

  /* Retrieve values from jobseeker_project_details table */
	$sql="select * from jobseeker_project_details where jsid='".$_SESSION['jsid']."'";
	$js_pro=mysqli_query($con,$sql) or die('Error in the sql query3');

  /* Retrieve values from jobseeker_experience_details table */
	$sql="select * from jobseeker_experience_details where jsid='".$_SESSION['jsid']."'";
	$js_exp=mysqli_query($con,$sql) or die('Error in the sql query4');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['select']))
		{
      /* Update flag in applied_candidates table */
			$sql="update applied_candidates set flag=1 where acid='".$_SESSION['acid']."'";
			$res=mysqli_query($con,$sql) or die('Error in sql query4');
			if($res>0)
			{
				echo '<script language="javascript">';
				echo 'alert("Successfully Updated.")';
				echo '</script>';
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Error!")';
				echo '</script>';
			}
		}
	}
?>

<?php
	include('employer_header.php');
?>

<!-- Main -->
<div id="main">

  <form method="post" action="#" enctype="multipart/form-data">
    <!-- Introduction -->
    <div id="main">
      <section id="intro" class="main">
        <div class="spotlight" style="width: 100%;">
          <div class="card" style="margin-left: 5px; margin-right: 5px; width: 100%;">
              <div class="container">
                <p>
                  <span class="image left"><img src="images/pro-img.png" alt="" style="width: 100%; height: auto;;"/></span>
                  <h2><b><?php echo $js_row[1] . ' ' . $js_row[2]; ?></b></h2>
                  <span class="icon fa-envelope">  <?php echo $js_row[3]; ?></span></br>
                  <span class="icon fa-phone">  <?php echo $js_row[9]; ?></span></br>
                  <span class="icon fa-address-card">  <?php echo $js_row[7]; ?></span>
                </p>
              </div>
          </div>
        </div>
      </section>

      <section id="education" class="main">
        <h4>EDUCATINAL QUALIFICATIONS</h4>
        <div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>QUALIFICATION</th>
								<th>UNIVERSITY</th>
								<th>INSTITUTE</th>
								<th>CGPA</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($js_edu)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($js_edu))
									{
										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row[2] . '</td>';
											echo '<td>' . $row[3] . '</td>';
											echo '<td>' . $row[4] . '</td>';
                      echo '<td>' . $row[5] . '</td>';
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
				</div>
      </section>

      <section id="projects" class="main">
        <h4>PROJECT DETAILS</h4>
        <div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>PROJECT</th>
								<th>TECHS</th>
								<th>ABOUT</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($js_pro)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($js_pro))
									{
										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row[2] . '</td>';
											echo '<td>' . $row[3] . '</td>';
											echo '<td>' . $row[4] . '</td>';
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
				</div>
      </section>

      <section id="education" class="main">
        <h4>EXPREIENCE DETAILS</h4>
        <div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>EMPLOYER</th>
								<th>POST</th>
								<th>JOINING DATE</th>
								<th>RESIGNIN DATE</th>
                <th>TECHS</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($js_exp)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($js_exp))
									{
										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row[2] . '</td>';
											echo '<td>' . $row[3] . '</td>';
											echo '<td>' . $row[4] . '</td>';
                      echo '<td>' . $row[5] . '</td>';
                      echo '<td>' . $row[6] . '</td>';
										echo '</tr>';
									}
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="col-12">
					<input type="submit" class="primary" name="select" value="Select for Interview"/>
				</div>
      </section>
    </div>
  </from>
</div>

<?php
	include('employer_footer.php');
?>

<?php
  /* Close db connection */
  mysqli_close($con);
?>
