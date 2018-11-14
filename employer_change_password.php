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
	}
?>

<!-- Header -->
<?php
	include('employer_header.php');
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
													<input type="password" name="old_password" id="old_password" value="" placeholder="Old Password" maxlength="15" onkeypress="return validatePassword(event);" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
												</div>
												<div class="col-12">
													<input type="password" name="new_password" id="new_password" value="" placeholder="New Password"  maxlength="15" onkeypress="return validatePassword(event);" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
												</div>
												<div class="col-12">
													<input type="password" name="confirm_password" id="confirm_password" value="" placeholder="Confirm Password" onkeyup="equal();"  maxlength="15" onkeypress="return validatePassword(event);" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
												</div>
												<div class="col-12">
													<span id="msg"></span>
												</div>

												<div class="col-12">
													<ul class="actions">
														<li><input type="submit" value="Submit" class="primary" id="sub" disabled/></li>

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

<?php
  /* Close db connection */
  mysqli_close($con);
?>

<script type="text/javascript">
  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  function validatePassword(e)
	{
    var keyCode = e.keyCode;
    if((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1 || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 64)
		{
			return true;
		}
		else
		{
			return false;
		}
  }

	function equal()
	{
		if(document.getElementById('new_password').value == document.getElementById('confirm_password').value)
		{
			document.getElementById('msg').style.color = 'green';
			document.getElementById('msg').innerHTML = 'Matching';
			document.getElementById('sub').disabled = false;
		}
		else
		{
			document.getElementById('msg').style.color = 'red';
			document.getElementById('msg').innerHTML = 'Passwords not matching';
			document.getElementById('sub').disabled = true;
		}
	}
</script>
