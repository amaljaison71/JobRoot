<?php
class DBcon
{
public $db;
function __construct()
{
    // create new connection to db with user name root and password ""
    $this->db=mysqli_connect("localhost","root","","jobroot");
    
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

}
function __destruct() {
    // will distroy the connection object ig no reference found
    $this->db=mysqli_close($this->db);
}

//employer registeration function 
function employerReg($cname,$cin,$location,$email,$phone,$category,$website,$description,$password)
{

    /* Inserting values into employer table */
    $sql="insert into employer(cname,cin,holoc,email,phone,category,website,about) values('$cname','$cin','$location','$email','$phone','$category','$website','$description')" ;    
    $res=mysqli_query( $this->db,$sql);

    /* Inserting values into login table */
    $sql2="insert into login(email,password,role) values('$email','$password',2)";
    $res2=$res>0?mysqli_query( $this->db,$sql2):0;
	return $res2; // returns number of affected rows
    }
    
}
?>