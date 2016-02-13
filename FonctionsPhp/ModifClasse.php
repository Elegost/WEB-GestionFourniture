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
        $mail = $_SESSION["Email"];
        $idClasse = null;
        if(isset($_POST['IDCLASSE'])) $idClasse = $_POST['IDCLASSE'];      
        
        $intituleClasse = null;
        if(isset($_POST['intituleClasse'])) $intituleClasse = $_POST['intituleClasse'];
        $niveauClasse = null;
        if(isset($_POST['niveauClasse'])) $niveauClasse = $_POST['niveauClasse'];       
        $sql = "UPDATE classe SET Niveau = '$niveauClasse', Intitule = '$intituleClasse' WHERE IDCLASSE = $idClasse";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));           
            echo "</br>";
            echo($sql);
        }
        
        $NomProf = null;
        if(isset($_POST['NomProf'])) $NomProf = $_POST['NomProf'];
        $MatiereProf = null;
        if(isset($_POST['MatiereProf'])) $MatiereProf = $_POST['MatiereProf'];
        $MailProf = null;
        if(isset($_POST['MailProf'])) $MailProf = $_POST['MailProf'];
        $idProfesseur = null;
        if(isset($_POST['IDProfesseur'])) $idProfesseur = $_POST['IDProfesseur'];
        
            foreach($NomProf as $i => $idProf)
            {
                  $sql = "UPDATE Professeur SET Nom = '$idProf', Matiere = '$MatiereProf[$i]', Mail = '$MailProf[$i]' WHERE IDProfesseur = $idProfesseur[$i] ";              
                  if(!mysqli_query($conn, $sql))
                  {
                      echo("Description erreur : " . mysqli_error($conn));           
                      echo "</br>";
                      echo($sql);
                  }
            }
        
        $NomEleve = null;
        if(isset($_POST['NomEleve'])) $NomEleve = $_POST['NomEleve'];
        $MailEleve = null;
        if(isset($_POST['MailEleve'])) $MailEleve = $_POST['MailEleve'];
        $idEleve2 = null;
        if(isset($_POST['IDEleve'])) $idEleve2 = $_POST['IDEleve'];

            foreach($NomEleve as $i => $idEleve)
            {
                  $sql = "UPDATE Eleve SET Nom = '$idEleve', Mail = '$MailEleve[$i]' WHERE IDEleve = $idEleve2[$i]";
                  if(!mysqli_query($conn, $sql))
                  {
                      echo("Description erreur : " . mysqli_error($conn));           
                      echo "</br>";
                      echo($sql);
                  }
            }
	  $conn->close();
?>