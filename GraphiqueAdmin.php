 <?php
 session_start();
 ?>
 <html>

<head>
   <title>Graphique admin</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="graphique.css" type="text/css" rel="stylesheet" />  
</head>

<body>
 <div class="BlocHeader">
		 <img id="logo" src="Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser"> Voici la page du Graphique Mr : <?php echo $_SESSION['Email'];?> </label>
	</div>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "GestionFourniture";						
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
		$email=$_SESSION['Email'];
	$email=$conn->real_escape_string($email);
	$test="SELECT Droit from connection where Email='$email'";
	$test=$conn->query($test);
	$droit=mysqli_fetch_array($test);
	if($droit[0]<2)
	{
		header('Location: hack.html');
	}
    $requete1 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='Anglais'";
    $result1=$conn->query($requete1);
	$result1=mysqli_fetch_array($result1);
	$requete2 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='Espagnol'";
    $result2=$conn->query($requete2);
	$result2=mysqli_fetch_array($result2);
	$requete3 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='Allemand'";
    $result3=$conn->query($requete3);
	$result3=mysqli_fetch_array($result3);
	$requete4 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='Informatique'";
    $result4=$conn->query($requete4);
	$result4=mysqli_fetch_array($result4);
	$requete5 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='EPS'";
    $result5=$conn->query($requete5);
	$result5=mysqli_fetch_array($result5);
	$requete6 = "SELECT SUM(Quantite) FROM fourniture INNER JOIN professeur ON fourniture.IDProfesseur = professeur.IDProfesseur WHERE Matiere='Philosophie'";
    $result6=$conn->query($requete6);
	$result6=mysqli_fetch_array($result6);
$resultTotal[0]=$result1[0]+$result2[0]+$result3[0]+$result4[0]+$result5[0]+$result6[0];
$result1cent=(($result1[0]*100)/($resultTotal[0]));
$result2cent=(($result2[0]*100)/($resultTotal[0]));
$result3cent=(($result3[0]*100)/($resultTotal[0]));
$result4cent=(($result4[0]*100)/($resultTotal[0]));
$result5cent=(($result5[0]*100)/($resultTotal[0]));
$result6cent=(($result6[0]*100)/($resultTotal[0]));
    $conn->close();
	echo "<div class='BlocAffGraphique'>";
   echo "<a href='GestionListeAdmin.php'><button id='BtnRetour' type='button'>Retour</button></a>";

   echo " <table class='graph' cellspacing='6' cellpadding='0'>";
     echo "<thead>";
       echo " <tr><th colspan='3'>Graphique (Nombre de fournitures par matières)</th></tr>";
      echo "</thead>";
      echo "<tbody>";
        echo "<tr>";
          echo "<td >Anglais</td><td class='bar'><div style='width: ".$result1cent."%'></div>".$result1[0]."</td><td>".$result1cent."%</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>Espagnol</td><td class='bar'><div style='width: ".$result2cent."%'></div>".$result2[0]."</td><td>".$result2cent."%</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>Allemand</td><td class='bar'><div style='width:".$result3cent."%'></div>".$result3[0]."</td><td>".$result3cent."%</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<td>Informatique</td><td class='bar'><div style='width:".$result4cent."%'></div>".$result4[0]."</td><td>".$result4cent."%</td>";
        echo "</tr>";
        echo "<tr>";
          echo"<td>EPS</td><td class='bar'><div style='width:".$result5cent."%'></div>".$result5[0]."</td><td>".$result5cent."%</td>";
        echo "</tr>";
        echo "<tr>";
          echo"<td>Philosophie</td><td class='bar'><div style='width:".$result6cent."%'></div>".$result6[0]."</td><td>".$result6cent."%</td>";
        echo "</tr>";
      echo "</tbody>";
    echo "</table>";
	echo "</div>";

	?>
  

</body>

</html>