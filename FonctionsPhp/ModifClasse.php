<?php
	  //session_start();
?>
<?php
   /* $servername = "localhost";
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
        $sql = "INSERT INTO classe(IDClasse, Intitule, Niveau) VALUES ($idClasse, '$intituleClasse', '$niveauClasse')";
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
            foreach($NomProf as $i => $idProf)
            {
                  $sql = "INSERT INTO Professeur (Nom, Matiere, Mail, IDClasse)
                        Values ('$idProf', '$MatiereProf[$i]', '$MailProf[$i]', $idClasse)";              
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
            foreach($NomEleve as $i => $idEleve)
            {
                  $sql = "INSERT INTO ELEVE (Nom, Mail, IDClasse)
                    Values ('$idEleve', '$MailEleve[$i]', $idClasse)";        
                  if(!mysqli_query($conn, $sql))
                  {
                      echo("Description erreur : " . mysqli_error($conn));           
                      echo "</br>";
                      echo($sql);
                  }
            }
	  $conn->close();*/
?>