<?PHP

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    /* Database connectivity for employer registration */

    $con=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

    /* Fetching values from the registration form */
    if(isset($_POST['personal']))
		{
			$fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $email=$_POST['email'];
      $password=$_POST['password'];
      $state=$_POST['state'];
      $district=$_POST['district'];
      $postoffice=$_POST['postoffice'];
      $address=$_POST['address'];
      $pincode=$_POST['pincode'];
      $phone=$_POST['phone'];

      /* Inserting values into jobseeker table */
      $sql="insert into jobseeker(fname,lname,email,state,district,postoffice,address,pincode,phone) values('$fname','$lname','$email','$state','$district','$postoffice','$address','$pincode','$phone')" ;
      $res1=mysqli_query($con,$sql) or die('Error in the sql query1');

      /* Inserting values into login table */
      $sql="insert into login(email,password,role) values('$email','$password',3)" ;
      $res2=mysqli_query($con,$sql) or die('Error in the sql query2');

      /* Show message on Successfull insertion */
      if($res1>0 && $res2>0)
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Successfully Inserted.")';
  			echo '</script>';
        header('location:login.php');
  		}
  		else
  		{
  			echo '<script language="javascript">';
  			echo 'alert("Error!")';
  			echo '</script>';
        header('location:jobseeker_registration.php');
  		}

		}
  }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>JobSeeker</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>JOBSEEKER REGISTER </h1>
						<p>Get started with us here !!</p>
					</header>

					<nav id="nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="jobs_list.php">Search Jobs</a></li>
							<li><a href="Login.php">Login</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
            <form method="post">
              <div id="main">
  						  <!-- Content -->
  							<section id="personaldetails" class="main">
  										<h2>PERSONAL DETAILS </h2>
  											<div class="row gtr-uniform">
  												<div class="col-10">
  													<div class="row gtr-uniform">
  														<div class="col-6">
  															<input type="text" name="fname" id="fname" value="" placeholder="First Name" maxlength="20" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
  														</div>
  														<div class="col-6">
  															<input type="text" name="lname" id="lname" value="" placeholder="Last Name" maxlength="20" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
  														</div>
  												</div>

  												<br>
  													<div class="col-6 col-12-xsmall">
  														<input type="email" name="email" id="email" value="" placeholder="Email" maxlength="25" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
  													</div>
  													<br>
  													<div class="row gtr-uniform">
  														<div class="col-6">
  															<input type="password" name="password" id="password" value="" placeholder="Password" maxlength="15" onkeypress="return validatePassword(event);" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
  														</div>
  														<div class="col-6">
  															<input type="password" name="confirm_password" id="confirm_password" value="" placeholder="Confirm Password" maxlength="15" onkeyup="equal();" onkeypress="return validatePassword(event);" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
  														</div>
  													</div>
                            <br>
    												<div class="col-6 col-12-xsmall">
    													<span id="msg"></span>
    												</div>

  												</div>

  												<div class="col-2">
  													<div class="gtr-uniform">
  														<div class="col-12-xsmall">
  															<img src="images/pro-img.png" alt="images/pro-img.png" style="width:100%; height:auto;" disabled>
  														</div>
  														<div class="col-12">
  															<input type="submit" value="Upload Image" class="small" style="font-size:80%; height: auto; width: 100%" disabled/>
  														</div>
  													</div>
  												</div>

  												<div class="col-12">
  													<div class="row gtr-uniform">

  														<div class="col-12">
  															<select name="state" id="state" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required>
  																<option value="">- States -</option>
  																<option value="1">Andra Pradesh</option>
  																<option value="2">Arunachal Pradesh</option>
  																<option value="3">Assam</option>
  																<option value="4">Bihar</option>
  																<option value="5">Chhattisgarh</option>
  																<option value="6">Goa</option>
  																<option value="7">Gujarat</option>
  																<option value="8">Haryana</option>
  																<option value="9">Himachal Pradesh</option>
  																<option value="10">Jammu and Kashmir</option>
  																<option value="11">Jharkhand</option>
  																<option value="12">Karnataka</option>
  																<option value="Kerala">Kerala</option>
  																<option value="14">Madya Pradesh</option>
  																<option value="15">Maharashtra</option>
  																<option value="16">Manipur</option>
  																<option value="17">Meghalaya</option>
  																<option value="18">Mizoram</option>
  																<option value="19">Nagaland</option>
  																<option value="20">Orissa</option>
  																<option value="21">Punjab</option>
  																<option value="22">Rajasthan</option>
  																<option value="23">Sikkim</option>
  																<option value="24">Tamil Nadu</option>
  																<option value="25">Telagana</option>
  																<option value="26">Tripura</option>
  																<option value="27">Uttaranchal</option>
  																<option value="28">Uttar Pradesh</option>
  																<option value="29">West Bengal</option>
  															</select>
  														</div>

  														<div class="col-6">
  															<input type="text" name="district" id="district" value="" placeholder="District" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
  														</div>
  														<div class="col-6">
  															<input type="text" name="postoffice" id="postoffice" value="" placeholder="Postoffice" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
  														</div>
  													</div>
  												</div>

  												<div class="col-12">
  													<input type="text" name="address" id="address" value="" placeholder="Address" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlphaNumeric(event);" required/>
  												</div>

  												<div class="col-12">
  													<div class="row gtr-uniform">
  														<div class="col-6">
  															<input type="text" name="pincode" id="pincode" value="" placeholder="Pincode" minlength="6" maxlength="6" value="<?php echo $js_row[8]; ?>" placeholder="Pincode" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isNum(event);" required/>
  														</div>
  														<div class="col-6">
  															<input type="text" name="phone" id="phone" value="" placeholder="Phone" minlength="10" maxlength="11" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isNum(event);" required/>
  														</div>
  													</div>
  												</div>
  											</div>
  									</section>

  									<section id="finalsubmition" class="main">

  										<h2>FINAL SUBMITION</h2>
  											<div class="row gtr-uniform">
  												<div class="col-12">
  													<input type="checkbox" id="final" name="final" onclick="activate(this.id)">
  													<label for="final"> I confirm that the information given in this form is true, complete and accurate. </label>
  												</div>
  												<div class="col-12">
  													<ul class="actions">
                              <li><button type="submit" class="primary" name="personal" id="final_submit" disabled>Submit</button></li>
                              <li><button type="reset" class="primary">Cancel</button></li>
  													</ul>
  												</div>
  											</div>

  									</section>
                  </div>
                </form>
							</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>About Us</h2>
							<p>As one of the very few profitable pure play internet companies in the country, JobRoot is India’s premier online classifieds company in recruitment and related services.</p>
							<ul class="actions">
								<li><a href="#" class="button">Learn More</a></li>
							</ul>
						</section>
						<section>
							<h2>Contact Us</h2>
							<dl class="alt">
								<dt>Address</dt>
								<dd>SCMS School of Engineering and Technology &bull; Pallissery, KL 00000 &bull; India</dd>
								<dt>Phone</dt>
								<dd>(+91) 9562564852</dd>
								<dt>Email</dt>
								<dd><a href="#">information@jobroot.in</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>
						</section>
						<p class="copyright">&copy;Design: <a href="#">AJ</a>.</p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<!-- Activate Sections -->
			<script>
				function activate(id)
				{
					if(id==="final")
					{
						if(document.getElementById('final').checked)
						{
							document.getElementById('final_submit').disabled = false;
						}
						else
						{
							document.getElementById('final_submit').disabled = true;
						}
					}
				}
			</script>

	</body>
</html>

<?php
  /* Close db connection */
  mysqli_close($con);
?>

<script type="text/javascript">
  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  function isAlphaNumeric(e)
	{
    var keyCode = e.keyCode;
    if((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1 || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122))
		{
			return true;
		}
		else
		{
			return false;
		}
  }
  function isNum(e)
	{
    var keyCode = e.keyCode;
    if((keyCode >= 48 && keyCode <= 57))
		{
			return true;
		}
		else
		{
			return false;
		}
  }
	function isAlpha(e)
	{
    var keyCode = e.keyCode;
    if(specialKeys.indexOf(keyCode) != -1 || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode==32)
		{
			return true;
		}
		else
		{
			return false;
		}
  }
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
		if(document.getElementById('password').value == document.getElementById('confirm_password').value)
		{
			document.getElementById('msg').style.color = 'green';
			document.getElementById('msg').innerHTML = 'Matching';
		}
		else
		{
			document.getElementById('msg').style.color = 'red';
			document.getElementById('msg').innerHTML = 'Passwords not matching';
		}
	}
</script>
