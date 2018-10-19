<?PHP
  session_start();

  /* Database connectivity for employer registration */

  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
  $email=$_SESSION['email'];

  /* Load values into select box */

  $sql="select job_id,title from jobs where empid=(select empid from employer where email='".$email."')";
  $job_id=mysqli_query($con,$sql) or die('Error in the sql query1');

  /* Close db connection */
  mysqli_close($con);
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
                      <select name="job_id" onchange="this.form.submit()">
                        <option selected="selected" disabled="disabled" style="background-color:#f2efef"><font color="#000000"><i>-Select Job Title-</i></font></option>
                        <?php
                          while($row = mysqli_fetch_array($job_id))
                          {
                            echo '<option value="' . $row['job_id'] . '">' . $row['title'] . '</option>';
                          }
                        ?>
											</select>
                    </div>
                      <?php

                        /* Load values into form upon change in select */

                        if(isset($_POST["job_id"]))
                        {
                          /* Load values into form upon change in select */

                          $job_id=$_POST['job_id'];
                          $sql="select * from jobs where job_id='".$job_id."'";
                          $job=mysqli_query($con,$sql) or die('Error in the sql query2');
                          $job_row=mysqli_fetch_row($job);
                          echo '<div class="row gtr-uniform">';
                            echo '<input type="hidden" style="all: initial;" name="jid" id="jid" value="' . $job_id . '">';
                            echo '<div class="col-12">';
                              echo '<input type="text" name="title" id="title" value="' . $job_row[2] . '">';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="full_time" name="job_type" value="Full Time" checked>';
                              echo '<label for="full_time">Full Time</label>';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="part_time" name="job_type" value="Part Time">';
                              echo '<label for="part_time">Part Time</label>';
                            echo '</div>';
                            echo '<div class="col-4 col-12-small">';
                              echo '<input type="radio" id="freelancer" name="job_type" value="Freelancer">';
                              echo '<label for="freelancer">Freelancer</label>';
                            echo '</div>';
                            echo '<div class="col-6">';
                              echo '<select name="location" value=""  >';
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
                              echo '<input type="date" name="deadline" id="deadline" value="' . $job_row[5] . '" placeholder="Deadline">';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<select name="job_post" id="job_post" value=""  >';
                                echo '<option selected="selected" disabled="disabled">-Post-</option>';
                                echo '<option value="UI Developer">UI Developer</option>';
                                echo '<option value="DB Designer">DB Designer</option>';
                                echo '<option value="PHP Programmer">PHP Programmer</option>';
                                echo '<option value="JS Programmer">JS Programmer</option>';
                                echo '<option value="Tester">Tester</option>';
                              echo '</select>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<textarea name="short_description" id="short_description" rows="4">' . $job_row[7] . '</textarea>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<textarea name="full_description" id="full_description" rows="8">' . $job_row[8] . '</textarea>';
                            echo '</div>';
                            echo '<div class="col-12">';
                              echo '<ul class="actions">';
                                echo '<li><input type="Reset" value="Clear" class="primary" /></li>';
                                echo '<li><input type="submit" name="submit1" value="Update" class="primary" /></li>';
                              echo '</ul>';
                            echo '</div>';
                          echo '</div>';
                        }

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
                          mysqli_close($con);
                          header('location:employer_edit_job.php');
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

?>
