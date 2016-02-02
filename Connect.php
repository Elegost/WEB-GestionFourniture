<?php
session_start();
if(!isset($_GET['login']) && !isset($_GET['Password']))
{
	header('location : ./PageWeb/Acceuil.php');
	
}
else
{
	
	if(0)
	// if(!preg_match('/^[[:alnum:]]+$/',$_GET['login']) or !preg_match('/^[[:alnum:]]+$/',$_GET['Password']))
	{
		echo 'Vous devez entrer uniquement des lettres ou des chiffres <br/>';
		echo '<a href=./PageWeb/Acceuil.php" temp_href="./PageWeb/Acceuil.php">Réessayer</a>';
		exit();
	}
	else
	{
	 $servername = "localhost";
					 $username = "root";
					 $password = "root";
					 $dbname = "GestionFourniture";						
					 // Create connection
					 $conn = new mysqli($servername, $username, $password, $dbname);
					  $conn->set_charset("utf8");
					 // Check connection
					 if ($conn->connect_error)
					 {
						 die("Connection failed: " . $conn->connect_error);
					 }
	$login=$_GET['login'];
	$motdepasse=$_GET['Password'];
	$login=$conn->real_escape_string($login);
	$sql="SELECT * FROM connection WHERE Email='$login'";
	
	$requete1=$conn->query($sql);
	if(mysqli_num_rows($requete1)==0)
	{
		echo 'Ce login est faux ! <br/> ';
		echo '<a href="./PageWeb/Acceuil.php" temp_href="./PageWeb/Acceuil.php">Réessayer</a>';
		exit();
	}
	else
	{	$sql2="SELECT password FROM connection WHERE Email='$login'";
		 $requete2=$conn->query($sql2);
		 $result=mysqli_fetch_array($requete2);
	//$requete2 = $conn->query($sql. "AND pass='".($motdepasse)."'");
	if($conn->real_escape_string($result[0])==$motdepasse)
	{
		$sql3="SELECT droit FROM connection WHERE Email='$login'";
		$requete3=$conn->query($sql3);
		$resultallow=mysqli_fetch_array($requete3);
		if($conn->real_escape_string($resultallow[0]==2))
		{
			
			$login=$_GET['login'];
			$_SESSION['Email']=$login;
			header('Location: ./PageWebAdmin/GestionListeAdmin.php');
		}
		elseif(($conn->real_escape_string($resultallow[0]==1)))
		{
			$login=$_GET['login'];
			$_SESSION['Email']=$login;
			header('Location: ./PageWeb/AffichageListe(Prof).php');
		}
		elseif(($conn->real_escape_string($resultallow[0]==0)))
		{
			$login=$_GET['login'];
			$_SESSION['Email']=$login;
			header('Location:  ./PageWeb/AffichageListe.php');
		}
		
	}
	else
	{
		
		echo 'Le Pass est faux ! <br/> ';
		echo '<a href="/PageWeb/Acceuil.php" temp_href="/PageWeb/Acceuil.php">Réessayer</a>';
		exit();
	}
	}
	}
	
}
?>