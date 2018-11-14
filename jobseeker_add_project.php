<?php
  session_start();
	/* Database connectivity for jobseeker */

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
  	$con=mysqli_connect("localhost","root","");
  	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  	/* Fetch values from form table */
    $pname=$_POST['pname'];
    $technologies=$_POST['technologies'];
    $pdescription=$_POST['pdesciption'];
    $id=$_SESSION['id'];

    if (isset($_POST['save']))
    {
      /* Inserting values into jobseeker_project_details table */
      $sql="insert into jobseeker_project_details(jsid,topic,techs,about) values('$id','$pname','$technologies','$pdescription')";
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
        <h2>PROJECT DETAILS </h2>
          <div class="row gtr-uniform">
            <div class="col-12">
              <div class="row gtr-uniform">
                <div class="col-6">
                  <input type="text" name="pname" id="pname" value="" placeholder="Topic of the Project" maxlength="200" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
                </div>
                <div class="col-6">
                  <input type="text" name="technologies" id="technologies" value="" placeholder="Technologies Used" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
                </div>
              </div>
            </div>

            <div class="col-12">
              <textarea name="pdesciption" id="pdescription" placeholder="Description" rows="6" maxlength="1500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required></textarea>
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
</script>
