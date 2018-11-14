<?php
	/* Database connectivity for ADMINISTRATOR */

	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

	/* Retrieve values from employer table */
	$sql="select empid,cname,cin from employer";
	$employer=mysqli_query($con,$sql) or die('Error in the sql query1');

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST["delete"]))
   {
       $id=$_POST['delete'];

			 /* Update values in table */
			 $sql="select email from employer where empid='".$id."'";
			 $res=mysqli_query($con,$sql) or die('Error in the sql query7');
			 $mail=mysqli_fetch_row($res);

			 $sql="delete from login where email='".$mail[0]."'";
			 $res_update3=mysqli_query($con,$sql) or die('Error in the sql query6');

			 $sql="delete from employer where empid='".$id."'";
			 $res_update1=mysqli_query($con,$sql) or die('Error in the sql query3');

			 $sql="delete from applied_candidates where job_id in (select job_id from jobs where empid='".$id."')";
			 $res_update2=mysqli_query($con,$sql) or die('Error in the sql query4');

			 $sql="delete from jobs where empid='".$id."'";
			 $res_update3=mysqli_query($con,$sql) or die('Error in the sql query5');

			 if($res_update1>0 && $res_update2>0 && $res_update3>0)
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
								<th>NAME</th>
								<th>CIN</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(mysqli_num_rows($employer)==0)
								{
									echo "Noting to Show..!";
								}
								else
								{
									while($row = mysqli_fetch_array($employer))
									{
										echo '<tr>';
											echo '<td>' . $row[0] . '</td>';
											echo '<td>' . $row[1] . '</td>';
											echo '<td>' . $row[2] . '</td>';
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
