<?php
	  session_start();
?>
<html>

<head>
	<meta charset="utf-8" />
   <title>AffichageListe(Prof)</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Style.css" type="text/css" rel="stylesheet" />
   
</head>

<body>
   <div class="BlocHeader">
		 <img id="logo" src="Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?> </label>
	</div>
	
   	<div class="BlocAffichageListe">
	  <a href="GestionListe.php"><button id="ButtonAjouterListe" type="button" class="BtnDivEdition">Ajouter liste</button></a>
	  
	  <?php
		 $i=0;
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
		 $mail = $_SESSION["Email"];
		 $sql = "SELECT INTITULE, MATIERE FROM Classe, Professeur WHERE Professeur.Mail = '$mail'";
		 $result = $conn->query($sql);						
		 if ($result->num_rows > 0)
		 {
			 while($row = $result->fetch_assoc())
			 {
				  echo '<table class="TableAffichage">';
				  echo "<tr>";
				  echo "<th>Classe</th>";
				  echo "<th>Matière</th>";
				  echo "</tr>";
				  
				  echo "<tr>";
				  echo "<td>" .$row["INTITULE"]. "</td>";
				  echo "<td>" .$row["MATIERE"]. "</td>";
				  echo '<td class="RowTableEdition"><a href="GestionListe.php"><img id="ButtonEditer" src="Image/editer.png" class="icone_table" alt="Editer"/></a></td>';
				  echo '<td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Supprimer"/></td>';
				  echo "</tr>";
				  echo "</table>";
				  
				  echo '<table class="TableAffichage">';
				  echo "<tr>";
				  echo "<th>Intitulé</th>";
				  echo "<th>Nombre</th>"; 
				  echo "<th>Description</th>";
				  echo "</tr>";
				  
				  $sql2 = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDProfesseur = (SELECT IDProfesseur FROM Professeur WHERE Mail = '$mail')";
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
   </body>



</html>