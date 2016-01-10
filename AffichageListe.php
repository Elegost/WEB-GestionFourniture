<?php 
session_start();
?>
<html>

<head>
   <title>AffichageListe</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Style.css" type="text/css" rel="stylesheet" />
   
    <script>
		
		function createPDF()
		 {
			window.location.assign('CreatePDF.php');
		 }
    </script>
   
</head>

<body>
	  <?php
		 $sqlConn = mysqli_connect("localhost","AllUser","");
		 if (!$sqlConn)
		 {
			 die("Database connection failed : " . mysql_error());
		 }
	  ?>
	  <div class="BlocHeader">
		<img id="logo" src="Image/logo.jpg" >
		   <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		   </form>
		  <label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?> </label>
	  </div>
	  
	  <div class="BlocAffichageListe">  
		 <div id="BlocAffichageListeProf" class="BlocAffichageListeProf">
			  
				  <?php
					 $servername = "localhost";
					 $username = "allUser";
					 $password = "";
					 $dbname = "GestionFourniture";						
					 // Create connection
					 $conn = new mysqli($servername, $username, $password, $dbname);
					 // Check connection
					 if ($conn->connect_error)
					 {
						 die("Connection failed: " . $conn->connect_error);
					 }
					 $mail = $_SESSION['Email'];
					 $sql = "SELECT Nom, Matiere FROM Professeur WHERE IDClasse = (SELECT IDClasse FROM Eleve WHERE Mail = '$mail')";
					 $result = $conn->query($sql);						
					 if ($result->num_rows > 0)
					 {
						
						 while($row = $result->fetch_assoc())
						 {
						   echo '<table id="tableProfesseur" class="TableAffichage">';
						   echo "<tr>";
						   echo "<th>M. / Mme.</th>";
						   echo "<th>Matière</th>"; 
						   echo "</tr>";
						   
						   echo "<tr>";
						   echo "<td>" .$row["Nom"]. "</td>";
						   echo "<td>" .$row["Matiere"]. "</td>";
						   echo "</tr>";
						   echo "</table>";
						   
						   echo '<table id="tableFourniture" class="TableAffichage">';
						   echo "<tr>";
						   echo "<th>Intitulé</th>";
						   echo "<th>Nombre</th>"; 
						   echo "<th>Description</th>";
						   echo "</tr>";
						   
						   $sql2 = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDClasse = (SELECT IDClasse FROM Eleve WHERE Mail = '$mail') AND IDProfesseur = (SELECT IDProfesseur FROM Professeur WHERE Professeur.Nom = '" . $row["Nom"]. "')";
						   $result2 = $conn->query($sql2);						
						   if ($result2->num_rows > 0)
						   {
							  
							   while($row2 = $result2->fetch_assoc())
							   {
								 echo "<tr>";
								 echo "<td>" .$row2["Intitule"]. "</td>";
								 echo "<td>" .$row2["Quantite"]. "</td>";
								 echo "<td>" .$row2["Description"]. "</td>";
								 echo "</tr>";
								 
							   }
							   echo "</table>";
						   }
						   else
						   {
							   echo "<tr><td colspan=3> 0 results </td></tr>";
						   }
						   
						 }
					 }
					 else
					 {
						 echo "<tr><td colspan=3> 0 results </td></tr>";
					 }
					 $conn->close();
				  ?>
		  </div>
			<button id="BtnImpressionListeFourniturePDF" type="button" onclick="createPDF()">Imprimer PDF</button>
	 </div>
   </body>



</html>