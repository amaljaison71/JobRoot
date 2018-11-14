<?php
  session_start();

  /* Database connectivity for jobs */
  $con=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

  /* Retrieve values from jobs table */
  $sql="select post from jobs where job_id='".$_SESSION['job_id']."'";
  $job=mysqli_query($con,$sql) or die('Error in the sql query1');
  $post = mysqli_fetch_array($job);

  if($post[0]=='UI Developer')
  {
    /* Retrieve values from questions table */
    $sql="select * from questions where category in ('html','php','js','css') ORDER BY RAND() LIMIT 10";
    $prg=mysqli_query($con,$sql) or die('Error in the sql query2');

    $sql="select * from questions where category='language' ORDER BY RAND() LIMIT 10";
    $lang=mysqli_query($con,$sql) or die('Error in the sql query3');

    $sql="select * from questions where category='reasoning' ORDER BY RAND() LIMIT 10";
    $reason=mysqli_query($con,$sql) or die('Error in the sql query4');

    $sql="select * from questions where category='aptitude' ORDER BY RAND() LIMIT 10";
    $apti=mysqli_query($con,$sql) or die('Error in the sql query5');
  }

  else if($post[0]=='DB Designer')
  {
    /* Retrieve values from questions table */
    $sql="select * from questions where category='sql' ORDER BY RAND() LIMIT 10";
    $prg=mysqli_query($con,$sql) or die('Error in the sql query6');

    $sql="select * from questions where category='language' ORDER BY RAND() LIMIT 10";
    $lang=mysqli_query($con,$sql) or die('Error in the sql query7');

    $sql="select * from questions where category='reasoning' ORDER BY RAND() LIMIT 10";
    $reason=mysqli_query($con,$sql) or die('Error in the sql query8');

    $sql="select * from questions where category='aptitude' ORDER BY RAND() LIMIT 10";
    $apti=mysqli_query($con,$sql) or die('Error in the sql query9');
  }

  else if($post[0]=='PHP Programmer')
  {
    /* Retrieve values from questions table */
    $sql="select * from questions where category in ('html','php','js','css','c','sql') ORDER BY RAND() LIMIT 10";
    $prg=mysqli_query($con,$sql) or die('Error in the sql query10');

    $sql="select * from questions where category='language' ORDER BY RAND() LIMIT 10";
    $lang=mysqli_query($con,$sql) or die('Error in the sql query11');

    $sql="select * from questions where category='reasoning' ORDER BY RAND() LIMIT 10";
    $reason=mysqli_query($con,$sql) or die('Error in the sql query12');

    $sql="select * from questions where category='aptitude' ORDER BY RAND() LIMIT 10";
    $apti=mysqli_query($con,$sql) or die('Error in the sql query13');
  }

  else if($post[0]=='JS Programmer')
  {
    /* Retrieve values from questions table */
    $sql="select * from questions where category in ('html','php','js','css','c','sql') ORDER BY RAND() LIMIT 10";
    $prg=mysqli_query($con,$sql) or die('Error in the sql query14');

    $sql="select * from questions where category='language' ORDER BY RAND() LIMIT 10";
    $lang=mysqli_query($con,$sql) or die('Error in the sql query15');

    $sql="select * from questions where category='reasoning' ORDER BY RAND() LIMIT 10";
    $reason=mysqli_query($con,$sql) or die('Error in the sql query16');

    $sql="select * from questions where category='aptitude' ORDER BY RAND() LIMIT 10";
    $apti=mysqli_query($con,$sql) or die('Error in the sql query17');
  }

  else if($post[0]=='Tester')
  {
    /* Retrieve values from questions table */
    $sql="select * from questions where category in ('html','php','js','css','c','sql') ORDER BY RAND() LIMIT 10";
    $prg=mysqli_query($con,$sql) or die('Error in the sql query18');

    $sql="select * from questions where category='language' ORDER BY RAND() LIMIT 10";
    $lang=mysqli_query($con,$sql) or die('Error in the sql query19');

    $sql="select * from questions where category='reasoning' ORDER BY RAND() LIMIT 10";
    $reason=mysqli_query($con,$sql) or die('Error in the sql query20');

    $sql="select * from questions where category='aptitude' ORDER BY RAND() LIMIT 10";
    $apti=mysqli_query($con,$sql) or die('Error in the sql query21');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply']))
  {
    $score=0;
    $i=1;
    while($row = mysqli_fetch_array($prg))
    {
      if(isset($_POST['op'.$i]) && $row['answer']==$_POST['op'.$i])
      {
        $score++;
      }
      $i++;
    }
    while($row = mysqli_fetch_array($lang))
    {
      if(isset($_POST['op'.$i]) && $row['answer']==$_POST['op'.$i])
      {
        $score++;
      }
      $i++;
    }
    while($row = mysqli_fetch_array($reason))
    {
      if(isset($_POST['op'.$i]) && $row['answer']==$_POST['op'.$i])
      {
        $score++;
      }
      $i++;
    }
    while($row = mysqli_fetch_array($apti))
    {
      if(isset($_POST['op'.$i]) && $row['answer']==$_POST['op'.$i])
      {
        $score++;
      }
      $i++;
    }

    if($score>20)
    {
      /* Insert into applied_candidates table */
      $jsid=$_SESSION['id'];
      $jid=$_SESSION['job_id'];
      $sql="insert into applied_candidates(jsid,job_id,score,flag) values($jsid,$jid,$score,0)";
      $res=mysqli_query($con,$sql) or die('Error in the sql query22');
      if($res>0)
      {
        echo '<script language="javascript">';
        echo 'alert("Test Passed. You Are Successfully Applied for the Job....")';
        echo '</script>';
      }
    }
    else
    {
      echo '<script language="javascript">';
      echo 'alert("Test Failed. You Cannot be Applied for the Job !!!")';
      echo '</script>';
    }
  }

  if(isset($_GET['apply']))
  {
    $_SESSION['job_id']=$_GET['apply'];
    header('location:jobseeker_test.php');
  }

?>

<!DOCTYPE HTML>
<!--
	JobRoot
-->
<html>
	<head>
		<title>JobRoot</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

		<script type="text/javascript" src="employer_home.js"></script>

    <script type="text/javascript">
    	function timeout()
    	{
    		var hours=Math.floor(timeLeft/3600);
    		var minute=Math.floor((timeLeft-(hours*60*60))/60);
    		var second=timeLeft%60;
    		var hrs=checktime(hours);
    		var mint=checktime(minute);
    		var sec=checktime(second);
    		if(timeLeft<=0)
    		{
          document.getElementById("apply").click();
    		}

        else if(timeLeft<=600)
    		{
          document.getElementById("time").style.color = "red";
		      document.getElementById("time").innerHTML=hrs+":"+mint+":"+sec;
    		}

    		else
    		{

    			document.getElementById("time").innerHTML=hrs+":"+mint+":"+sec;
    		}
    		timeLeft--;
    		var tm= setTimeout(function(){timeout()},1000);
    	}
    	function checktime(msg)
    	{
    		if(msg<10)
    		{
    			msg="0"+msg;
    		}
    		return msg;
    	}
    </script>

	</head>
	<body class="is-preload" onload="timeout()">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">

						<h1><img src="images/logos.png" width="27%" height="27%" style="margin-left: 26px"></h1>
						<p>Just another free, spot for finding perfect matching jobs
						</p>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="jobseeker_home.php">Home</a></li>
							<li><a href="jobseeker_jobs.php">Jobs</a></li>
							<li>
								<ul class="profile-wrapper">
									<li> <a>Add</a>
										<!-- user profile -->
										<div class="profile">

											<!-- more menu -->
											<ul class="menu">
												<li><a href="jobseeker_add_qualification.php">Qualification</a></li>
												<li><a href="jobseeker_add_project.php">Projects</a></li>
												<li><a href="jobseeker_add_experience.php">Experience</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<ul class="profile-wrapper">
									<li> <a>Update</a>
										<!-- user profile -->
										<div class="profile">

											<!-- more menu -->
											<ul class="menu">
												<li><a href="jobseeker_edit_qualification.php">Qualification</a></li>
												<li><a href="jobseeker_edit_project.php">Projects</a></li>
												<li><a href="jobseeker_edit_experience.php">Experience</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<ul class="profile-wrapper">
									<li> <a>View</a>
										<!-- user profile -->
										<div class="profile">

											<!-- more menu -->
											<ul class="menu">
												<li><a href="jobseeker_view_applied_jobs.php">Applied Jobs</a></li>
												<li><a href="jobseeker_view_selected_jobs.php">Selected Jobs</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<ul class="profile-wrapper">
									<li> <a>Profile</a>
										<!-- user profile -->
										<div class="profile">

											<!-- more menu -->
											<ul class="menu">
												<li><a href="jobseeker_edit_profile.php">Edit</a></li>
												<li><a href="jobseeker_change_password.php">Change Password</a></li>
												<li><a href="index.php">Logout</a></li>
											</ul>
										</div>
									</li>
								</ul>
							</li>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <li>
                <script type="text/javascript">
            		  var timeLeft=1*60*60;
          		  </script>
		            <div class="icon alt fa-hourglass-half" id="time" style="color: green; font-weight: bold;">timeout</div></h2>
              </li>
						</ul>
					</nav>


<!-- Main -->
<div id="main">

  <form method="post">
    <!-- Introduction -->
    <div id="main">
      <section id="intro" class="main">
        <div class="spotlight" style="width: 100%;">
          <div class="card" style="margin-left: 5px; margin-right: 5px; width: 100%;">
              <div class="container" style="text-align: left;">
                <div id="main">
                  <section class="main">
                    <div class="row gtr-uniform">
                      <section class="main" name="ProgrammingConcepts" id="ProgrammingConcepts">
                        <span><h5><b>Programming Concepts</b></h5></span>
                        <div class="row gtr-uniform">
                          <?php
                            $i=1; $j=1;
                            while($row = mysqli_fetch_array($prg))
                            {
                              echo '<div class="col-12">';
                                echo '<span><h3><b>' . $i . '.' . $row[2] . '</b></h3></span>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[3] . '"> <label for="op' . $j++ . '">' . $row[3] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[4] . '"> <label for="op' . $j++ . '">' . $row[4] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[5] . '"> <label for="op' . $j++ . '">' . $row[5] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[6] . '"> <label for="op' . $j++ . '">' . $row[6] . '</label>';
                              echo '</div>';
                              $i=$i+1;
                            }
                            mysqli_data_seek($prg,0);
                          ?>
                        </div>
                      </section>

                      <section class="main" name="VerbalAbility" id="VerbalAbility">
                        <span><h5><b>Verbal Ability</b></h5></span>
                        <div class="row gtr-uniform">
                          <?php
                            $i=11; $j=41;
                            while($row = mysqli_fetch_array($lang))
                            {
                              echo '<div class="col-12">';
                                echo '<span><h3><b>' . $i . '.' . $row[2] . '</b></h3></span>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[3] . '"> <label for="op' . $j++ . '">' . $row[3] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[4] . '"> <label for="op' . $j++ . '">' . $row[4] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[5] . '"> <label for="op' . $j++ . '">' . $row[5] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[6] . '"> <label for="op' . $j++ . '">' . $row[6] . '</label>';
                              echo '</div>';
                              $i=$i+1;
                            }
                            mysqli_data_seek($lang,0);
                          ?>
                        </div>
                      </section>

                      <section class="main" name="Reasoning" id="Reasoning">
                        <span><h5><b>Reasoning</b></h5></span>
                        <div class="row gtr-uniform">
                          <?php
                            $i=21; $j=81;
                            while($row = mysqli_fetch_array($reason))
                            {
                              echo '<div class="col-12">';
                                echo '<span><h3><b>' . $i . '.' . $row[2] . '</b></h3></span>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[3] . '"> <label for="op' . $j++ . '">' . $row[3] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[4] . '"> <label for="op' . $j++ . '">' . $row[4] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[5] . '"> <label for="op' . $j++ . '">' . $row[5] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[6] . '"> <label for="op' . $j++ . '">' . $row[6] . '</label>';
                              echo '</div>';
                              $i=$i+1;
                            }
                            mysqli_data_seek($reason,0);
                          ?>
                        </div>
                      </section>

                      <section class="main" name="Aptitude" id="Aptitude">
                        <span><h5><b>Aptitude</b></h5></span>
                        <div class="row gtr-uniform">
                          <?php
                            $i=31; $j=121;
                            while($row = mysqli_fetch_array($apti))
                            {
                              echo '<div class="col-12">';
                                echo '<span><h3><b>' . $i . '.' . $row[2] . '</b></h3></span>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[3] . '"> <label for="op' . $j++ . '">' . $row[3] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[4] . '"> <label for="op' . $j++ . '">' . $row[4] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[5] . '"> <label for="op' . $j++ . '">' . $row[5] . '</label>';
                              echo '</div>';
                              echo '<div class="col-12">';
                                echo '<input type="radio" id="op' . $j . '" name="op'. $i . '" value="' . $row[6] . '"> <label for="op' . $j++ . '">' . $row[6] . '</label>';
                              echo '</div>';
                              $i=$i+1;
                            }
                            mysqli_data_seek($apti,0);
                          ?>
                        </div>
                      </section>

                      <div class="col-12" style="margin-top:7px;">
      									<button type="submit" class="primary" name="apply" id="apply">Submit Answers</button>
      								</div>
                    </div>
                  </section>
                </div>
              </div>
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
