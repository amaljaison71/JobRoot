<?PHP

  /* Database connectivity for employer registration */

  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  /* Fetching values from the question table */

  $sql="select qstn_id from questions";
	$quest=mysqli_query($con,$sql) or die('Error in the sql query1');

?>

<!-- Header -->
<?php
	include('admin_header.php');
?>

<!-- Main -->
<div id="main">

	<!-- Content -->
	<section id="content" class="main">

		<!-- Form -->
		<section>
			<h2>Edit Question</h2>
			<form method="post">
				<div class="row gtr-uniform">
          <div class="col-12">
            <select name="qstn_id" onchange="this.form.submit()">
              <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select Question ID-</i></font></option>
              <?php
                while($row = mysqli_fetch_array($quest))
                {
                  echo '<option value="' . $row['qstn_id'] . '">' . $row['qstn_id'] . ' </option>';
                }
              ?>
            </select>
          </div>

          <?php

            /* Load values into form upon change in select */

            if(isset($_POST["qstn_id"]))
            {
              /* Load values into form upon change in select */
              $qstn_id=$_POST['qstn_id'];
              $sql="select * from questions where qstn_id='".$qstn_id."'";
              $qstn=mysqli_query($con,$sql) or die('Error in the sql query2');
              $qstn_row=mysqli_fetch_row($qstn);

              echo '<div class="row gtr-uniform">';
                echo '<input type="hidden" style="all: initial;" name="qid" id="qid" value="' . $qstn_id . '">';
                echo '<div class="col-12">';
                  echo '<select name="category" value="" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;"  required>';
                    echo '<option selected="selected" disabled="disabled">-Category-</option>';
                    echo '<option value="html">HTML</option>';
                    echo '<option value="sql">SQL</option>';
                    echo '<option value="php">PHP</option>';
                    echo '<option value="js">JS</option>';
                    echo '<option value="c">C</option>';
                    echo '<option value="css">CSS</option>';
                    echo '<option value="language">Language</option>';
                    echo '<option value="reasoning">Reasoning</option>';
                    echo '<option value="aptitude">Aptitude</option>';
                  echo '</select>';
                echo '</div>';
                echo '<div class="col-12">';
                  echo '<textarea name="question" id="question" placeholder="Question" rows="8" maxlength="2000" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required>' . $qstn_row[2] . '</textarea>';
                echo '</div>';
                echo '<div class="col-6">';
                  echo '<input type="text" name="option1" id="option1" value="' . $qstn_row[3] . '" placeholder="Option1" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>';
                echo '</div>';
                echo '<div class="col-6">';
                  echo '<input type="text" name="option2" id="option2" value="' . $qstn_row[4] . '" placeholder="Option2" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>';
                echo '</div>';
                echo '<div class="col-6">';
                  echo '<input type="text" name="option3" id="option3" value="' . $qstn_row[5] . '" placeholder="Option3" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>';
                echo '</div>';
                echo '<div class="col-6">';
                  echo '<input type="text" name="option4" id="option4" value="' . $qstn_row[6] . '" placeholder="Option4" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>';
                echo '</div>';
                echo '<div class="col-12">';
                  echo '<input type="text" name="answer" id="answer" value="' . $qstn_row[7] . '" placeholder="Answer" maxlength="50" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required/>';
                echo '</div>';
                echo '<div class="col-12">';
                  echo '<ul class="actions">';
                  echo '<li><input type="submit" name="submit1" value="Submit" class="primary" /></li>';
                  echo '<li><input type="submit" name="delete" value="Delete" class="primary" /></li>';
                echo '</ul>';
              echo '</div>';
            }

            /* Update Table */

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit1']))
            {
              /* Fetching values from the form */
              $category=$_POST['category'];
              $question=$_POST['question'];
              $option1=$_POST['option1'];
          		$option2=$_POST['option2'];
          		$option3=$_POST['option3'];
          		$option4=$_POST['option4'];
          		$answer=$_POST['answer'];
              $id=$_POST['qid'];
              /* Update values in table */
              $sql="update questions set category='$category', question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' where qstn_id='".$id."'";
              $res_update=mysqli_query($con,$sql) or die('Error in the sql query3');

              if($res_update>0)
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']))
            {
              $id=$_POST['qid'];

              /* Update values in table */
              $sql="delete from questions where qstn_id='".$id."'";
              $res_update=mysqli_query($con,$sql) or die('Error in the sql query3');

              if($res_update>0)
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
          ?>
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
