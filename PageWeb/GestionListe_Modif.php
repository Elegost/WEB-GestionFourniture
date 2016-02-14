<?php
	  session_start();
?>
<html>
<head>
   <title>Gestion de Liste - Modification</title>
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

   <div class="BlocGestionListe">
    	  

	  <form id="insertFournitureForProf" action="../FonctionsPhp/ModifFournitureForProf.php" method="post" >	  
        <div class="BlocCreationListeFourniture">        
			  <table id="table_fourniture" class="TableCreation" >
				  <label id="label_IdTableau">Liste des fournitures</label>
					<tr>
					  <th>Intitulé</th>
					  <th>Nombre</th>
					  <th>Description</th>
					</tr>
                    <?php
                        include('../connexion.php');
                        $email=$_SESSION['Email'];
                        $email=$conn->real_escape_string($email);
                        $idClasse = null;
                        if(isset($_POST['ModifListe'])) $idClasse = $_POST['ModifListe'];                        
                        $sql = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDCLASSE=$idClasse AND IDProfesseur = (SELECT IDProfesseur FROM Professeur WHERE Mail = '$email' AND IDCLASSE=$idClasse)";
                        $result = $conn->query($sql);						
                        if ($result && $result->num_rows > 0)
                        {              
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo '<td><input type="text" name="Intitule[]" value="' . $row["Intitule"] . '"></td>';
                                echo '<td><input type="text" name="Quantite[]" value="' . $row["Quantite"] . '"></td>';
                                echo '<td><input type="text" name="Description[]" value="' . $row["Description"] . '"></td>';
                                echo '<td><img id="ButtonSupprimer" src="../Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/></td>';
                                echo "</tr>"; 
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan=3> 0 results </td></tr>";
                        }
                        $conn->close();
                    ?>
					<tr>
					  <td colspan=3><button id="BtnAjouterFourniture" class="BtnAddNewRowTable" type="button"> + </button></td>
					</tr>
			  </table>
              <?php echo '<input type="text" name="IDCLASSE" value="' . $idClasse .'" style="display:none">' ?>
            <input id="BtnValiderListeFourniture" class="BtnValider" type="submit" value="Valider modification">
            <a href="AffichageListe(Prof).php"><button id="BtnAnnulerListeFourniture" type="button" class="BtnRetour"> Annuler </button></a>
        </div>
	  </div>
</div>

   <script src="../Cookie.js"></script>
   <script type="text/javascript">
	  document.getElementById("BtnAjouterFourniture").addEventListener("click", addNewRow);
	   
	  function addNewRow()
	  {
		  var table = document.getElementById("table_fourniture");
		  var rowCount = table.rows.length;
		  var row = table.insertRow(rowCount - 1);
		  var cell1 = row.insertCell(0);
		  var cell2 = row.insertCell(1);
		  var cell3 = row.insertCell(2);
		  var cell4 = row.insertCell(3);
		  cell1.innerHTML = '<input type="text" name="Intitule[]">';
		  cell2.innerHTML = '<input type="text" name="Quantite[]">';
		  cell3.innerHTML = '<input type="text" name="Description[]">';
		  cell4.innerHTML = '<img id="ButtonSupprimer" src="../Image/supprimer.png" class="icone_table" alt="Editer" onclick="removeRow(this)"/>';
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
   
	  function store_DDL_Matiere()  
	  {
		setCookie("DDL_Matiere_index", DDL_Matière.selectedIndex);
		return true;
	  }
	  
	  function store_DDL_Classe()
	  {
		 setCookie("DDL_Classe_index", DDL_Classe.selectedIndex);
		 return true;
	  }
	  
	  function resetFilter()
	  {
		 deleteCookie("DDL_Matiere_index");
		 deleteCookie("DDL_Classe_index");
		 
	  }
   
	  var DDL_Matiere = document.getElementById("DDL_Matière");
	  if(field1 = getCookie("DDL_Matiere_index")) DDL_Matiere.selectedIndex = field1;
	  
	  var DDL_Classe = document.getElementById("DDL_Classe");
	  if (field2 = getCookie("DDL_Classe_index")) DDL_Classe.selectedIndex = field2;
	 </script>
	 </form>

</body>

</html>