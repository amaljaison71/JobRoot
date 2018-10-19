<?PHP

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit1']))
	{
    /* Database connectivity for employer registration */

    $con=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');

    /* Fetching values from the registration form */
    $category=$_POST['category'];
    $question=$_POST['question'];
    $option1=$_POST['option1'];
		$option2=$_POST['option2'];
		$option3=$_POST['option3'];
		$option4=$_POST['option4'];
		$answer=$_POST['answer'];

    /* Inserting values into question table */
    $sql="insert into questions(category,question,option1,option2,option3,option4,answer) values('$category','$question','$option1','$option2','$option3','$option4','$answer')" ;
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
    /* Close db connection */
    mysqli_close($con);
    header('location:admin_add_questions.php');
  }
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
			<h2>Add Question</h2>
			<form method="post">
				<div class="row gtr-uniform">

					<div class="col-12">
						<select name="category" value=""  required>
							<option selected="selected" disabled="disabled">-Category-</option>
							<option value="html">HTML</option>
							<option value="sql">SQL</option>
							<option value="php">PHP</option>
							<option value="js">JS</option>
							<option value="c">C</option>
							<option value="css">CSS</option>
							<option value="language">Language</option>
							<option value="reasoning">Reasoning</option>
							<option value="aptitude">Aptitude</option>
						</select>
					</div>
					<div class="col-12">
						<textarea name="question" id="question" placeholder="Question" rows="8" required></textarea>
					</div>
					<div class="col-6">
						<input type="text" name="option1" id="option1" value="" placeholder="Option1" required/>
					</div>
					<div class="col-6">
						<input type="text" name="option2" id="option2" value="" placeholder="Option2" required/>
					</div>
					<div class="col-6">
						<input type="text" name="option3" id="option3" value="" placeholder="Option3" required/>
					</div>
					<div class="col-6">
						<input type="text" name="option4" id="option4" value="" placeholder="Option4" required/>
					</div>
					<div class="col-12">
						<input type="text" name="answer" id="answer" value="" placeholder="Answer" required/>
					</div>
					<div class="col-12">
						<ul class="actions">
							<li><input type="submit" name="submit1" value="Submit" class="primary" /></li>
						</ul>
					</div>
				</div>
			</form>
		</section>
	</section>
</div>


<!-- Footer -->
<?php
	include('employer_footer.php');
?>
