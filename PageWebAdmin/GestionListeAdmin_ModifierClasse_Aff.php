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
		 <img id="logo" src="../Image/logo.jpg" >
		 <form action="../PageWeb/Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour <?php echo $_SESSION['Email'];?></label>
	</div>

   <div class="BlocGestionListe">
	  <div class="BlocListeClasseProfesseur">
		 
	  
	  <div id="BlocListeClasse" class="BlocListeClasse" >
		 <form action="../PageWebAdmin/GestionListeAdmin_ModifierClasse.php" method="post">
			  <input id="BtnModifierClasse" type="submit" value="Retour">
		 </form>
		 <form action="../FonctionsPhp/ModifClasse.php" method="post">
         	  <button id="BtnValiderListe" name="submit" type="submit" class="BtnValider" value="ButtonValider"> Valider modification(s) </button>
		</br>
	
      </div>
	</div>
	  
	  <div id="BlocCreationListeClasse" class="BlocCreationListeClasse" >
		 <table class="TableCreation" >
			 <label id="label_IdTableau">Classe</label>
			   <tr>
				 <th>Intitulé</th>
				 <th>Niveau</th>
			   </tr>
         <?php
            include('../connexion.php');
            $email=$_SESSION['Email'];
            $email=$conn->real_escape_string($email);
            $idClasse = null;
            if(isset($_POST['ModifListe'])) $idClasse = $_POST['ModifListe'];                        
            $sql = "SELECT INTITULE, NIVEAU FROM Classe WHERE IDCLASSE=$idClasse";
            $result = $conn->query($sql);						
            if ($result && $result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                echo "<tr>";
                echo '<td><input type="text" name="intituleClasse" value="' . $row["INTITULE"] . '"></td>';
                echo '<td><input type="text" name="niveauClasse" value="' . $row["NIVEAU"] . '"></td>';
                echo "</tr>"; 
            }
            else
            {
                echo "<tr><td colspan=3> 0 results </td></tr>";
            }
            $conn->close();
        ?>
		 </table>
		 <table id="Table_professeurClasse" class="TableCreation" >
			<label id="label_IdTableau">Liste des professeurs lié à la classe</label>
			  <tr>
				<th>M. / Mme.</th>
				<th>Matière</th>
				<th>Email</th>
              </tr>
              <?php
                include('../connexion.php');
                $email=$_SESSION['Email'];
                $email=$conn->real_escape_string($email);
                $idClasse = null;
                if(isset($_POST['ModifListe'])) $idClasse = $_POST['ModifListe'];                        
                $sql = "SELECT NOM, MATIERE, MAIL, IDPROFESSEUR FROM Professeur WHERE IDCLASSE=$idClasse";
                $result = $conn->query($sql);						
                if ($result && $result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<tr>";
                        echo '<td><input type="text" name="NomProf[]" value="' . $row["NOM"] . '"></td>';
                        echo '<td><input type="text" name="MatiereProf[]" value="' . $row["MATIERE"] . '"></td>';
                        echo '<td><input type="text" name="MailProf[]" value="' . $row["MAIL"] . '"></td>';
						echo '<td style="display:none"><input type="text" name="IDProfesseur[]" value="'.$row["IDPROFESSEUR"].'"></td>';
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
			   
			    <table id="Table_eleveClasse" class="TableCreation" >
				  <label id="label_IdTableau">Liste des élèves de la classe</label>
					<tr>
					  <th>M. / Mme.</th>
					  <th>Email</th>
					</tr>
                    <?php
                        include('../connexion.php');
                        $email=$_SESSION['Email'];
                        $email=$conn->real_escape_string($email);
                        $idClasse = null;
                        if(isset($_POST['ModifListe'])) $idClasse = $_POST['ModifListe'];                        
                        $sql = "SELECT NOM, MAIL, IDELEVE FROM ELEVE WHERE IDCLASSE=$idClasse";
                        $result = $conn->query($sql);						
                        if ($result && $result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo '<td><input type="text" name="NomEleve[]" value="' . $row["NOM"] . '"></td>';
                                echo '<td><input type="text" name="MailEleve[]" value="' . $row["MAIL"] . '"></td>';
								echo '<td style="display:none"><input type="text" name="IDEleve[]" value="'.$row["IDELEVE"].'"></td>';
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
	        <?php echo '<input type="text" name="IDCLASSE" value="' . $idClasse .'" style="display:none">'; ?>
	  </form>
   </div>
   <script type="text/javascript">  
		 /*function addNewRow_tableajoutprofesseur()
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
		 }	*/ 
		 
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






