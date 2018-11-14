<?php
  session_start();

  /* Database connectivity for jobseeker */
  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  /* Retrieve values from jobseeker_education_details table */
  $sql="select prj_id,topic from jobseeker_project_details where jsid='".$_SESSION['id']."'";
  $prj_id=mysqli_query($con,$sql) or die('Error in the sql query1');

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    /* Fetch values from form table */
    $pname=$_POST['pname'];
    $technologies=$_POST['technologies'];
    $pdescription=$_POST['pdesciption'];
    $id=$_SESSION['id'];

    if (isset($_POST['save']))
    {
      /* Inserting values into jobseeker_project_details table */
      $sql="update jobseeker_project_details set topic='$pname',techs='$technologies',about='$pdescription' where prj_id='".$_POST['save']."'";
      $res2=mysqli_query($con,$sql) or die('Error in the sql query3');

      /* Show message on Successfull insertion */
      if($res2>0)
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
      <section id="qualificationdetails" class="main">
        <h2>PROJECT DETAILS </h2>
        <div class="row gtr-uniform">
          <div class="col-12">
            <select name="prjid" onchange="this.form.submit()">
              <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select a Project-</i></font></option>
              <?php
                while($row = mysqli_fetch_array($prj_id))
                {
                  echo '<option value="' . $row['prj_id'] . '">' . $row['topic'] . '</option>';
                }
              ?>
            </select>
          </div>
          <?php
            /* Load values into form upon change in select */

            if(isset($_POST["prjid"]))
            {
              /* Load values into form upon change in select */
              $prjid=$_POST['prjid'];
              $sql="select * from jobseeker_project_details where prj_id='".$prjid."'";
              $prj=mysqli_query($con,$sql) or die('Error in the sql query2');
              $prj_row=mysqli_fetch_row($prj);
            }
          ?>
          <div class="col-12">
            <div class="row gtr-uniform">
              <div class="col-6">
                <input type="text" name="pname" id="pname" value="<?php if(isset($_POST["prjid"])) echo $prj_row[2]; ?>" placeholder="Topic of the Project" maxlength="200" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
              </div>
              <div class="col-6">
                <input type="text" name="technologies" id="technologies" value="<?php if(isset($_POST["prjid"])) echo $prj_row[3]; ?>" placeholder="Technologies Used" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>
              </div>
            </div>
          </div>

          <div class="col-12">
            <textarea name="pdesciption" id="pdescription" placeholder="Description" rows="6" maxlength="1500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required><?php if(isset($_POST["prjid"])) echo $prj_row[4]; ?></textarea>
          </div>

          <div class="col-12">
            <ul class="actions">
              <li><button type="submit" class="primary" name="save" value="<?php if(isset($_POST["prjid"])) echo $prj_row[0]; ?>">Save</button></li>
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
