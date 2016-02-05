<?php
   session_start();
?>
<html>
<head>
   <title>Gestion de Liste (ADMIN) - Supprimer</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="../PageWebAdmin/Style-Admin.css" type="text/css" rel="stylesheet" /> 
</head>

<body>
    <div class="BlocHeader">
		 <img id="logo" src="../Image/logo.jpg" >
		 <form action="../PageWeb/Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?></label>
	</div>

   <div class="BlocGestionListe">
	  <div class="BlocListeClasseProfesseur">
		 
	  <div class="BlocSelectionListeClasseProfesseur">
		 <a href="AffichageListe.php"><button id="BtnRetour" type="button">Retour</button></a>
	  </div>
	  
	  <div id="BlocListeClasse" class="BlocListeClasse" >
		<form id="Form_SuppressionClasse" name="Form_SuppressionClasse" method="post" action="../FonctionsPhp/Delete_ListeFourniture.php">
		 <p class="cbClasse">
			 <?php
			include('../connexion.php');
            $email=$_SESSION['Email'];
            $email=$conn->real_escape_string($email);
			$sql = "SELECT INTITULE, IDCLASSE FROM classe WHERE classe.IDClasse = (SELECT IDClasse from professeur where Mail='$email')";
			$result = $conn->query($sql);						
			if ($result->num_rows > 0)
			{			
				while($row = $result->fetch_assoc())
				{
				  $row_IDClasse = (isset($row["IDCLASSE"]) ? $row["IDCLASSE"] : "");
				  echo "<label>";
				  echo '<input type="checkbox" name="cbclasse[]" value="' . $row_IDClasse . ' ">';
				  echo $row["INTITULE"];
				  echo "</label>";
				}
			}
			else
			{
				echo "0 results";
			}
			$conn->close();
		 ?>
		 </p>
         
	  </div>
	  
	 	  <button id="BtnSupprimerClasse" name="submit" type="submit" class="BtnValider" value="ButtonValider"> Valider suppression </button>
 
        </form>
	  </div>
    
       <script type="text/javascript">  
		 /*function store_DDL_Niveau()  
		 {
		   setCookie("DDL_Niveau_index", DDL_Niveau.selectedIndex);
		   return true;
		 }
		 
		 function store_DDL_Classe()
		 {
            setCookie("DDL_Classe_index", DDL_Classe.selectedIndex);
			return true;
         }
		 
		 function resetFilter()
		 {
			deleteCookie("DDL_Niveau_index");
			deleteCookie("DDL_Classe_index");
			
		 }
					 
		 var DDL_Niveau = document.getElementById("DDL_Niveau");
		 if(field1 = getCookie("DDL_Niveau_index")) DDL_Niveau.selectedIndex = field1;
		 
		 var DDL_Classe = document.getElementById("DDL_Classe");
		 if (field2 = getCookie("DDL_Classe_index")) DDL_Classe.selectedIndex = field2;*/
	  		 
	 </script>
</body>

</html>






