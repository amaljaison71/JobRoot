<?php
	/* Database connectivity for ADMINISTRATOR */

	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

	/* Retrieve values from employer table */
	$sql="select jsid,fname,lname,address from jobseeker";
	$jobseeker=mysqli_query($con,$sql) or die('Error in the sql query1');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST["delete"]))
   {
       $id=$_POST['delete'];

			 /* Update values in table */
			 $sql="select email from jobseeker where jsid='".$id."'";
			 $res=mysqli_query($con,$sql) or die('Error in the sql query7');
			 $mail=mysqli_fetch_row($res);

			 $sql="delete from login where email='".$mail[0]."'";
			 $res_update3=mysqli_query($con,$sql) or die('Error in the sql query6');

			 $sql="delete from applied_candidates where jsid='".$id."'";
			 $res_update2=mysqli_query($con,$sql) or die('Error in the sql query4');

			 $sql="delete from jobseeker where jsid='".$id."'";
			 $res_update=mysqli_query($con,$sql) or die('Error in the sql query3');

			 $sql="delete from jobseeker_education_details where jsid='".$id."'";
			 $res_update4=mysqli_query($con,$sql) or die('Error in the sql query5');

			 $sql="delete from jobseeker_experience_details where jsid='".$id."'";
			 $res_update5=mysqli_query($con,$sql) or die('Error in the sql query6');

			 $sql="delete from jobseeker_project_details where jsid='".$id."'";
			 $res_update6=mysqli_query($con,$sql) or die('Error in the sql query8');

			 if($res_update>0)
	 		{
	 			echo '<script language="javascript">';
	 			echo 'alert("Successfully Deleted.")';
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

<!-- Header -->
<?php
	include('admin_header.php');
?>

<div id="main">
	<form method="post" action="#" enctype="multipart/form-data">
		<!-- Main -->
		<div id="main">
			<section id="intro" class="main">
				<div class="table-wrapper">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
								<th>ADDRESS</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($jobseeker)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($jobseeker))
									{
										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row[1] . '</td>';
											echo '<td>' . $row[2] . '</td>';
											echo '<td>' . $row[3] . '</td>';
											echo '<td> <button type="submit" class="primary" name="delete" value="' . $row[0] . '">Delete</button> </td>';
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

<?php
  /* Close db connection */
  mysqli_close($con);
?>
