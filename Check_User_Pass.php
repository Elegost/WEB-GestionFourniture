<?php
ob_start();
$host = "";
$login = "";
$password = "";
$db_name = "GestionFourniture";
$tbl_name = "CONNECTION";

// Connect to server and select databse.
mysql_connect("$host", "$login", "$password") or die(mysql_error());
echo "Connected to MySQL<br />";
mysql_select_db("$db_name") or die(mysql_error());
echo "Connected to Database<br />";

// Define $username and $password 
$login=$_POST['LOGIN']; 
//$password=md5($_POST['pass']); utiliser sa quand le cryptage sera mis en place
$password=$_POST['PASSWORD'];

$sqlquery = "SELECT (LOGIN, PASSWORD) FROM $tbl_name WHERE LOGIN='$login'";
$resquery = mysql_query($sqlquery);
$count=mysql_num_rows($resquery);

if($count==1){
    $row = mysql_fetch_assoc($resquery);
    //if (crypt($password, $row['password']) == $row['password']){
    if($password == $row['PASSWORD'])
    {
        session_register("login");
        session_register("password"); 
        echo "Login Successful";
        return true;
    }
    else {
        echo "Wrong Username or Password";
        return false;
    }
}
else{
    echo "Wrong Username or Password";
    return false;
}

?>