<?php
	/* Fetching values from the registration form */
	include('DBCon/DBConnection.php');
	$db=new DBCon();

	$cname=$_POST['cname'];
	$cin=$_POST['cin'];
	$category=$_POST['category'];
	$location=$_POST['location'];
	$email=$_POST['email'];
	$website=$_POST['website'];
	$phone=$_POST['phone'];
	$password=$_POST['password1'];
	$description=$_POST['description'];	
	
	$res=$db->employerReg($cname,$cin,$location,$email,$phone,$category,$website,$description,$password);
	
	/* Show employer's home page */
	// res contins the number of affected rows . res==0 means no rows affected
	$res>0?header('location:login.php'):header('location:employer_registration.html');
?>