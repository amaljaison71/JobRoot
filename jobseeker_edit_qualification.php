<?php
  session_start();

  /* Database connectivity for jobseeker */
  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  /* Retrieve values from jobseeker_education_details table */
  $sql="select qual_id,qualification from jobseeker_education_details where jsid='".$_SESSION['id']."'";
  $qual_id=mysqli_query($con,$sql) or die('Error in the sql query1');

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
  	/* Fetch values from form table */
    $qual=$_POST['qualification1'];
    $university=$_POST['university'];
    $institute=$_POST['institute'];
    $cgpa=$_POST['cgpa'];
    $id=$_SESSION['id'];

    if (isset($_POST['save']))
    {
      /* Inserting values into jobseeker_education_details table */
      $sql="update jobseeker_education_details set qualification='$qual',university='$university',institute='$institute',cgpa='$cgpa' where qual_id='".$_POST['save']."'";
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
        <h2>QUALIFICATION DETAILS </h2>
        <div class="row gtr-uniform">
          <div class="col-12">
            <select name="qualid" onchange="this.form.submit()">
              <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select a Qualification-</i></font></option>
              <?php
                while($row = mysqli_fetch_array($qual_id))
                {
                  echo '<option value="' . $row['qual_id'] . '">' . $row['qualification'] . '</option>';
                }
              ?>
            </select>
          </div>
          <?php
            /* Load values into form upon change in select */

            if(isset($_POST["qualid"]))
            {
              /* Load values into form upon change in select */
              $qualid=$_POST['qualid'];
              $sql="select * from jobseeker_education_details where qual_id='".$qualid."'";
              $qual=mysqli_query($con,$sql) or die('Error in the sql query2');
              $qual_row=mysqli_fetch_row($qual);
            }
          ?>
          <div class="col-12">
            <div class="row gtr-uniform">
              <div class="col-6">
                <select name="qualification1" id="qualification1" required>
                  <option value="">- Qualification -</option>
                  <option value="BCA">BCA</option>
                  <option value="BSc Computer Science">BSc Computer Science</option>
                  <option value="BTech">BTech</option>
                  <option value="MCA">MCA</option>
                  <option value="MSc Computer Science">MSc Computer Science</option>
                  <option value="MTech">MTech</option>
                </select>
              </div>
              <div class="col-6">
                <input type="text" name="university" id="university" value="<?php if(isset($_POST["qualid"])) echo $qual_row[3]; ?>" placeholder="University" maxlength="250" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="row gtr-uniform">
              <div class="col-6">
                <input type="text" name="institute" id="institute" value="<?php if(isset($_POST["qualid"])) echo $qual_row[4]; ?>" placeholder="Institute" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required/>
              </div>
              <div class="col-6">
                <input type="text" name="cgpa" id="cgpa" value="<?php if(isset($_POST["qualid"])) echo $qual_row[5]; ?>" placeholder="CGPA/SGPA" maxlength="5" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isNum(event);" onblur="eval();" required/>
              </div>
            </div>
          </div>
          <div class="col-12">
            <ul class="actions">
              <li><button type="submit" class="primary" name="save" value="<?php if(isset($_POST["qualid"])) echo $qual_row[0]; ?>">Save</button></li>
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
  function isNum(e)
	{
    var keyCode = e.keyCode;
    if((keyCode >= 48 && keyCode <= 57) || keyCode == 46)
		{
			return true;
		}
		else
		{
			return false;
		}
  }
  function eval()
  {
    if(parseFloat(document.getElementById('cgpa').value) >= 100)
    {
      document.getElementById('cgpa').value = 0;
      document.getElementById('cgpa').focus();
      alert ("Please provide cgpa < 10 or % < 100.");
    }
  }
</script>
