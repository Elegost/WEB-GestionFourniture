<html>

<head>
   <title>Gestion de Liste</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Style.css" type="text/css" rel="stylesheet" />
   
   <script>
	  function addNewRow()
	  {
		  var table = document.getElementById("table_fourniture");
		  var rowCount = table.rows.length;
		  var row = table.insertRow(rowCount - 1);
		  var cell1 = row.insertCell(0);
		  var cell2 = row.insertCell(1);
		  var cell3 = row.insertCell(2);
		  var cell4 = row.insertCell(3);
		  cell1.innerHTML = '<input type="text" name="Intitulé">';
		  cell2.innerHTML = '<input type="text" name="Nombre">';
		  cell3.innerHTML = '<input type="text" name="Description">';
		  cell4.innerHTML = '<img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
	  }
		
	  function removeRow(row)
	  {
		  var table = document.getElementById("table_fourniture");
		  var rowCount = table.rows.length;
		  var i=row.parentNode.parentNode.rowIndex;
		  if (rowCount > 3)
		  {
            table.deleteRow(i);
          }		  
	  }

    </script>
   
</head>

<body>
   
   <div class="BlocHeader">
		 <img id="logo" src="Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour [MAIL] </label>
	</div>

   <div class="BlocGestionListe">
	  <div class="BlocListeClasse">
		 <select name="DDL_Matière" id="DDL_Matière" onChange="combo(this, 'theinput')" onMouseOut="comboInit(this, 'theinput')" >
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
  
	  <select name="DDL_Classe" id="DDL_Classe" onChange="combo(this, 'theinput')" onMouseOut="comboInit(this, 'theinput')" >
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
	  </select><br/>
  
	  <p class="cb">
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
	  
	  <button id="BtnValiderListeFourniture" type="button" class="BtnValider"> Valider </button>
	  <a href="AffichageListe(Prof).php"><button id="BtnAnnulerListeFourniture" type="button"class="BtnRetour"> Annuler </button></a>
  
	  </div>
	  
	  <div class="BlocCreationListeFourniture">
			  <table id="table_fourniture" class="TableCreation" >
				  <label id="label_IdTableau">Liste des fournitures</label>
					<tr>
					  <th>Intitulé</th>
					  <th>Nombre</th> 
					  <th>Description</th>
					</tr>
					<tr>
					  <td><input type="text" name="Intitulé" ></td>
					  <td><input type="text" name="Nombre"></td> 
					  <td><input type="text" name="Description"></td>
					  <td class="RowTableEdition"><img id="ButtonSupprimer" src="Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/></td>
					</tr>
					<tr>
					  <td colspan=3><button id="BtnAjouterFourniture" class="BtnAddNewRowTable" type="button" onclick="addNewRow()"> + </button></td>
					</tr>
			  </table>
		  </div>
   </div>
     
</body>

</html>