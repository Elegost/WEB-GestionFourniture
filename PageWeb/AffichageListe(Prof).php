<?php
	  session_start();
	  //include('logger.php');
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
		 <img id="logo" src="../Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?> </label>
	</div>
	
   	<div class="BlocAffichageListe">
	  <form action="../PageWeb/GestionListe_Modif.php" method="post">
	  <a href="GestionListe.php"><button id="ButtonAjouterListe" type="button" class="BtnDivEdition">Ajouter liste</button></a>
	  <a href="GestionListe_SupprimerListeFourniture.php"><button id="ButtonSupprimerListe" type="button" class="BtnDivEdition">Supprimer liste</button></a>

	  
	  <?php
	  $i=0;
	  include('../connexion.php');
	  $email=$_SESSION['Email'];
	  $email=$conn->real_escape_string($email);
	  $test="SELECT Droit from connection where Email='$email'";
	  $test=$conn->query($test) or $log->error("Erreur requête sql : $test");
	  $droit=mysqli_fetch_array($test);
	  if($droit[0]<1)
	  {
		  header('Location: ../hack.html');
	  }
	  $sql="SELECT IDClasse from professeur where Mail='$email'";
	  $result1=$conn->query($sql);
	  $result1=mysqli_fetch_array($result1);
	  $sql = "SELECT INTITULE, IDCLASSE FROM classe WHERE classe.IDClasse = $result1[0]";
	  $result = $conn->query($sql);						
	  if ($result && $result->num_rows > 0)
	  {
			while($row = $result->fetch_assoc())
			{
				 echo '<table class="TableAffichage">';
				 echo "<tr>";
				 echo "<th>Classe</th>";

				 echo "</tr>";
				 
				 echo "<tr>";
				 echo "<td>" .$row["INTITULE"]. "</td>";
				 echo '<td class="RowTableEdition"><input type="submit" id="ButtonEditer" class="icone_table" style="background:url(../Image/editer.png); height:30px; width:30px; no-repeat;border:none;" name="ModifListe" value=' . $row["IDCLASSE"] . ' /></td>';
				 echo "</tr>";
				 echo "</table>";
				 
				 echo '<table class="TableAffichage">';
				 echo "<tr>";
				 echo "<th>Intitulé</th>";
				 echo "<th>Nombre</th>"; 
				 echo "<th>Description</th>";
				 echo "</tr>";
				 
				 $sql2 = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDProfesseur = (SELECT IDProfesseur FROM Professeur WHERE Mail = '$email')";
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
	 </form>
   	</div>
   </body>



</html>