<?php
   session_start();
?>
<html>
<head>
   <title>Gestion de Liste (ADMIN) - Modifier</title>
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
	  
	  <div id="BlocListeClasse" class="BlocListeClasse" >
		 <form action="../PageWebAdmin/GestionListeAdmin.php" method="post">
			  <input id="BtnModifierClasse" type="submit" value="Retour">
		 </form></br>
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
		 </select>
		 <input type="submit" name="submit" id="submit" value="Rechercher"/>
		 <input type="button" name="BtnResetFilter" id="BtnResetFilter" value="Remise à zéro" onclick="resetFilter()"/>
		 </form>
		 <form action="../PageWebAdmin/GestionListeAdmin_ModifierClasse_Aff.php" method="post">
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
			   echo '<div style="text-align:left">';
				while($row = $result->fetch_assoc())
				{
				  $row_IDClasse = (isset($row["IDClasse"]) ? $row["IDClasse"] : "");
				  echo '<label><input type="checkbox" name="ModifListe" value="' . $row_IDClasse . ' ">';
				  echo $row["INTITULE"] . "</label>";
				  echo '<input type="submit" id="ButtonModifierClasse" class="icone_table" style="background:url(../Image/editer.png); height:30px; width:30px; no-repeat;border:none;" name="ModifListe" value=' . $row["IDCLASSE"] . ' /></br>';
				}
				echo '</div>';
			}
			else
			{
				echo "0 results";
			}
			$conn->close();
		 ?>
		 </p>
	  </div>
	  
	  <button id="BtnValiderListe" name="submit" type="submit" class="BtnValider" value="ButtonValider"> Valider </button>
	  </form>
	  </div>
   <script type="text/javascript">  
		 function addNewRow_tableajoutprofesseur()
		 {
			var table = document.getElementById("table_ajoutprofesseur");
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount - 1);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			cell1.innerHTML = '<input type="text" name="NomProf">';
			cell2.innerHTML = '<input type="text" name="Matière">';
			cell3.innerHTML = '<input type="text" name="EmailProf">';
			cell4.innerHTML = '<img id="ButtonSupprimer" src="../Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
		  }
		  
		  function addNewRow_tableprofesseurClasse() {
            var table = document.getElementById("Table_professeurClasse");
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount - 1);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			cell1.innerHTML = '<input type="text" name="NomProf">';
			cell2.innerHTML = '<input type="text" name="Matière">';
			cell3.innerHTML = '<input type="text" name="EmailProf">';
			cell4.innerHTML = '<img id="ButtonSupprimer" src="../Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
          }
		  
		  function addNewRow_tableEleveClasse() {
            var table = document.getElementById("Table_eleveClasse");
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount - 1);
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			cell1.innerHTML = '<input type="text" name="NomEleve">';
			cell2.innerHTML = '<input type="text" name="Email">';
			cell3.innerHTML = '<img id="ButtonSupprimer" src="../Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
          }
		
		 function removeRow(tableID, row)
		 {
			 var table = document.getElementById("table_ajoutprofesseur");
			 var rowCount = table.rows.length;
			 var i=row.parentNode.parentNode.rowIndex;
			 if (rowCount > 3)
			 {
			   table.deleteRow(i);
			 }		  
		 }
		 
		 function handleButtonClick_AfficherClasse() {
            var div = document.getElementById("BlocListeClasse");
			div.style.display = "inline";
            div = document.getElementById("BlocListeProfesseur");
			div.style.display = "none";
			div = document.getElementById("BlocCreationListeClasse");
			div.style.display = "inline";
			div = document.getElementById("BlocCreationListeProfesseur");
			div.style.display = "none";
			var btn = document.getElementById("BtnValiderListe");
			btn.style.display = "inline";
         }
		 
		 function handleButtonClick_AfficherProfesseur() {
            var div = document.getElementById("BlocListeClasse");
			div.style.display = "none";
            div = document.getElementById("BlocListeProfesseur");
			div.style.display = "inline";
			div = document.getElementById("BlocCreationListeClasse");
			div.style.display = "none";
			div = document.getElementById("BlocCreationListeProfesseur");
			div.style.display = "inline";
			var btn = document.getElementById("BtnValiderListe");
			btn.style.display = "none";
         }
		 
		 function createCSV()
		 {
			window.location.assign('CreateCSV.php');
		 }	 
		 
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






