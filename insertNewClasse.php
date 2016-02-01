<?php
	  session_start();
?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "GestionFourniture";						
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
	
	  $sql = "SELECT MAX(IDClasse)+1 as IDCLASSE FROM classe";
	  $result = $conn->query($sql);
	  if ($result->num_rows > 0)
	  {			
			$row = $result->fetch_assoc();
			$IDClasse = $row["IDCLASSE"];
			
			$intituleClasse = null;
			if(isset($_POST['intituleClasse']))
				  $intituleClasse = $_POST['intituleClasse'];
			$niveauClasse = null;
			if(isset($_POST['niveauClasse']))
				  $niveauClasse = $_POST['niveauClasse'];
			
			$sql = "INSERT INTO classe(IDClasse, Intitule, Niveau) VALUES ($IDClasse, '$intituleClasse', '$niveauClasse')";
			echo "$sql <br />";
			if(mysqli_query($conn, $sql))
			{
				  $NomProf = null;
				  if(isset($_POST['NomProf'])) $NomProf = $_POST['NomProf'];
				  $MatiereProf = null;
				  if(isset($_POST['MatiereProf'])) $MatiereProf = $_POST['MatiereProf'];
				  $MailProf = null;
				  if(isset($_POST['MailProf'])) $MailProf = $_POST['MailProf'];
				 
				  if($NomProf)
				  {
						foreach($NomProf as $i => $idProf)
						{
							  $sql = "INSERT INTO Professeur (Nom, Matiere, Mail, IDClasse)
									  Values ('$idProf', '$MatiereProf[$i]', '$MailProf[$i]', $IDClasse)";
							  echo "$sql <br />";
							  if(!mysqli_query($conn, $sql))
							  {
								  echo("Description erreur : " . mysqli_error($conn));
								  echo($sql);
								  echo "</br>";
							  }
						}
				  }
				  $NomEleve = null;
				  if(isset($_POST['NomEleve'])) $NomEleve = $_POST['NomEleve'];
				  $MailEleve = null;
				  if(isset($_POST['MailEleve'])) $MailEleve = $_POST['MailEleve'];
				  
				  if($NomEleve)
				  {
						foreach($NomEleve as $i => $idEleve)
						{
							  $sql = "INSERT INTO Professeur (Nom, Mail, IDClasse)
									Values ('$idEleve', '$MailEleve[$i]', $IDClasse)";
							  echo "$sql <br />";
							  if(!mysqli_query($conn, $sql))
							  {
								  echo("Description erreur : " . mysqli_error($conn));
								  echo($sql);
								  echo "</br>";
							  }
						}
				  }
			}
			else
			{
				 echo("Description erreur : " . mysqli_error($conn));
				  echo($sql);
				  echo "</br>"; 
			}
	  }
	
	  /*$sql = "INSERT INTO Professeur (Nom, Matiere, Mail, IDClasse)
	  Values ('$_POST[NomProf]', '$_POST[MatiereProf]', '$_POST[EmailProf]', 0)";
	  if(!mysqli_query($conn, $sql))
	  {
		  echo("Description erreur : " . mysqli_error($conn));
		  echo($sql);
		  echo "</br>";
	  }*/
	  
	  
	  
	  $conn->close();
?>