<?php
session_start();
?>
<html>
<head>
   <title>Gestion de Liste (ADMIN)</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Style-Admin.css" type="text/css" rel="stylesheet" /> 
</head>

<body>
    <div class="BlocHeader">
		 <img id="logo" src="Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?></label>
	</div>

   <div class="BlocGestionListe">
	  <div class="BlocListeClasseProfesseur">
		 
	  <div class="BlocSelectionListeClasseProfesseur">
		 <button id="BtnAfficherListeClasse" type="button" onclick="handleButtonClick_AfficherClasse()"> Liste des classes </button>
		 <button id="BtnAfficherListeProfesseurs" type="button" onclick="handleButtonClick_AfficherProfesseur()"> Liste des professeurs </button>
		 <a href="GraphiqueAdmin.php"><button id="BtnGraphique" type="button">Graphique</button></a>
		 <button id="BtnImportListeElèves" type="button" onclick="createCSV()"> Importer liste élèves </button>		 
		 <button id="BtnImpressionListeElèvesPDF" type="button" onclick="createPDF()">Imprimer un fichier PDF</button>		 
	  </div>
	  
	  <div id="BlocListeClasse" class="BlocListeClasse" >
		 <button id="BtnSupprimerClasse" type="button" > Supprimer classe(s) </button></br>
		 <form id="FiltreListeClasse" name="FiltreListeClasse" method="post" action="">
 		 <select id="DDL_Niveau" name="DDL_Niveau" onChange="store_DDL_Niveau()" >

		   <option>Tous les niveaux</option>      
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
		 
		 <p class="cbClasse">
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
			$sql = "SELECT INTITULE FROM Classe WHERE 1";
			$DDL_Niveau = $_POST['DDL_Niveau'];
			if ($DDL_Niveau != 'Tous les niveaux')
			   $sql .= " AND NIVEAU='$DDL_Niveau'";
			$result = $conn->query($sql);						
			if ($result->num_rows > 0)
			{			
				while($row = $result->fetch_assoc())
				{
				  echo "<label>";
				  echo '<input type="checkbox" value="1">';
				  echo $row["INTITULE"];
				  echo '<img id="ButtonModifierClasse" src="Image/editer.png" class="icone_table" alt="Modifier classe"/>';
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
	  
	  <div id="BlocListeProfesseur" class="BlocListeProfesseur" style="display:none">
		 <button id="BtnSupprimerProfesseur" type="button" > Supprimer professeur(s) sélectionné(s)</button></br>
		 
		 <select id="DDL_Matière" onChange="combo(this, 'theinput')" onMouseOut="comboInit(this, 'theinput')" >
		   <option>Toutes les Matières</option>
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
			   $sql = "SELECT Matiere FROM Professeur WHERE 1";
			   $result = $conn->query($sql);						
			   if ($result->num_rows > 0)
			   {			
				   while($row = $result->fetch_assoc())
				   {
					 echo "<option>" . $row["Matiere"] . "</option>";
				   }
			   }
			   $conn->close();
			?>
		 </select>
		 
		 <select id="DDL_Classe" onChange="combo(this, 'theinput')" onMouseOut="comboInit(this, 'theinput')" >
		   <option>Toutes les Classes</option>
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
			   $sql = "SELECT Intitule FROM Classe WHERE 1";
			   $result = $conn->query($sql);						
			   if ($result->num_rows > 0)
			   {			
				   while($row = $result->fetch_assoc())
				   {
					 echo "<option>" . $row["Intitule"] . "</option>";
				   }
			   }
			   $conn->close();
			?>
		 </select>
		 
		 <p class="cbProfesseur">
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
			$sql = "SELECT Intitule, Matiere FROM Classe, Professeur WHERE Professeur.IDProfesseur = 0";
			if ($DDL_Matière != '')
			   $sql .= " AND Matiere='$DDL_Matière'";
			if ($DDL_Classe != '')
			   $sql .= " AND Classe='$DDL_Classe'";
			$result = $conn->query($sql);						
			if ($result->num_rows > 0)
			{			
				while($row = $result->fetch_assoc())
				{
				  echo "<label>";
				  echo '<input type="checkbox" value="1">';
				  echo $row["Intitule"] . "(" . $row["Matiere"] . ")";
				  echo '<img id="ButtonModifierClasse" src="Image/editer.png" class="icone_table" alt="Modifier classe"/>';
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
	  
	  <button id="BtnValiderListeFourniture" type="button" class="BtnValider"> Valider </button>
	  </div>
	  
	  <div id="BlocCreationListeClasse" class="BlocCreationListeClasse" >
		 <table class="TableCreation" >
			 <label id="label_IdTableau">Nouvelle classe</label>
			   <tr>
				 <th>Intitulé</th>
				 <th>Niveau</th>
			   </tr>
		 
		 <tr>
			 <td><input type="text" name="Intitule"></td>
			 <td><input type="text" name="Niveau"></td>
			 <td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(Table_classe, this)"/></td>
		 </tr>
		 </table>
		 <table id="Table_professeurClasse" class="TableCreation" >
			<label id="label_IdTableau">Liste des professeurs lié à la classe</label>
			  <tr>
				<th>M. / Mme.</th>
				<th>Matière</th>
				<th>Email</th>
			  </tr>
			  <tr>
				  <td><input type="text" name="NomProf"></td>
				  <td><input type="text" name="Matiere"></td>
				  <td><input type="text" name="Email"></td>
				  <td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(Table_classe, this)"/></td>
			  </tr>	
			  <tr>
				<td colspan=3><button id="BtnAjouterFourniture" class="BtnAddNewRowTable" type="button" onclick="addNewRow_tableprofesseurClasse()"> + </button></td>
			  </tr>
		</table>
			   
			    <table id="Table_eleveClasse" class="TableCreation" >
				  <label id="label_IdTableau">Liste des élèves de la classe</label>
					<tr>
					  <th>M. / Mme.</th>
					  <th>Email</th>
					</tr>
					<tr>
						<td><input type="text" name="NomEleve"></td>
						<td><input type="text" name="Email"></td>
						<td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(Table_eleveClasse, this)"/></td>
					</tr>			
					<tr>
					  <td colspan=2><button id="BtnAjouterFourniture" class="BtnAddNewRowTable" type="button" onclick="addNewRow_tableEleveClasse()"> + </button></td>
					</tr>
			  </table>
		  </div>
	  
	  <div id="BlocCreationListeProfesseur" class="BlocCreationListeProfesseur" style="display:none">
			  <table id="table_ajoutprofesseur" class="TableCreation" >
				  <label id="label_IdTableau">Liste des professeurs à ajouter</label>
					<tr>
					  <th>M. / Mme.</th>
					  <th>Matière</th>
					  <th>Email</th>
					</tr>
					<tr>
						<td><input type="text" name="NomProf"></td>
						<td><input type="text" name="Matière"></td>
						<td><input type="text" name="EmailProf"></td>
						<td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(table_ajoutprofesseur, this)"/></td>
					</tr>
				  
					<tr>
					  <td colspan=3><button id="BtnAjouterProfesseur" class="BtnAddNewRowTable" type="button" onclick="addNewRow_tableajoutprofesseur()"> + </button></td>
					</tr>
			  </table>
		  </div>
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
			cell4.innerHTML = '<img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
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
			cell4.innerHTML = '<img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
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
			cell3.innerHTML = '<img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
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
         }
		 
		 function createPDF()
		 {
			window.location.assign('CreatePDF.php');
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






