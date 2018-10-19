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
			 $sql="delete from jobseeker where empid='".$id."'";
			 $res_update=mysqli_query($con,$sql) or die('Error in the sql query3');

			 /* Close db connection */
			 mysqli_close($con);
			 header('location:admin_jobseeker_list.php');
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
									mysqli_close($con);
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
