<?php
  session_start();

  /* Database connectivity for jobs */
  if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
    $con=mysqli_connect("localhost","root","");
		$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

    /* Retrieve values from jobs table */
    $sql="select * from jobs where job_id='".$_SESSION['job_id']."'";
		$jobs=mysqli_query($con,$sql) or die('Error in the sql query2');
    $job_row = mysqli_fetch_array($jobs);

    /* Retrieve values from employer table */
    $sql="select cname from employer where empid='".$job_row['empid']."'";
		$employer=mysqli_query($con,$sql) or die('Error in the sql query2');
    $cname = mysqli_fetch_array($employer);

    if(isset($_GET['apply']))
		{
			$_SESSION['job_id']=$_GET['apply'];
			header('location:jobseeker_test.php');
		}
  }

?>

<!-- Header -->
<?php
  include('jobseeker_header.php');
?>

<!-- Main -->
<div id="main">

  <form method="get">
    <!-- Introduction -->
    <div id="main">
      <section id="intro" class="main">
        <div class="spotlight" style="width: 100%;">
          <div class="card" style="margin-left: 5px; margin-right: 5px; width: 100%;">
              <div class="container" style="text-align: left;">
                <div id="main">
                  <section class="main">
                    <div class="row gtr-uniform">
                      <div class="col-12">
                        <span><h1><b><?php echo $job_row['title']; ?></b></h1></span>
                      </div>
                      <div class="col-12">
                        <span class="icon fa-university">  <?php echo $cname['cname']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="icon fa-map-marker">  <?php echo $job_row['location']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="icon fa-briefcase">  <?php echo $job_row['post']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="icon fa-hourglass-half">  <?php echo $job_row['type']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="icon fa-calendar">  <?php echo $job_row['deadline']; ?></span>
                      </div>
                      <div class="col-12">
                        <span><h5><i><u><b>About the job</b></u></i></h5></span></br>
                        <span><h2><?php echo $job_row['short_desc']; ?></h2></span>
                      </div>
                      <div class="col-12">
                        <span><h5><i><u><b>Details</b></u></i></h5></span></br>
                        <span><h2><?php echo $job_row['full_desc']; ?></h2></span>
                      </div>
                      <div class="col-12" style="margin-top:7px;">
      									<button type="submit" class="primary" name="apply" value="<?php echo $job_row[0]; ?>">Apply</button>
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
