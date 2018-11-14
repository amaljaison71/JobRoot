<?PHP
  session_start();

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    /* Database connectivity for employer registration */

    $con=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
    $email=$_SESSION['email'];

    /* Fetching values from the registration form */
    $title=$_POST['job_title'];
    $type=$_POST['job_type'];
    $deadline=$_POST['deadline'];
    $location=$_POST['location'];
    $post=$_POST['post'];
    $short_desc=$_POST['short_description'];
    $full_desc=$_POST['full_description'];
    $sql="select empid from employer where email='".$email."'";
		$emp=mysqli_query($con,$sql) or die('Error in the sql query1');
		$row=mysqli_fetch_row($emp);
		$empid=$row[0];
    /* Inserting values into employer table */
    $sql="insert into jobs(empid,title,type,location,deadline,post,short_desc,full_desc) values($empid,'$title','$type','$location','$deadline','$post','$short_desc','$full_desc')" ;
    $res=mysqli_query($con,$sql) or die('Error in the sql query2');

    if($res>0)
		{
			echo '<script language="javascript">';
			echo 'alert("Successfully Inserted.")';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Error!")';
			echo '</script>';
		}
  }
?>

<?php
	include('employer_header.php');
?>

				<!-- Main -->
					<div id="main">

						<!-- <form method="post" action="employer_home.php" enctype="multipart/form-data"> -->
						<!-- Introduction -->
							<section id="intro" class="main">
								<form method="post" action="#">
									<div class="row gtr-uniform">
										<div class="col-12">
											<input type="text" name="job_title" id="job_title" placeholder="Job Title" maxlength="100" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
										</div>
										<div class="col-4 col-12-small">
											<input type="radio" id="full_time" name="job_type" value="Full Time" checked>
											<label for="full_time">Full Time</label>
										</div>
										<div class="col-4 col-12-small">
											<input type="radio" id="part_time" name="job_type" value="Part Time">
											<label for="part_time">Part Time</label>
										</div>
										<div class="col-4 col-12-small">
											<input type="radio" id="freelancer" name="job_type" value="Freelancer">
											<label for="freelancer">Freelancer</label>
										</div>
										<div class="col-6">
											<select name="location" value="" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required >
												<option selected="selected">-Job Location-</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Top Metropolitan Cities-</i></font></option>
												<option value="Ahmedabad">Ahmedabad</option>
												<option value="Bangalore">Bangalore</option>
												<option value="Chandigarh">Chandigarh</option>
												<option value="Chennai">Chennai</option>
												<option value="Delhi">Delhi</option>
												<option value="Gurgaon">Gurgaon</option>
												<option value="Hyderabad">Hyderabad</option>
												<option value="">Kolkatta</option>
												<option value="">Mumbai</option>
												<option value="">Noida</option>
												<option value="">Pune</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Andhra Pradesh-</i></font></option>
												<option value="">Anantapur</option>
												<option value="">Guntakal</option>
												<option value="">Guntur</option>
												<option value="">Hyderabad/Secunderabad</option>
												<option value="">kakinada</option>
												<option value="">kurnool</option>
												<option value="">Nellore</option>
												<option value="">Nizamabad</option>
												<option value="">Rajahmundry</option>
												<option value="">Tirupati</option>
												<option value="">Vijayawada</option>
												<option value="">Visakhapatnam</option>
												<option value="">Warangal</option>
												<option value="">Andra Pradesh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Arunachal Pradesh-</i></font></option>
												<option value="">Itanagar</option>
												<option value="">Arunachal Pradesh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Assam-</i></font></option>
												<option value="">Guwahati</option>
												<option value="">Silchar</option>
												<option value="">Assam-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Bihar-</i></font></option>
												<option value="">Bhagalpur</option>
												<option value="">Patna</option>
												<option value="">Bihar-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Chhattisgarh-</i></font></option>
												<option value="">Bhillai</option>
												<option value="">Bilaspur</option>
												<option value="">Raipur</option>
												<option value="">Chhattisgarh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Goa-</i></font></option>
												<option value="">Panjim/Panaji</option>
												<option value="">Vasco Da Gama</option>
												<option value="">Goa-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Gujarat-</i></font></option>
												<option value="">Ahmedabad</option>
												<option value="">Anand</option>
												<option value="">Ankleshwar</option>
												<option value="">Bharuch</option>
												<option value="">Bhavnagar</option>
												<option value="">Bhuj</option>
												<option value="">Gandhinagar</option>
												<option value="">Gir</option>
												<option value="">Jamnagar</option>
												<option value="">Kandla</option>
												<option value="">Porbandar</option>
												<option value="">Rajkot</option>
												<option value="">Surat</option>
												<option value="">Vadodara/Baroda</option>
												<option value="">Valsad</option>
												<option value="">Vapi</option>
												<option value="">Gujarat-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Haryana-</i></font></option>
												<option value="">Ambala</option>
												<option value="">Chandigarh</option>
												<option value="">Faridabad</option>
												<option value="">Gurgaon</option>
												<option value="">Hisar</option>
												<option value="">Karnal</option>
												<option value="">Kurukshetra</option>
												<option value="">Panipat</option>
												<option value="">Rohtak</option>
												<option value="">Haryana-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Himachal Pradesh-</i></font></option>
												<option value="">Dalhousie</option>
												<option value="">Dharmasala</option>
												<option value="">Kulu/Manali</option>
												<option value="">Shimla</option>
												<option value="">Himachal Pradesh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Jammu and Kashmir-</i></font></option>
												<option value="">Jammu</option>
												<option value="">Srinagar</option>
												<option value="">Jammu and Kashmir-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Jharkhand-</i></font></option>
												<option value="">Bokaro</option>
												<option value="">Dhanbad</option>
												<option value="">Jamshedpur</option>
												<option value="">Ranchi</option>
												<option value="">Jharkhand-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Karnataka-</i></font></option>
												<option value="">Bengaluru/Bangalore</option>
												<option value="">Belgaum</option>
												<option value="">Bellary</option>
												<option value="">Bidar</option>
												<option value="">Dharwad</option>
												<option value="">Gulbarga</option>
												<option value="">Hubli</option>
												<option value="">Kolar</option>
												<option value="">Mangalore</option>
												<option value="">Mysoru/Mysore</option>
												<option value="">Karnataka-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Kerala-</i></font></option>
												<option value="">Calicut</option>
												<option value="">Cochin</option>
												<option value="">Ernakulam</option>
												<option value="">Kannur</option>
												<option value="">Kochi</option>
												<option value="">Kollam</option>
												<option value="">Kottayam</option>
												<option value="">Kozhikode</option>
												<option value="">Palakkad</option>
												<option value="">Palghat</option>
												<option value="">Thrissur</option>
												<option value="">Trivandrum</option>
												<option value="">Kerela-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Madhya Pradesh-</i></font></option>
												<option value="">Bhopal</option>
												<option value="">Gwalior</option>
												<option value="">Indore</option>
												<option value="">Jabalpur</option>
												<option value="">Ujjain</option>
												<option value="">Madhya Pradesh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Maharashtra-</i></font></option>
												<option value="">Ahmednagar</option>
												<option value="">Aurangabad</option>
												<option value="">Jalgaon</option>
												<option value="">Kolhapur</option>
												<option value="">Mumbai</option>
												<option value="">Mumbai Suburbs</option>
												<option value="">Nagpur</option>
												<option value="">Nasik</option>
												<option value="">Navi Mumbai</option>
												<option value="">Pune</option>
												<option value="">Solapur</option>
												<option value="">Maharashtra-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Manipur-</i></font></option>
												<option value="">Imphal</option>
												<option value="">Manipur-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Meghalaya-</i></font></option>
												<option value="">Shillong</option>
												<option value="">Meghalaya-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Mizoram-</i></font></option>
												<option value="">Aizawal</option>
												<option value="">Mizoram-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Nagaland-</i></font></option>
												<option value="">Dimapur</option>
												<option value="">Nagaland-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Orissa-</i></font></option>
												<option value="">Bhubaneshwar</option>
												<option value="">Cuttak</option>
												<option value="">Paradeep</option>
												<option value="">Puri</option>
												<option value="">Rourkela</option>
												<option value="">Orissa-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Punjab-</i></font></option>
												<option value="">Amritsar</option>
												<option value="">Bathinda</option>
												<option value="">Chandigarh</option>
												<option value="">Jalandhar</option>
												<option value="">Ludhiana</option>
												<option value="">Mohali</option>
												<option value="">Pathankot</option>
												<option value="">Patiala</option>
												<option value="">Punjab-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Rajasthan-</i></font></option>
												<option value="">Ajmer</option>
												<option value="">Jaipur</option>
												<option value="">Jaisalmer</option>
												<option value="">Jodhpur</option>
												<option value="">Kota</option>
												<option value="">Udaipur</option>
												<option value="">Rajasthan-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Sikkim-</i></font></option>
												<option value="">Gangtok</option>
												<option value="">Sikkim-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Tamil Nadu-</i></font></option>
												<option value="">Chennai</option>
												<option value="">Coimbatore</option>
												<option value="">Cuddalore</option>
												<option value="">Erode</option>
												<option value="">Hosur</option>
												<option value="">Madurai</option>
												<option value="">Nagerkoil</option>
												<option value="">Ooty</option>
												<option value="">Salem</option>
												<option value="">Thanjavur</option>
												<option value="">Tirunalveli</option>
												<option value="">Trichy</option>
												<option value="">Tuticorin</option>
												<option value="">Vellore</option>
												<option value="">Tamil Nadu-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Tripura-</i></font></option>
												<option value="">Agartala</option>
												<option value="">Tripura-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Union Territories-</i></font></option>
												<option value="">Chandigarh</option>
												<option value="">Dadra & Nagar Haveli-Silvassa</option>
												<option value="">Daman & Diu</option>
												<option value="">Delhi</option>
												<option value="">Pondichery</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Uttar Pradesh-</i></font></option>
												<option value="">Agra</option>
												<option value="">Aligarh</option>
												<option value="">Allahabad</option>
												<option value="">Bareilly</option>
												<option value="">Faizabad</option>
												<option value="">Ghaziabad</option>
												<option value="">Gorakhpur</option>
												<option value="">Kanpur</option>
												<option value="">Lucknow</option>
												<option value="">Mathura</option>
												<option value="">Meerut</option>
												<option value="">Moradabad</option>
												<option value="">Noida</option>
												<option value="">Varanasi/Banaras</option>
												<option value="">Uttar Pradesh-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-Uttaranchal-</i></font></option>
												<option value="">Dehradun</option>
												<option value="">Roorkee</option>
												<option value="">Uttaranchal-Other</option>
												<option disabled="disabled" style="background-color:#f2efef"><font color="#FFFFFF"><i>-West Bengal-</i></font></option>
												<option value="">Asansol</option>
												<option value="">Durgapur</option>
												<option value="">Haldia</option>
												<option value="">Kharagpur</option>
												<option value="">Kolkatta</option>
												<option value="">Siliguri</option>
												<option value="">West Bengal - Other</option>
											</select>
										</div>
										<div class="col-6">
											<input type="date" name="deadline" id="deadline" placeholder="Deadline" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" placeholder="Deadline" required />
										</div>
										<div class="col-12">
											<select name="post" value="" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" placeholder="Deadline" required / >
												<option selected="selected" disabled="disabled">-Post-</option>
												<option value="UI Developer">UI Developer</option>
												<option value="DB Designer">DB Designer</option>
												<option value="PHP Programmer">PHP Programmer</option>
												<option value="JS Programmer">JS Programmer</option>
												<option value="Tester">Tester</option>
											</select>
										</div>
										<div class="col-12">
											<textarea name="short_description" id="short_description" placeholder="Short Description" rows="4" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required></textarea>
										</div>
										<div class="col-12">
											<textarea name="full_description" id="full_description" placeholder="Detailed Description" rows="8" maxlength="2000" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;"></textarea>
										</div>
										<div class="col-12">
											<ul class="actions">
												<li><input type="Reset" value="Clear" class="primary" /></li>
												<li><input type="submit" value="Post Job" class="primary" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>

					</div>

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
  function isAlpha(e)
	{
    var keyCode = e.keyCode;
    if(specialKeys.indexOf(keyCode) != -1 || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || keyCode == 32)
		{
			return true;
		}
		else
		{
			return false;
		}
  }

  window.onload = validateDate();

  function validateDate()
  {
    var d = new Date(),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    dt = [year, month, day].join('-');

    document.getElementById('deadline').min = dt;
    document.getElementById('deadline').value = dt;
  }
</script>
