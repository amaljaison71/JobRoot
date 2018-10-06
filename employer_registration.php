<?php
	
	/* Database connectivity for employer registration */
	
	$con=mysqli_connect("localhost","root","");
	$db=mysqli_select_db($con,"jobroot")or die('Error connecting to MySQL table.');
	
	/* Fetching values from the registration form */
	$cname=$_POST['cname'];
	$cin=$_POST['cin'];
	$category=$_POST['category'];
	$location=$_POST['location'];
	$email=$_POST['email'];
	$website=$_POST['website'];
	$phone=$_POST['phone'];
	$password=$_POST['password1'];
	$description=$_POST['description'];	
	
	/* Inserting values into employer table */
	$sql="insert into employer(cname,cin,holoc,email,phone,category,website,about) values('$cname','$cin','$location','$email','$phone','$category','$website','$description')" ;
	$res=mysqli_query($con,$sql) or die('Error in the sql query1'); 
	
	/* Inserting values into login table */
	$sql="insert into login(email,password,role) values('$email','$password',2)";
	$res=mysqli_query($con,$sql)or die('Error in the sql query2');
	
	/* Close db connection */
	mysqli_close($con);
	
	/* Show employer's home page */
	include("index.html");
?>