<?PHP
  session_start();

  /* Database connectivity for employer registration */

  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
  $email=$_SESSION['email'];

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
                      <?php
                          /* Load values into form */

                          $jobid=$_SESSION['job_id'];
                          $sql="select * from jobs where job_id='".$jobid."'";
                          $job=mysqli_query($con,$sql) or die('Error in the sql query2');
                          $job_row=mysqli_fetch_row($job);
                          echo '<div class="row gtr-uniform">';
                            echo '<input type="hidden" style="all: initial;" name="jid" id="jid" value="' . $jobid . '">';
                            echo '<div class="col-12">';
                              echo '<input type="text" name="title" id="title" value="' . $job_row[2] . '" maxlength="100" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" onkeypress="return isAlpha(event);" required />';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="full_time" name="job_type" value="Full Time" checked required />';
                              echo '<label for="full_time">Full Time</label>';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="part_time" name="job_type" value="Part Time" required />';
                              echo '<label for="part_time">Part Time</label>';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="freelancer" name="job_type" value="Freelancer" required />';
                              echo '<label for="freelancer">Freelancer</label>';
                            echo '</div>';
                            echo '<div class="col-6">';
                              echo '<select name="location" value="" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required >';
                                echo '<option selected="selected">-Job Location-</option>';
                                echo '<option disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Top Metropolitan Cities-</i></font></option>';
                                echo '<option value="Ahmedabad">Ahmedabad</option>';
                                echo '<option value="Bangalore">Bangalore</option>';
                                echo '<option value="Chandigarh">Chandigarh</option>';
                                echo '<option value="Chennai">Chennai</option>';
                                echo '<option value="Delhi">Delhi</option>';
                                echo '<option value="Gurgaon">Gurgaon</option>';
                                echo '<option value="Hyderabad">Hyderabad</option>';
                              echo '</select>';
                            echo '</div>';
                            echo '<div class="col-6">';
                              echo '<input type="date" name="deadline" id="deadline" value="' . $job_row[5] . '" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" placeholder="Deadline" required />';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<select name="job_post" id="job_post" value="" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required>';
                                echo '<option selected="selected" disabled="disabled">-Post-</option>';
                                echo '<option value="UI Developer">UI Developer</option>';
                                echo '<option value="DB Designer">DB Designer</option>';
                                echo '<option value="PHP Programmer">PHP Programmer</option>';
                                echo '<option value="JS Programmer">JS Programmer</option>';
                                echo '<option value="Tester">Tester</option>';
                              echo '</select>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<textarea name="short_description" id="short_description" rows="4" maxlength="500" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required>' . $job_row[7] . '</textarea>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<textarea name="full_description" id="full_description" rows="8" maxlength="2000" style="box-sizing: border-box; border: 1px solid red; border-radius: 10px;" required >' . $job_row[8] . '</textarea>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<ul class="actions">';
                                echo '<li><input type="Reset" value="Clear" class="primary" /></li>';
                                echo '<li><input type="submit" name="submit1" value="Update" class="primary" /></li>';
                                echo '<li><input type="submit" name="submit2" value="Delete" class="primary" /></li>';
                              echo '</ul>';
                            echo '</div>';
                          echo '</div>';


                        /* Update Table */

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit1']))
                        {
                          /* Fetching values from the form */
                          $id=$_POST['jid'];
                          $title=$_POST['title'];
                          $type=$_POST['job_type'];
                          $deadline=$_POST['deadline'];
                          $location=$_POST['location'];
                          $job_post=$_POST['job_post'];
                          $short_desc=$_POST['short_description'];
                          $full_desc=$_POST['full_description'];

                          /* Update values in table */
                          $sql="update jobs set title='$title', type='$type', location='$location', deadline='$deadline', post='$job_post', short_desc='$short_desc', full_desc='$full_desc' where job_id='".$id."'";
                          $res_update=mysqli_query($con,$sql) or die('Error in the sql query3');
                          if($res_update > 0)
                          {
                            echo '<script language="javascript">';
                            echo 'alert("Successfully Upadated.")';
                            echo '</script>';
                          }
                          else
                          {
                            echo '<script language="javascript">';
                            echo 'alert("Upadated Failed !")';
                            echo '</script>';
                          }
                        }

                        /* Delete Job */
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2']))
                        {
                          $id=$_POST['jid'];

                           $sql="delete from applied_candidates where job_id='".$id."'";
                     			 $res_update2=mysqli_query($con,$sql) or die('Error in the sql query4');

                     			 $sql="delete from jobs where jobid='".$id."'";
                     			 $res_update3=mysqli_query($con,$sql) or die('Error in the sql query5');

                     			 if($res_update2>0 && $res_update3>0)
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
</script>
