<!-- DB Connection -->
<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		/* Database connectivity for Changing Password */

		$con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
		$sql="select password from login where email='".$_SESSION['email']."'";
		$login=mysqli_query($con,$sql) or die('Error in the sql query1');
		$row=mysqli_fetch_row($login);

		/* Fetch values from form */
		$password=$_POST['confirm_password'];

		/* Check the validity of the Credentials */
		if($_POST['old_password'] == $row[0])
		{
			/* Update values into login table */
			$sql="update login set password='$password' where email='".$_SESSION['email']."'";
			$res=mysqli_query($con,$sql) or die('Error in the sql query2');
			echo $res;
			if($res)
			{
				echo '<script language="javascript">';
			  echo 'alert("Password Successfully Upadated.")';
			  echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Password Not Matching !")';
			echo '</script>';
		}

		/* Close db connection */
		mysqli_close($con);
		header('location:admin_change_password.php');
	}
?>

<!-- Header -->
<?php
	include('admin_header.php');
?>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">

								<!-- Text -->


								<!-- Lists -->

<!-- Form -->
									<section>
										<h2>Change Password</h2>
										<form method="post" action="#" enctype="multipart/form-data">
											<div class="row gtr-uniform">

												<div class="col-12">
													<input type="password" name="old_password" id="old_password" value="" placeholder="Old Password" />
												</div>
												<div class="col-12">
													<input type="password" name="new_password" id="new_password" value="" placeholder="New Password" />
												</div>
												<div class="col-12">
													<input type="password" name="confirm_password" id="confirm_password" value="" placeholder="Confirm Password" />
												</div>

												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" value="Submit" class="primary" /></li>

													</ul>
												</div>
											</div>
										</form>

							</section>
						</section>
					</div>

<!-- Footer -->
<?php
	include('employer_footer.php');
?>
