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
        $sql = "DELETE FROM FOURNITURE WHERE IDCLASSE = $idClasse AND IDPROFESSEUR = (SELECT IDPROFESSEUR FROM PROFESSEUR WHERE MAIL='$mail' AND IDCLASSE=$idClasse)";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo($sql);
            echo "</br>";
        }
        
	  $Intitule = null;
	  if(isset($_POST['Intitule'])) $Intitule = $_POST['Intitule'];
	  $Description = null;
	  if(isset($_POST['Description'])) $Description = $_POST['Description'];
	  $Quantite = null;
	  if(isset($_POST['Quantite'])) $Quantite = $_POST['Quantite'];
	  
        foreach($Intitule as $i => $tabIntitule)
        {
              $sql = "INSERT INTO FOURNITURE (Intitule, Description, Quantite, IDClasse, IDProfesseur)
                      Values ('$tabIntitule', '$Description[$i]', $Quantite[$i], $idClasse, (SELECT IDProfesseur FROM Professeur WHERE MAIL='$mail' AND IDClasse=$idClasse))";
              if(!mysqli_query($conn, $sql))
              {
                  echo("Description erreur : " . mysqli_error($conn));
                  echo($sql);
                  echo "</br>";
              }
        }
	  $conn->close();
?>