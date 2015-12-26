<html>

<head>
   <title>AffichageListe</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Style.css" type="text/css" rel="stylesheet" />
   
    <script>
        function handleClickTable(e) {
            alert(e.target.innerText); //current cell
			alert(e.target.parentNode.innerText); //Current row
			
        }
    </script>
   
</head>

<body>
	  <?php
		 $sqlConn = mysql_connect("localhost","AllUser","");
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
		  <label id="IdUser" for="IdUser">Bonjour [MAIL] </label>
	  </div>
	  
	  <div class="BlocAffichageListe">
		
		 <button id="ButtonRetourListeProf" type="button">Retour</button><br/>
  
		 <div class="BlocAffichageListeProf">
			  <table class="TableAffichage" onclick="handleClickTable(event)" >
					<tr>
					  <th>M. / Mme.</th>
					  <th>Matière</th> 
					  <th>Nombre de fournitures</th>
					</tr>
					 <?php
						$servername = "localhost";
						$username = "AllUser";
						$password = "";
						$dbname = "GestionFourniture";						
						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error)
						{
							die("Connection failed: " . $conn->connect_error);
						} 						
						$sql = "SELECT Nom, Matiere, SUM(Quantite) as Quantite FROM Professeur, Fourniture WHERE Fourniture.IDCLasse=0 AND professeur.IDClasse=0";
						$result = $conn->query($sql);						
						if ($result->num_rows > 0)
						{
						   
							while($row = $result->fetch_assoc())
							{
							  echo "<tr>";
							  echo "<td>" .$row["Nom"]. "</td>";
							  echo "<td>" .$row["Matiere"]. "</td>";
							  echo "<td>" .$row["Quantite"]. "</td>";
							  echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td colspan=3> 0 results </td></tr>";
						}
						$conn->close();
					 ?>
			  </table>
		  </div>
		  <div class="BlocAffichageListeFournitures">
			  <table class="TableAffichageFournitures">
				  <label id="label_IdTableau" >Liste des fournitures demandé par le professeur</label>
				  <tr>
					  <th>Intitulé</th>
					  <th>Nombre</th> 
					  <th>Description</th>
					</tr>
					<?php
						$servername = "localhost";
						$username = "AllUser";
						$password = "";
						$dbname = "GestionFourniture";						
						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if ($conn->connect_error)
						{
							die("Connection failed: " . $conn->connect_error);
						} 						
						$sql = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDCLasse=0 ";
						$result = $conn->query($sql);						
						if ($result->num_rows > 0)
						{
						   
							while($row = $result->fetch_assoc())
							{
							  echo "<tr>";
							  echo "<td>" .$row["Intitule"]. "</td>";
							  echo "<td>" .$row["Quantite"]. "</td>";
							  echo "<td>" .$row["Description"]. "</td>";
							  echo "</tr>";
							}
						}
						else
						{
							echo "<tr><td colspan=3> 0 results </td></tr>";
						}
						$conn->close();
					 ?>
			  </table>
		  </div>
	 </div>
   </body>



</html>