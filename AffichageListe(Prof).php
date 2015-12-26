<html>

<head>
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
		 <form action="Acceuil.html" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour [MAIL] </label>
	</div>
	
   	<div class="BlocAffichageListe">
	  <a href="GestionListe.php"><button id="ButtonAjouterListe" type="button" class="BtnDivEdition">Ajouter liste</button></a>
	  <table class="TableAffichage">
	  <label id="label_IdTableau">Liste des classes pour lesquelles vous avez crée des listes de fournitures</label>
	   <tr>
		 <th>Classe</th>
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
		 $sql = "SELECT DISTINCT Classe.Intitule, Professeur.Matiere, (SELECT SUM(QUANTITE) FROM FOURNITURE WHERE IDClasse=0) as Quantite FROM Classe, Professeur, Fourniture WHERE Fourniture.IDCLasse=0 AND professeur.IDClasse=0";
		 $result = $conn->query($sql);						
		 if ($result->num_rows > 0)
		 {
			
			 while($row = $result->fetch_assoc())
			 {
			   echo "<tr>";
			   echo "<td>" .$row["Intitule"]. "</td>";
			   echo "<td>" .$row["Matiere"]. "</td>";
			   echo "<td>" .$row["Quantite"]. "</td>";
			   echo '<td class="RowTableEdition"><a href="GestionListe.php"><img id="ButtonEditer" src="Image/editer.png" class="icone_table" alt="Editer"/></a></td>';
			   echo '<td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer"/></td>';
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
   </body>



</html>