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
   <link href="Style-Admin.css" type="text/css" rel="stylesheet" /> 
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
		 <a href="GestionListeAdmin.php"><button id="BtnRetour" type="button">Retour</button></a>
	  </div>
	  
	  <div id="BlocListeClasse" class="BlocListeClasse" >
		 <form id="FiltreListeClasse" name="FiltreListeClasse" method="post" action="">
 		 <select id="DDL_Niveau" name="DDL_Niveau" onChange="store_DDL_Niveau()" >

		   <option>Tous les niveaux</option>      
		   <?php
			  include('../connexion.php');			
			   $email=$_SESSION['Email'];
			   $email=$conn->real_escape_string($email);
			   $test="SELECT Droit from connection where Email='$email'";
			   $test=$conn->query($test);
			   $droit=mysqli_fetch_array($test);
			   if($droit[0]<2)
			   {
				   header('Location: ../hack.html');
			   }
			   $sql = "SELECT DISTINCT Niveau FROM Classe WHERE 1";
			   $result = $conn->query($sql);						
			   if ($result->num_rows > 0)
			   {			
				   while($row = $result->fetch_assoc())
				   {
					 echo "<option>" . $row["Niveau"] . "</option>";
				   }
			   }
			   $conn->close();
			?>
		 </select></br>
		 <input type="submit" name="submit" id="submit" value="Rechercher"/>
		 <input type="button" name="BtnResetFilter" id="BtnResetFilter" value="Remise à zéro" onclick="resetFilter()"/>
		 </form>
		<form id="Form_SuppressionClasse" name="Form_SuppressionClasse" method="post" action="../FonctionsPhp/Delete_Classe.php">
		 <p class="cbClasse">
			 <?php
			include('../connexion.php');
			$sql = "SELECT INTITULE, IDCLASSE FROM Classe WHERE 1";
			if(isset($_POST['DDL_Niveau']))
			{
			   $DDL_Niveau = $_POST['DDL_Niveau'];
			}
			if (isset($DDL_Niveau) && $DDL_Niveau != 'Tous les niveaux')
			   $sql .= " AND NIVEAU='$DDL_Niveau'";
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






