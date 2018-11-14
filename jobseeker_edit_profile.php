<?PHP
  session_start();

  /* Database connectivity for jobseeker */

  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  /* Retrieve values from jobseeker table */
  $sql="select * from jobseeker where jsid='".$_SESSION['id']."'";
  $jobseeker=mysqli_query($con,$sql) or die('Error in the sql query1');
  $js_row=mysqli_fetch_row($jobseeker);

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

    /* Fetching values from the registration form */
    if(isset($_POST['personal']))
		{
			$fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $state=$_POST['state'];
      $district=$_POST['district'];
      $postoffice=$_POST['postoffice'];
      $address=$_POST['address'];
      $pincode=$_POST['pincode'];
      $phone=$_POST['phone'];

      /* Inserting values into jobseeker table */
      $sql="update jobseeker set fname='$fname',lname='$lname',state='$state',district='$district',postoffice='$postoffice',address='$address',pincode='$pincode',phone='$phone' where jsid='".$_SESSION['id']."'" ;
      $res1=mysqli_query($con,$sql) or die('Error in the sql query2');

      /* Show message on Successfull insertion */
      if($res1>0)
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

<!-- Header -->
<?php
  include('jobseeker_header.php');
?>

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
											<input type="text" name="fname" id="fname" value="<?php echo $js_row[1]; ?>" placeholder="First Name" maxlength="20" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
										</div>
										<div class="col-6">
											<input type="text" name="lname" id="lname" value="<?php echo $js_row[2]; ?>" placeholder="Last Name" maxlength="20" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
										</div>
								</div>

								<br>
									<div class="col-6 col-12-xsmall">
										<input type="email" name="email" id="email" value="<?php echo $js_row[3]; ?>" placeholder="Email" maxlength="25" disabled/>
									</div>
									<br>
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
										<div class="col-6">
											<input type="text" name="district" id="district" value="<?php echo $js_row[5]; ?>" placeholder="District" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
										</div>
										<div class="col-6">
											<input type="text" name="postoffice" id="postoffice" value="<?php echo $js_row[6]; ?>" placeholder="Postoffice" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
										</div>
									</div>
								</div>

								<div class="col-12">
									<input type="text" name="address" id="address" value="<?php echo $js_row[7]; ?>" placeholder="Address" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlphaNumeric(event);" required/>
								</div>

								<div class="col-12">
									<div class="row gtr-uniform">
										<div class="col-6">
											<input type="text" name="pincode" id="pincode" minlength="6" maxlength="6" value="<?php echo $js_row[8]; ?>" placeholder="Pincode" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isNum(event);" required/>
										</div>
										<div class="col-6">
											<input type="text" name="phone" id="phone" value="<?php echo $js_row[9]; ?>" placeholder="Phone" minlength="10" maxlength="11" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isNum(event);" required/>
										</div>
									</div>
								</div>
							</div>
					</section>

					<section id="finalsubmition" class="main">

						<h2>FINAL SUBMITION</h2>
							<div class="row gtr-uniform">
								<div class="col-12">
									<ul class="actions">
                    <li><button type="submit" class="primary" name="personal" id="final_submit">Submit</button></li>
                    <li><button type="reset" class="primary">Cancel</button></li>
									</ul>
								</div>
							</div>

					</section>
        </div>
      </form>
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
</script>
