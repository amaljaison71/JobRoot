<?php
  session_start();
	/* Database connectivity for jobseeker */

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
  	$con=mysqli_connect("localhost","root","");
  	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  	/* Fetch values from form table */
    $employer=$_POST['employer'];
    $designation=$_POST['designation'];
    $jd=$_POST['jd'];
    $rd=$_POST['rd'];
    $techs=$_POST['tech'];
    $id=$_SESSION['id'];

    if (isset($_POST['save']))
    {
      /* Inserting values into jobseeker_experience_details table */
      $sql="insert into jobseeker_experience_details(jsid,employer,post,start,end,techs) values('$id','$employer','$designation','$jd','$rd','$techs')";
      $res2=mysqli_query($con,$sql) or die('Error in the sql query1');

      /* Show message on Successfull insertion */
      if($res2>0)
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
      <section id="projectdetails" class="main">
        <h2>EXPERIENCE DETAILS </h2>
        <div class="row gtr-uniform">
          <div class="col-12">
            <div class="row gtr-uniform">
              <div class="col-6">
                <input type="text" name="employer" id="employer" value="" placeholder="Employer" maxlength="100" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
              </div>
              <div class="col-6">
                <input type="text" name="designation" id="designation" value="" placeholder="Designation" maxlength="100" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="row gtr-uniform">
              <div class="col-45">
                <input type="date" name="jd" id="jd" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
              </div>
              <div class="col-0010">
                <h5 style="text-align: center; margin-top:15px;">to</h5>
              </div>

              <div class="col-45">
                <input type="date" name="rd" id="rd" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
              </div>
            </div>
          </div>

          <div class="col-12">
            <input type="text" name="tech" id="tech" value="" placeholder="Technologies Worked" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
          </div>



          <div class="col-12">
            <ul class="actions">
              <li><button type="submit" class="primary" name="save">Save</button></li>
              <li><button type="button" class="primary" name="clear" id="more1">Cancel</button></li>
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

    document.getElementById('jd').max = dt;
    document.getElementById('jd').value = dt;
    document.getElementById('rd').max = dt;
    document.getElementById('rd').value = dt;
  }
</script>
